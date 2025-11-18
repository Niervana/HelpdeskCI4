<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'title', 'message', 'data', 'is_read', 'created_at'];
    protected $useTimestamps = false;

    /**
     * Get all unread notifications, ordered by newest first
     */
    public function getUnread()
    {
        return $this->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Mark notifications as read by IDs (accepts array of IDs)
     */
    public function markAsRead($ids)
    {
        if (empty($ids)) {
            return false;
        }

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        return $this->whereIn('id', $ids)
            ->set(['is_read' => 1])
            ->update();
    }

    /**
     * Delete old read notifications (optional maintenance method)
     * Default: delete read notifications older than 7 days
     */
    public function deleteOld($days = 7)
    {
        $date = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        return $this->where('is_read', 1)
            ->where('created_at <', $date)
            ->delete();
    }
}
