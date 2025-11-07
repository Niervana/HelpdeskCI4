<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\LogModel;

class KaryawanModel extends Model
{
    protected $table      = 'karyawan';
    protected $primaryKey = 'karyawan_id';
    protected $allowedFields = ['nama_karyawan', 'departemen_karyawan'];

    // Event Hooks
    protected $afterInsert = ['logInsert'];
    protected $beforeUpdate = ['captureBeforeUpdate'];
    protected $afterUpdate  = ['logUpdate'];
    protected $beforeDelete = ['captureBeforeDelete'];
    protected $afterDelete  = ['logDelete'];

    // Temp data untuk menyimpan data sebelum perubahan
    protected $beforeData = [];

    public function total_rows()
    {
        return $this->db->table('karyawan')->countAll();
    }

    // ------------------------- 
    // Bagian Otomatis Logging
    // -------------------------

    protected function logInsert(array $data)
    {
        $log = new LogModel();

        $log->insert([
            'karyawan_id' => $data['id'] ?? $this->getInsertID(),
            'action_type'  => 'INSERT',
            'before_change' => null,
            'after_change' => json_encode($data['data']),
            'users_id'     => session()->get('user_id') ?? 0,
            'ip_address'   => service('request')->getIPAddress(true),
            'description'  => 'Menambahkan data baru ke karyawan',
        ]);

        return $data;
    }

    protected function captureBeforeUpdate(array $data)
    {
        if (isset($data['id'])) {
            $this->beforeData = $this->find($data['id'][0]);
        }
        return $data;
    }

    protected function logUpdate(array $data)
    {
        $log = new LogModel();
        $afterData = $this->find($data['id'][0]);

        $log->insert([
            'karyawan_id' => $data['id'][0],
            'action_type'  => 'UPDATE',
            'before_change' => json_encode($this->beforeData),
            'after_change' => json_encode($afterData),
            'users_id'     => session()->get('user_id') ?? 0,
            'ip_address'   => service('request')->getIPAddress(true),
            'description'  => 'Mengubah data karyawan ID ' . $data['id'][0],
        ]);

        return $data;
    }

    protected function captureBeforeDelete(array $data)
    {
        if (isset($data['id'])) {
            $this->beforeData = $this->find($data['id'][0]);
        }
        return $data;
    }

    protected function logDelete(array $data)
    {
        $log = new LogModel();

        $log->insert([
            'karyawan_id' => $data['id'][0],
            'action_type'  => 'DELETE',
            'before_change' => json_encode($this->beforeData),
            'after_change' => null,
            'users_id'     => session()->get('user_id') ?? 0,
            'ip_address'   => service('request')->getIPAddress(true),
            'description'  => 'Menghapus data karyawan ID ' . $data['id'][0],
        ]);

        return $data;
    }
}
