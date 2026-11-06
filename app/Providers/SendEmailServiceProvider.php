<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Models\Verification;
use Illuminate\Http\JsonResponse;

class SendEmailServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    // Register the service within the service container
    $this->app->singleton('SendEmailService', function ($app) {
      return new SendEmailService();
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}

class SendEmailService
{

  /**
   * Sends an OTP to the user via email.
   *
   * @param string $userType The type of user to send the OTP to ('user' or 'admin').
   * @param string $otpType The type of OTP to send ('login').
   *
   * @return JsonResponse
   */
  public function OTP(string $userType = 'user', $otpType = 'login'): JsonResponse
  {
    $guard = ($userType === 'admin') ? 'admin' : 'web';
    $user = user($guard);

    $subject = 'Your OTP Code for ' . ($otpType === 'login' ? 'Login' : '');

    $template = 'emails.otp';

    $otp = Verification::insertOTP($userType, 'email', $user->id);

    $fullName = rtrim($user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name);

    $params = [
      'name' => $fullName,
      'otp' => $otp
    ];

    $cc = [];
    $bcc = [];

    // Send OTP email
    app('EmailService')->sendEmail(user($guard)->email, $subject, $template, $params, $cc, $bcc);

    return response()->json(['success' => true, 'message' => __('response.otp.success.sent.email')]);
  }

  /**
   * Sends a password reset link to the user via email.
   *
   * @param string $userType The type of user to send the OTP to ('user' or 'admin').
   * @param string $email The email address of the user.
   * @param array $params The parameters to pass to the email template.
   *
   * @return JsonResponse
   */
  public function ResetLink(string $userType = 'user', string $email, array $params): JsonResponse
  {

    if ($userType === 'admin')
      $user = Admin::where('email', $email)->first();
    else
      $user = User::where('email', $email)->first();
    $template = 'emails.forgot_password';
    $subject = 'Password Reset Link';
    $fullName = rtrim($user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name);
    $params['name'] = $fullName;

    $cc = [];
    $bcc = [];
    // Send Password Reset email
    app('EmailService')->sendEmail($user->email, $subject, $template, $params, $cc, $bcc);

    return response()->json(['success' => true, 'message' => __('response.auth.password.link_sent')]);
  }

  public function WelcomeMail(string $email, array $params): JsonResponse
  {
    $template = 'emails.admin_welcome';
    $subject = 'Welcome to ' . config('app.name');
    $params = [
      'name' => $params['name'],
      'email' => $email,
      'password' => $params['password']
    ];

    $cc = [];
    $bcc = [];
    // Send Welcome email
    app('EmailService')->sendEmail($email, $subject, $template, $params, $cc, $bcc);

    return response()->json(['success' => true, 'message' => __('response.email.sent')]);
  }

  /**
   * Sends a Password Changed notification email to the user.
   *
   * @param User $user The user whose password was changed.
   * @param array $params Optional additional parameters.
   * @return void
   */
  public function PasswordChanged(User $user, array $params = []): void
  {
    if (empty($user->email)) {
      return;
    }

    $template = 'emails.frontend.password-changed';
    $appName = config('app.name', 'Fortier Healthcare');
    $subject = 'Security Alert: Password Changed Successfully - ' . $appName;

    $fullName = (!empty($user->name) && strcasecmp(trim($user->name), 'guest') !== 0)
      ? $user->name
      : ((!empty($user->first_name) && strcasecmp(trim($user->first_name), 'guest') !== 0)
        ? trim($user->first_name . ' ' . ($user->last_name ?? ''))
        : 'Valued Customer');

    $viewData = array_merge([
      'user' => $user,
      'customerName' => $fullName,
      'changedAt' => now()->timezone(config('app.timezone', 'Asia/Kolkata'))->format('d M Y, h:i A T'),
      'deviceInfo' => request()->header('User-Agent') ?? 'Web Browser',
      'ipAddress' => request()->ip() ?? 'Unknown',
      'loginUrl' => route('signuplogin'),
      'resetUrl' => route('password.request'),
      'supportEmail' => config('app.support_email', 'fortiercustomersupport@gmail.com'),
      'appName' => $appName,
    ], $params);

    $cc = [];
    $bcc = [];

    try {
      app('EmailService')->sendEmail($user->email, $subject, $template, $viewData, $cc, $bcc);
    } catch (\Throwable $e) {
      \Illuminate\Support\Facades\Log::error('Failed to send password changed email to ' . $user->email . ': ' . $e->getMessage(), [
        'user_id' => $user->id,
        'error' => $e->getMessage(),
      ]);
    }
  }
}
