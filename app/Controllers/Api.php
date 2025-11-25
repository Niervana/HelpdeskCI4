<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\NotificationModel;
use App\Models\UsersModel;
use App\Models\KaryawanModel;
use App\Models\InventoryModel;

class Api extends ResourceController
{
    protected $notificationModel;
    protected $usersModel;
    protected $karyawanModel;
    protected $inventoryModel;
    protected $db;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->usersModel = new UsersModel();
        $this->karyawanModel = new KaryawanModel();
        $this->inventoryModel = new InventoryModel();
        $this->db = \Config\Database::connect();
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

    /**
     * Update main device inventory from external script
     * POST /api/update-main-device
     */
    public function updateMainDevice()
    {
        $data = $this->request->getJSON(true);
        $email = $data['email'] ?? null;
        $deviceData = $data['data'] ?? [];

        if (!$email || empty($deviceData)) {
            return $this->failValidationErrors('Email and data are required');
        }

        try {
            // First, try to find user by email (for registered users)
            $user = $this->usersModel->where('email_users', $email)->first();

            if ($user) {
                // User exists, validate and proceed with user-based lookup
                if (!isset($user['id_users']) || empty($user['id_users']) || !is_numeric($user['id_users'])) {
                    return $this->failServerError('Invalid user data: missing or invalid user ID');
                }

                $userExists = $this->usersModel->find($user['id_users']);
                if (!$userExists) {
                    return $this->failServerError('User validation failed: user ID does not exist in database');
                }

                // Find karyawan by nama_karyawan matching user's nama_users
                $karyawan = $this->karyawanModel->where('nama_karyawan', $user['nama_users'])->first();
                if (!$karyawan) {
                    return $this->failNotFound('Employee record not found. Please contact IT administrator to create your employee profile.');
                }
            } else {
                // User not found, try to find karyawan by extracting name from email
                // This allows the script to work for employees who don't have user accounts
                $emailParts = explode('@', $email);
                if (count($emailParts) !== 2) {
                    return $this->failNotFound('Invalid email format. Please use a valid email address.');
                }

                $possibleName = $emailParts[0];

                // Try different name formats (firstname, firstname.lastname, etc.)
                $nameVariations = [
                    ucwords(str_replace(['.', '_', '-'], ' ', $possibleName)), // Convert dots/underscores to spaces
                    ucwords(str_replace(['_', '-'], ' ', $possibleName)), // Handle firstname.lastname format
                    $possibleName // Original format
                ];

                $karyawan = null;
                foreach ($nameVariations as $name) {
                    $karyawan = $this->karyawanModel->where('nama_karyawan', $name)->first();
                    if ($karyawan) {
                        break;
                    }
                }

                if (!$karyawan) {
                    return $this->failNotFound('Employee record not found. Please contact IT administrator to create your employee profile or ensure your email matches your employee name.');
                }

                // For non-registered users, we'll use a default user ID (admin) for logging
                $user = ['id_users' => 1]; // Default to first admin user for logging
            }

            // Find inventory by karyawan_id
            $inventory = $this->inventoryModel->where('karyawan_id', $karyawan['karyawan_id'])->first();
            if (!$inventory) {
                return $this->failNotFound('Inventory record not found. Please contact IT administrator to create your inventory record.');
            }

            // Prepare maindevice data
            // Note: manufaktur now collected automatically by script
            // jenis, lisensi_windows, credential, office, lisensi_office
            // will be filled manually by admin (role 1) through the web interface
            $mainDeviceData = [
                'manufaktur' => $deviceData['manufaktur'] ?? null,
                'cpu' => $deviceData['cpu'] ?? null,
                'ram' => $deviceData['ram'] ?? null,
                'os' => $deviceData['os'] ?? null,
                'ipaddress' => $deviceData['ipaddress'] ?? null,
                'hostname' => $deviceData['hostname'] ?? null,
                'storage' => $deviceData['storage'] ?? null,
            ];

            // Insert or update maindevice
            if ($inventory['main_id']) {
                // Update existing
                $this->db->table('maindevice')->where('main_id', $inventory['main_id'])->update($mainDeviceData);

                // Log the update
                $logData = [
                    'inventory_id' => $inventory['inventory_id'],
                    'nama_karyawan' => $karyawan['nama_karyawan'],
                    'action_type' => 'update',
                    'before_change' => json_encode($this->db->table('maindevice')->where('main_id', $inventory['main_id'])->get()->getRowArray()),
                    'after_change' => json_encode($mainDeviceData),
                    'users_id' => $user['id_users'], // Use the actual user ID from the found user
                    'action_date' => date('Y-m-d H:i:s'),
                    'ip_address' => $this->request->getIPAddress(),
                    'description' => 'Main device updated via API script'
                ];
                $this->db->table('log')->insert($logData);
            } else {
                // Insert new
                $this->db->table('maindevice')->insert($mainDeviceData);
                $mainId = $this->db->insertID();
                // Update inventory with main_id
                $this->inventoryModel->update($inventory['inventory_id'], ['main_id' => $mainId]);

                // Log the creation
                $logData = [
                    'inventory_id' => $inventory['inventory_id'],
                    'nama_karyawan' => $karyawan['nama_karyawan'],
                    'action_type' => 'create',
                    'before_change' => null,
                    'after_change' => json_encode($mainDeviceData),
                    'users_id' => $user['id_users'], // Use the actual user ID from the found user
                    'action_date' => date('Y-m-d H:i:s'),
                    'ip_address' => $this->request->getIPAddress(),
                    'description' => 'Main device created via API script'
                ];
                $this->db->table('log')->insert($logData);
            }

            return $this->respond([
                'status' => 'success',
                'message' => 'Inventory updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Failed to update inventory: ' . $e->getMessage());
        }
    }
}
