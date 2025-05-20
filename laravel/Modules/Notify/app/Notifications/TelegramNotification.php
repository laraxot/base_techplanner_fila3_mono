<?php

declare(strict_types=1);

/**
 * @see https://iftikhar-ahmed.medium.com/send-push-notifications-in-laravel-using-firebase-on-your-android-device-f585621db900
 * @see https://github.com/laravel-notification-channels/telegram
 */

namespace Modules\Notify\Notifications;

use Illuminate\Bus\Queueable;
<<<<<<< HEAD
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Modules\Notify\Notifications\Channels\TelegramChannel;
=======
use Illuminate\Notifications\Notification;
use InvalidArgumentException;
use NotificationChannels\Telegram\TelegramMessage;
>>>>>>> c57e89d (.)

/**
 * Classe per inviare notifiche tramite Telegram.
 */
<<<<<<< HEAD
class TelegramNotification extends Notification implements ShouldQueue
=======
class TelegramNotification extends Notification
>>>>>>> c57e89d (.)
{
    use Queueable;

    /**
<<<<<<< HEAD
     * @var string
     */
    protected string $message;

    /**
     * @var array
     */
    protected array $options;

    /**
     * Create a new notification instance.
     *
     * @param string $message
     * @param array $options
     */
    public function __construct(string $message, array $options = [])
    {
        $this->message = $message;
        $this->options = $options;
=======
     * Create a new notification instance.
     */
    public function __construct()
    {
        // $this->data = $data;
>>>>>>> c57e89d (.)
    }

    /**
     * Get the notification's delivery channels.
     *
<<<<<<< HEAD
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [TelegramChannel::class];
=======
     * @param object $notifiable The entity to be notified
     * @return array<string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
>>>>>>> c57e89d (.)
    }

    /**
     * Get the array representation of the notification.
     *
     * @param object|null $notifiable The entity to be notified
     * @return array<string, mixed>
     */
    public function toArray(?object $notifiable): array
    {
        // return $this->data->toArray();
        return [];
    }

    /**
     * Get the Telegram representation of the notification.
     *
<<<<<<< HEAD
     * @param mixed $notifiable
     * @return string
     */
    public function toTelegram($notifiable): string
    {
        return $this->message;
=======
     * @param object|null $notifiable The entity to be notified
     * @return TelegramMessage
     */
    public function toTelegram(?object $notifiable): TelegramMessage
    {
        // $url = url('/invoice/'.$this->invoice->id);
        $url = '#';

        return TelegramMessage::create()
            // Optional recipient user id.
            // ->to(' dddd ')
            // Markdown supported.
            ->content('Hello there!')
            ->line('Your invoice has been *PAID*')
            // ->lineIf($notifiable->amount > 0, "Amount paid: {$notifiable->amount}")
            // ->line('Thank you!')

            // (Optional) Blade template for the content.
            // ->view('notification', ['url' => $url])

            // (Optional) Inline Buttons
            ->button('View Invoice', $url)
            ->button('Download Invoice', $url);
        // (Optional) Inline Button with callback. You can handle callback in your bot instance
        // ->buttonWithCallback('Confirm', 'confirm_invoice '.$this->invoice->id)
>>>>>>> c57e89d (.)
    }
}
