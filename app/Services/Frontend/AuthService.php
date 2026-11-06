<?php

namespace App\Services\Frontend;

use App\Mail\Frontend\{CustomResetPasswordMail, WelcomeUserMail};
use App\Models\{User, Verification};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Hash, Log, Mail, Password};
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthService
{
  public function register(array $data): User
  {
    return DB::transaction(function () use ($data) {
      $email = strtolower(trim($data['email']));
      $phone = !empty($data['phone']) ? trim($data['phone']) : null;
      $firstName = trim($data['first_name']);
      $lastName = !empty($data['last_name']) ? trim($data['last_name']) : null;

      $user = User::where('email', $email)->first();

      if ($user) {
        $user->update([
          'first_name' => $firstName,
          'last_name'  => $lastName,
          'phone'      => $phone,
          'password'   => Hash::make($data['password']),
          'status'     => 1,
        ]);
      } else {
        $user = User::create([
          'first_name' => $firstName,
          'last_name'  => $lastName,
          'email'      => $email,
          'phone'      => $phone,
          'password'   => Hash::make($data['password']),
          'status'     => 1,
        ]);
      }

      try {
        $view = 'emails.frontend.welcome';
        $emailData = [
          'user' => $user,
        ];
        $subject = 'Welcome to ' . config('app.name', 'our store') . '!';
        $cc = [];
        $bcc = [];
        app('EmailService')->sendEmail($user->email, $subject, $view, $emailData, $cc, $bcc);
      } catch (\Exception $e) {
        try {
          Mail::to($user->email)->send(new WelcomeUserMail($user));
        } catch (\Exception $ex) {
          Log::error("Failed to send welcome email to {$user->email}: " . $ex->getMessage());
        }
      }
      return $user;
    });
  }

  public function registerlogin(array $data): User
  {
    return DB::transaction(function () use ($data) {
      $data['password'] = '12345678';
      $user = User::create([
        'first_name'  => $data['first_name'] ?? '',
        'email'        => $data['email'],
        'phone'      => !empty($data['phone']) ? $data['phone'] : null,
        'password'     => Hash::make($data['password']),
      ]);

      try {
        $view = 'emails.frontend.welcome';
        $emailData = [
          'user' => $user,
        ];
        $subject = 'Welcome to ' . config('app.name', 'our store') . '!';
        $cc = [];
        $bcc = [];
        app('EmailService')->sendEmail($user->email, $subject, $view, $emailData, $cc, $bcc);
      } catch (\Exception $e) {
        try {
          Mail::to($user->email)->send(new WelcomeUserMail($user));
        } catch (\Exception $ex) {
          Log::error("Failed to send welcome email to {$user->email}: " . $ex->getMessage());
        }
      }
      return $user;
    });
  }

  // public function getOtpUser()
  // {
  //   // You can retrieve the user from the session value
  //   $emailOrMobile = session('otp_email');

  //   if (!$emailOrMobile) {
  //     return null;
  //   }

  //   return User::where('email', $emailOrMobile)->orWhere('mobile', $emailOrMobile)->first();
  // }

  public function getOtpUser()
  {
    $emailOrMobile = trim(session('otp_email', ''));

    if (empty($emailOrMobile)) {
      return null;
    }

    return User::where('email', $emailOrMobile)
      ->orWhere('mobile', $emailOrMobile)
      ->first();
  }



  public function login(array $data): User
  {
    $loginInput = trim($data['email']);
    $email = strtolower($loginInput);

    $user = User::where('email', $email)
      ->orWhere(function ($query) use ($loginInput) {
        $query->whereNotNull('phone')
              ->where('phone', '!=', '')
              ->where('phone', $loginInput);
      })
      ->first();

    if (!$user) {
      throw ValidationException::withMessages([
        'email' => ['These credentials do not match our records.'],
      ]);
    }

    if ($user->status == 2) {
      throw ValidationException::withMessages([
        'email' => ['Account suspended by admin.'],
      ]);
    }

    if (!Hash::check($data['password'], $user->password)) {
      throw ValidationException::withMessages([
        'password' => ['Incorrect email or password. Please try again.'],
      ]);
    }

    return $user;
  }

  public function logout(Request $request): void
  {
    Auth::guard('web')->logout();
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
  }

  public function sendCustomPasswordResetLink($email)
  {
    $user = User::where('email', $email)->first();

    if (!$user) {
      return Password::INVALID_USER;
    }

    // Create token
    $token = Str::random(64);

    // Store token in verifications table
    Verification::updateOrInsert(
      ['user_id' => $user->id],
      [
        'token' => $token,
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'created_at' => now(),
        'updated_at' => now(),
      ]
    );

    // // Send custom mail
    // Mail::to($email)->send(new CustomResetPasswordMail($token, $user));

    $view = 'emails.frontend.custom-reset-password';
    $data = [
      'token' => $token,
      'user' => $user,
    ];
    $subject = 'Reset Your Password';
    $cc = [];
    $bcc = [];
    app('EmailService')->sendEmail($email, $subject, $view, $data, $cc, $bcc);

    return Password::RESET_LINK_SENT;
  }

  public function resetPassword(array $data)
  {
    $verification = Verification::where('token', $data['token'])
      ->latest()
      ->first();

    if (!$verification) {
      throw new \Exception('Invalid or expired token.');
    }

    // Check token expiry (1 hour)
    $updatedAt = Carbon::parse($verification->updated_at);
    if ($updatedAt->diffInMinutes(now()) > 60) {
      throw new \Exception('This reset link has expired. Please request a new one.');
    }

    $user = User::where('email', $data['email'])->first();

    if (!$user) {
      throw new \Exception('User not found.');
    }

    if (Hash::check($data['password'], $user->password)) {
      throw new \Exception('New password cannot be the same as current password.');
    }

    $user->password = Hash::make($data['password']);
    $user->save();

    Verification::where('id', $verification->id)->delete();

    // Dispatch password changed notification email
    try {
      app('SendEmailService')->PasswordChanged($user);
    } catch (\Throwable $e) {
      Log::error('Password changed notification email failed during reset: ' . $e->getMessage(), [
        'user_id' => $user->id,
        'email' => $user->email,
      ]);
    }

    return true;
  }
}
