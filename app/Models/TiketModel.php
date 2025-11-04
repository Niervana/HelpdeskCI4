<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'tiket_id';
    protected $allowedFields = ['karyawan_id', 'jenis_tiket', 'desk_tiket', 'status', 'create_date'];
    protected $useTimestamps = false;
}
