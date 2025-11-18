<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\NotificationModel;

class Api extends ResourceController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Get notifications for current user
     * GET /api/notifications
     */
    public function notifications()
    {
        $userId = session()->get('id_users');

        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        try {
            $unreadNotifications = $this->notificationModel->getUnread();
            $unreadCount = count($unreadNotifications);

            return $this->respond([
                'status' => 'success',
                'unread_count' => $unreadCount,
                'notifications' => $unreadNotifications
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Failed to fetch notifications: ' . $e->getMessage());
        }
    }

    /**
     * Mark notifications as read
     * POST /api/notifications/mark-read
     */
    public function markRead()
    {
        $userId = session()->get('id_users');

        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        $data = $this->request->getJSON(true);
        $ids = $data['ids'] ?? [];

        if (empty($ids)) {
            return $this->failValidationErrors('Notification IDs are required');
        }

        try {
            $result = $this->notificationModel->markAsRead($ids);

            if ($result) {
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Notifications marked as read'
                ]);
            } else {
                return $this->fail('Failed to mark notifications as read');
            }
        } catch (\Exception $e) {
            return $this->failServerError('Failed to mark notifications: ' . $e->getMessage());
        }
    }

    /**
     * Mark all notifications as read (set is_read = 1)
     * POST /api/notifications/mark-all-read
     */
    public function markAllRead()
    {
        $userId = session()->get('id_users');

        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        try {
            // Get all unread notification IDs
            $unreadNotifications = $this->notificationModel->getUnread();
            $ids = array_column($unreadNotifications, 'id');

            if (empty($ids)) {
                return $this->respond([
                    'status' => 'success',
                    'message' => 'No unread notifications to mark'
                ]);
            }

            // Mark all unread notifications as read (set is_read = 1)
            $result = $this->notificationModel->markAsRead($ids);

            if ($result) {
                return $this->respond([
                    'status' => 'success',
                    'message' => 'All notifications marked as read'
                ]);
            } else {
                return $this->fail('Failed to mark all notifications as read');
            }
        } catch (\Exception $e) {
            return $this->failServerError('Failed to mark all notifications: ' . $e->getMessage());
        }
    }
}
