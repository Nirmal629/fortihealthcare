<?php

namespace App\Mail\Frontend;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Content, Envelope};
use Illuminate\Queue\SerializesModels;

class PasswordChangedMail extends Mailable
{
  use Queueable, SerializesModels;

  public User $user;
  public array $meta;

  /**
   * Create a new message instance.
   *
   * @param User $user
   * @param array $meta
   */
  public function __construct(User $user, array $meta = [])
  {
    $this->user = $user;
    $this->meta = $meta;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    $appName = config('app.name', 'Fortier Healthcare');
    return new Envelope(
      subject: 'Security Alert: Password Changed Successfully - ' . $appName,
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.frontend.password-changed',
      with: $this->buildViewData(),
    );
  }

  /**
   * Build the message for backward compatibility.
   */
  public function build()
  {
    $appName = config('app.name', 'Fortier Healthcare');
    return $this->subject('Security Alert: Password Changed Successfully - ' . $appName)
      ->view('emails.frontend.password-changed')
      ->with($this->buildViewData());
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }

  /**
   * Prepare parameters for email view.
   *
   * @return array
   */
  protected function buildViewData(): array
  {
    $fullName = (!empty($this->user->name) && strcasecmp(trim($this->user->name), 'guest') !== 0)
      ? $this->user->name
      : ((!empty($this->user->first_name) && strcasecmp(trim($this->user->first_name), 'guest') !== 0)
        ? trim($this->user->first_name . ' ' . ($this->user->last_name ?? ''))
        : 'Valued Customer');

    return array_merge([
      'user' => $this->user,
      'customerName' => $fullName,
      'changedAt' => now()->timezone(config('app.timezone', 'Asia/Kolkata'))->format('d M Y, h:i A T'),
      'deviceInfo' => request()->header('User-Agent') ?? 'Web Browser',
      'ipAddress' => request()->ip() ?? 'Unknown',
      'loginUrl' => route('signuplogin'),
      'resetUrl' => route('password.request'),
      'supportEmail' => config('app.support_email', 'fortiercustomersupport@gmail.com'),
      'appName' => config('app.name', 'Fortier Healthcare'),
    ], $this->meta);
  }
}
