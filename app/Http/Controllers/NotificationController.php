<?php

namespace App\Http\Controllers;

use App\Http\Services\NotificationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function notifications(Request $request): JsonResponse {
        $page = $request->get('page', 1);
        $notifications = $this->notificationService->getNotifications($page);

        return response()->json([
            'html' => view('components.notifications', [
                'notifications' => $notifications,
            ])->render(),
            'count' => auth()->user()->unreadNotifications()->count(),
            'currentPage' => $page,
            'hasMorePages' => $notifications->hasMorePages(),
        ]);
    }

    public function markAsRead(string|null $id = null): JsonResponse {
        if (!is_null($id)) {
            $notifications = Collection::make([$this->notificationService->getNotificationById($id)]);
        }else {
            $notifications = auth()->user()->unreadNotifications;
        }

        $this->notificationService->markAsRead($notifications);

        return response()->json([
            'status' => 'success',
            'count' => auth()->user()->unreadNotifications()->count()
        ]);
    }
}
