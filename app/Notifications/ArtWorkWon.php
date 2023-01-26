<?php

namespace App\Notifications;

use App\Models\BidLog;
use App\Notifications\Channels\OneSignalChannel;
use App\Notifications\Messages\OneSignalMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArtWorkWon extends Notification
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [OneSignalChannel::class, 'database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $url = route('auctions.artworks.show', ['id' => $this->bid->artWork->id]);
        return (new MailMessage)
            ->subject('Eseri Kazandınız.')
            ->greeting('Merhaba, ' . $notifiable->name . '!')
            ->line(sprintf('Teklif verdiğiniz %s adlı eser için teklif süresi sona erdi ve kazandınız.', $this->bid->artWork->title))
            ->line('Daha fazla bilgi için aşağıdaki linkten sayfayı ziyaret edin ve iletişime geçin.')
            ->action('Esere Git', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => sprintf('%s adlı eseri kazandınız', $this->bid->artWork->title),
            'message' => sprintf('Teklif verdiğiniz %s adlı eser için teklif süresi sona erdi ve kazandınız.', $this->bid->artWork->title),
            'url' => route('auctions.artworks.show', ['id' => $this->bid->artWork->id])
        ];
    }

    public function toPushNotification($notifiable): OneSignalMessage
    {
        return (new OneSignalMessage())
            ->setHeadings([
                'tr' => sprintf('%s adlı eseri kazandınız', $this->bid->artWork->title),
                'en' => sprintf('You won the %s art', $this->bid->artWork->title)
            ])
            ->setContents([
                'tr' => sprintf('Teklif verdiğiniz %s adlı eser için teklif süresi sona erdi ve kazandınız.', $this->bid->artWork->title),
                'en' => sprintf('The bidding period for the %s art you bid on has ended and you won.', $this->bid->artWork->title)
            ])
            ->setIncludedSegments(["Subscribed Users"]);
    }
}
