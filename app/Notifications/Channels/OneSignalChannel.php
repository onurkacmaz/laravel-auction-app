<?php

namespace App\Notifications\Channels;

use App\Http\Services\OneSignalService;
use App\Notifications\Messages\OneSignalMessage;
use Illuminate\Notifications\Notification;
use Symfony\Component\HttpFoundation\Request;

class OneSignalChannel
{
    private OneSignalService $oneSignalService;

    public function __construct()
    {
        $this->oneSignalService = new OneSignalService();
    }

    public function send($notifiable, Notification $notification): void {
        /** @var OneSignalMessage $message */
        $message = $notification->toPushNotification($notifiable);
        $this->oneSignalService->call(Request::METHOD_POST, 'notifications', [
            'included_segments' => $message->getIncludedSegments(),
            'headings' => $message->getHeadings(),
            'contents' => $message->getContents()
        ]);
    }
}
