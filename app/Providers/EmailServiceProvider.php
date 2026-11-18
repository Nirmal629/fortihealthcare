<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Models\MailSetting;

class EmailServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton('EmailService', function ($app) {
      return new class {
        /**
         * Sends an email using Laravel's Mail facade.
         *
         * @param string $email The recipient's email address.
         * @param string $subject The subject of the email.
         * @param string $view The name of the view to use for the email template.
         * @param array $data An associative array of data to pass to the view.
         *
         * @return void
         */
        public function sendEmail(string $email, string $subject, string $view, array $data = [], array $cc = [], array $bcc = []): void
        {
          try {
            $mailSetting = null;
            if (\Illuminate\Support\Facades\Schema::hasTable('mail_settings')) {
              $mailSetting = MailSetting::first();
            }

            if ($mailSetting && !empty($mailSetting->mail_host)) {
              $encryption = $mailSetting->mail_encryption;
              if (empty($encryption) || $encryption === 'null') {
                $encryption = ($mailSetting->mail_port == 465) ? 'ssl' : (($mailSetting->mail_port == 587) ? 'tls' : null);
              }

              config([
                'mail.default' => $mailSetting->mail_mailer ?: 'smtp',
                'mail.mailers.smtp.transport' => $mailSetting->mail_mailer ?: 'smtp',
                'mail.mailers.smtp.host' => $mailSetting->mail_host,
                'mail.mailers.smtp.port' => $mailSetting->mail_port,
                'mail.mailers.smtp.encryption' => $encryption,
                'mail.mailers.smtp.username' => $mailSetting->mail_username,
                'mail.mailers.smtp.password' => $mailSetting->mail_password,
                'mail.mailers.smtp.timeout' => 15,
                'mail.from.address' => $mailSetting->mail_from_address ?: config('mail.from.address'),
                'mail.from.name' => $mailSetting->mail_from_name ?: config('mail.from.name'),
              ]);

              Mail::purge('smtp');
            } else {
              $currentPort = config('mail.mailers.smtp.port');
              $currentEnc = config('mail.mailers.smtp.encryption');
              if ($currentPort == 465 && (empty($currentEnc) || $currentEnc === 'null')) {
                config(['mail.mailers.smtp.encryption' => 'ssl']);
              }
              if (empty(config('mail.mailers.smtp.timeout'))) {
                config(['mail.mailers.smtp.timeout' => 15]);
              }
              Mail::purge('smtp');
            }

            Mail::send($view, $data, function ($message) use ($email, $subject, $cc, $bcc) {
              $message->to($email)->subject($subject);

              if (!empty($cc)) {
                $message->cc($cc);
              }

              if (!empty($bcc)) {
                $message->bcc($bcc);
              }
            });
          } catch (\Exception $e) {
            throw new \Exception('Email sending failed: ' . $e->getMessage());
          }
        }
      };
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
