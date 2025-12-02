<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'log_id';
    protected $allowedFields = [
        'inventory_id',
        'nama_karyawan',
        'action_type',
        'before_change',
        'after_change',
        'users_id',
        'action_date',
        'ip_address',
        'description',
    ];

    // Validation rules
    protected $validationRules = [
        'users_id' => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'users_id' => [
            'required' => 'User ID is required for logging',
            'is_natural_no_zero' => 'User ID must be a valid positive integer'
        ]
    ];

    // Skip validation for batch operations if needed
    protected $skipValidation = false;

    /**
     * Override insert to validate users_id exists in users table
     */
    public function insert($data = null, bool $returnID = true)
    {
        // Validate that users_id exists in users table
        if (isset($data['users_id']) && $data['users_id'] !== null) {
            $db = \Config\Database::connect();
            $userExists = $db->table('users')
                ->where('id_users', $data['users_id'])
                ->countAllResults();

            if ($userExists === 0) {
                log_message('error', 'Attempted to log with non-existent user_id: ' . $data['users_id']);

                // Try to find a valid default user
                $defaultUser = $db->table('users')
                    ->where('role', 1)
                    ->get()
                    ->getFirstRow('array');

                if ($defaultUser && isset($defaultUser['id_users'])) {
                    $data['users_id'] = (int)$defaultUser['id_users'];
                    log_message('warning', 'Using default admin user for logging: ' . $data['users_id']);
                } else {
                    // Critical: no valid user found
                    throw new \RuntimeException('Cannot insert log: no valid user found in database');
                }
            }
        } else {
            // users_id is null or not set - try to use default
            $db = \Config\Database::connect();
            $defaultUser = $db->table('users')
                ->where('role', 1)
                ->get()
                ->getFirstRow('array');

            if ($defaultUser && isset($defaultUser['id_users'])) {
                $data['users_id'] = (int)$defaultUser['id_users'];
                log_message('info', 'No users_id provided, using default admin user: ' . $data['users_id']);
            } else {
                throw new \RuntimeException('Cannot insert log: users_id is required but not provided and no default user found');
            }
        }

        return parent::insert($data, $returnID);
    }
}
