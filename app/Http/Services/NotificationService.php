<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public const PAGINATE_LIMIT = 10;

    public function getNotifications(int $page = 1): LengthAwarePaginator
    {
        return auth()->user()->notifications()->paginate(self::PAGINATE_LIMIT, ['*'], 'page', $page);
    }

    public function getNotificationById(string $id): DatabaseNotification
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->notifications()->find($id);
    }

    public function markAsRead(Collection $notifications): void
    {
        $notifications->each(function (DatabaseNotification $notification) {
            $notification->markAsRead();
        });
    }
}
