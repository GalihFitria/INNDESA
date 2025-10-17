<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Buat notifikasi baru.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Tentukan channel notifikasi.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Representasi email notifikasi.
     */
   public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Atur Ulang Kata Sandi')
            ->greeting('Hello!')
            ->line('Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda.')
            ->action('Atur Ulang Kata Sandi', url(route('password.reset', [
    'token' => $this->token,
    'email' => $notifiable->getEmailForPasswordReset(),
], false)))

            ->line('Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' menit.')
            ->line('Jika Anda tidak meminta pengaturan ulang kata sandi, tidak perlu melakukan tindakan apa pun.');
    }

    /**
     * Representasi array notifikasi.
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
