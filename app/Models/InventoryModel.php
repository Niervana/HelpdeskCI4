<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\LogModel;

class InventoryModel extends Model
{
    protected $table      = 'inventory';
    protected $primaryKey = 'inventory_id';
    protected $allowedFields = ['karyawan_id', 'main_id', 'support_id'];

    // Event Hooks
    protected $afterInsert = ['logInsert'];
    protected $beforeUpdate = ['captureBeforeUpdate'];
    protected $afterUpdate  = ['logUpdate'];
    protected $beforeDelete = ['captureBeforeDelete', 'logDelete'];
    protected $afterDelete  = [];

    // Temp data untuk menyimpan data sebelum perubahan
    protected $beforeData = [];

    public function total_rows()
    {
        return $this->db->table('inventory')->countAll();
    }

    public function getInventoryWithDetails($id)
    {
        return $this->db->table('inventory')
            ->select('inventory.*, karyawan.nama_karyawan, karyawan.departemen_karyawan, maindevice.*, supportdevice.*, users.email_users, users.password_users')
            ->join('karyawan', 'karyawan.karyawan_id = inventory.karyawan_id')
            ->join('maindevice', 'maindevice.main_id = inventory.main_id', 'left')
            ->join('supportdevice', 'supportdevice.support_id = inventory.support_id', 'left')
            ->join('users', 'users.nama_users = karyawan.nama_karyawan', 'left')
            ->where('inventory.inventory_id', $id)
            ->get()
            ->getRow();
    }

    public function getAllInventory()
    {
        return $this->db->table('inventory')
            ->select('inventory.*, karyawan.nama_karyawan, karyawan.departemen_karyawan, maindevice.*, supportdevice.*')
            ->join('karyawan', 'karyawan.karyawan_id = inventory.karyawan_id')
            ->join('maindevice', 'maindevice.main_id = inventory.main_id', 'left')
            ->join('supportdevice', 'supportdevice.support_id = inventory.support_id', 'left')
            ->get()
            ->getResult();
    }

    // -------------------------
    // Bagian Otomatis Logging
    // -------------------------

    protected function logInsert(array $data)
    {
        $log = new LogModel();

        $log->insert([
            'inventory_id' => $data['id'] ?? $this->getInsertID(),
            'action_type'  => 'INSERT',
            'before_change' => null,
            'after_change' => json_encode($data['data']),
            'users_id'     => session()->get('user_id') ?? 0,
            'ip_address'   => service('request')->getIPAddress(true),
            'description'  => 'Menambahkan data baru ke inventory',
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
            'inventory_id' => $data['id'][0],
            'action_type'  => 'UPDATE',
            'before_change' => json_encode($this->beforeData),
            'after_change' => json_encode($afterData),
            'users_id'     => session()->get('user_id') ?? 0,
            'ip_address'   => service('request')->getIPAddress(true),
            'description'  => 'Mengubah data inventory ID ' . $data['id'][0],
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
            'inventory_id' => $data['id'][0],
            'action_type'  => 'DELETE',
            'before_change' => json_encode($this->beforeData),
            'after_change' => null,
            'users_id'     => session()->get('user_id') ?? 0,
            'ip_address'   => service('request')->getIPAddress(true),
            'description'  => 'Menghapus data inventory ID ' . $data['id'][0],
        ]);

        return $data;
    }
}
