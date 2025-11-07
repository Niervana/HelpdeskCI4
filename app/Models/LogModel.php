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
}
