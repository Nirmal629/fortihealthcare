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
      if ($mailSetting) {
        config([
          'mail.mailers.smtp.transport' => $mailSetting->mail_mailer ?: 'smtp',
          'mail.mailers.smtp.host' => $mailSetting->mail_host,
          'mail.mailers.smtp.port' => $mailSetting->mail_port,
          'mail.mailers.smtp.encryption' => $mailSetting->mail_encryption,
          'mail.mailers.smtp.username' => $mailSetting->mail_username,
          'mail.mailers.smtp.password' => $mailSetting->mail_password,
          'mail.from.address' => $mailSetting->mail_from_address ?: config('mail.from.address'),
          'mail.from.name' => $mailSetting->mail_from_name ?: config('mail.from.name'),
        ]);
      }
    }
  }

  public function register()
  {
    //
  }
}
