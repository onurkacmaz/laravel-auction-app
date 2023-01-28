<?php

namespace App\Notifications;

use App\Models\BidLog;
use App\Notifications\Channels\OneSignalChannel;
use App\Notifications\Messages\OneSignalMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBid extends Notification
{
    use Queueable;

    private BidLog|Model $bid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(BidLog|Model $bid)
    {

        $this->bid = $bid;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OneSignalChannel::class, 'database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $url = route('auctions.artworks.show', ['id' => $this->bid->artWork->id]);
        return (new MailMessage)
            ->subject('Yeni Pey Verildi')
            ->greeting('Merhaba, ' . $notifiable->name . '!')
            ->line(sprintf("Daha önce pey verdiğiniz %s adlı esere yeni bir pey verildi.", $this->bid->artWork->title))
            ->action('Esere Git', $url);
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => sprintf("%s adlı esere yeni bir pey verildi.", $this->bid->artWork->title),
            'message' => sprintf("Daha önce pey verdiğiniz %s adlı esere yeni bir pey verildi.", $this->bid->artWork->title),
            'url' => route('auctions.artworks.show', ['id' => $this->bid->artWork->id])
        ];
    }

    public function toPushNotification($notifiable): OneSignalMessage
    {
        return (new OneSignalMessage())
            ->setHeadings([
                'tr' => sprintf("%s adlı esere yeni bir pey verildi.", $this->bid->artWork->title),
                'en' => sprintf("A new bid has been placed on the artwork %s.", $this->bid->artWork->title)
            ])
            ->setContents([
                'tr' => sprintf("Daha önce pey verdiğiniz %s adlı esere yeni bir pey verildi.", $this->bid->artWork->title),
                'en' => sprintf("A new bid has been placed on the artwork %s that you have bid on.", $this->bid->artWork->title)
            ])
            ->setExternalUserIds([(string)$notifiable->id]);
    }
}
