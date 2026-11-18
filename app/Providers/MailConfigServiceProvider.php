<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
  public function boot()
  {
    // Fetch mail settings from the database
    if (Schema::hasTable('mail_settings')) {
      $mailSetting = \App\Models\MailSetting::first();
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
      } else {
        $currentPort = config('mail.mailers.smtp.port');
        $currentEnc = config('mail.mailers.smtp.encryption');
        if ($currentPort == 465 && (empty($currentEnc) || $currentEnc === 'null')) {
          config(['mail.mailers.smtp.encryption' => 'ssl']);
        }
        if (empty(config('mail.mailers.smtp.timeout'))) {
          config(['mail.mailers.smtp.timeout' => 15]);
        }
      }
    }
  }

  public function register()
  {
    //
  }
}
