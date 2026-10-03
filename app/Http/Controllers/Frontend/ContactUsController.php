<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactUsRequest;
use App\Models\SiteSetting;
use App\Models\Support;
use Illuminate\Support\Facades\RateLimiter;

class ContactUsController extends Controller
{
  public function saveContactInformation(ContactUsRequest $request)
  {
    $key = 'contact-us:' . $request->ip();
    if (RateLimiter::tooManyAttempts($key, 5)) {
      return response()->json([
        'success' => false,
        'message' => 'Too many attempts. Please try again later.'
      ], 429);
    }

    RateLimiter::hit($key, 60);

    $validated = $request->validated();

    if (!empty($validated['first_name'])) {
      $firstName = $validated['first_name'];
      $lastName = $validated['last_name'] ?? null;
      $name = trim($firstName . ' ' . $lastName);
    } else {
      $name = $validated['name'] ?? '';
      $parts = explode(' ', trim($name), 2);
      $firstName = $parts[0] ?? '';
      $lastName = $parts[1] ?? null;
    }

    $phone = $validated['phone'] ?? null;
    $sanitizedMessage = strip_tags($validated['message']);

    Support::create([
      'first_name' => $firstName,
      'last_name'  => $lastName,
      'phone'      => $phone,
      'email'      => $validated['email'],
      'message'    => $sanitizedMessage,
    ]);

    // Prepare data for the email
    $data = [
      'name'    => $name,
      'email'   => $validated['email'],
      'phone'   => $phone,
      'message' => $sanitizedMessage,
    ];

    try {
      if (app()->bound('EmailService')) {
        $adminEmails = adminMailsByRoleID([SiteSetting::where('key', 'order_copy_to_id')->value('value') ?? 1]);
        app('EmailService')->sendEmail(
          $validated['email'],
          'Thank You for Contacting Us!',
          'emails.frontend.contact-submission',
          ['data' => $data],
          [],
          $adminEmails
        );
      }
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::warning('Contact email sending error: ' . $e->getMessage());
    }

    return response()->json([
      'success' => true,
      'message' => 'Your message has been sent successfully!'
    ]);
  }
}
