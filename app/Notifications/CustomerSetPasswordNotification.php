<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

/**
 * Sends a customer the link to choose a password.
 *
 * Doubles as both "set your password" (for accounts auto-created at checkout,
 * which are still on a random password) and "reset your password" (for accounts
 * whose owner chose one already), because the underlying token flow is identical
 * and only the wording differs.
 */
class CustomerSetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $token,
        public bool $isFirstTimeSetup = false,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('customer.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expiresInMinutes = Config::get('auth.passwords.customers.expire', 1440);

        $mail = (new MailMessage())
            ->subject($this->isFirstTimeSetup ? 'Set your password' : 'Reset your password');

        if ($this->isFirstTimeSetup) {
            $mail->line('An account was created for you when you placed your order, so you can track it and check out faster next time.')
                ->line('Choose a password to finish setting it up.')
                ->action('Set password', $url);
        } else {
            $mail->line('You are receiving this email because we received a password reset request for your account.')
                ->action('Reset password', $url);
        }

        return $mail
            ->line('This link expires in ' . $this->expiryDescription($expiresInMinutes) . '.')
            ->line('If you did not expect this email, you can safely ignore it.');
    }

    private function expiryDescription(int $minutes): string
    {
        if ($minutes < 60) {
            return $minutes . ' minutes';
        }

        $hours = intdiv($minutes, 60);

        return $hours . ' ' . ($hours === 1 ? 'hour' : 'hours');
    }
}
