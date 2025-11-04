<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table      = 'inventory';
    protected $primaryKey = 'inventory_id';
    protected $allowedFields = ['karyawan_id', 'main_id', 'support_id'];

    public function total_rows()
    {
        return $this->db->table('inventory')->countAll();
    }

    public function getInventoryWithDetails($id)
    {
        return $this->db->table('inventory')
            ->select('inventory.*, karyawan.nama_karyawan, karyawan.departemen_karyawan, maindevice.*, supportdevice.*')
            ->join('karyawan', 'karyawan.karyawan_id = inventory.karyawan_id')
            ->join('maindevice', 'maindevice.main_id = inventory.main_id', 'left')
            ->join('supportdevice', 'supportdevice.support_id = inventory.support_id', 'left')
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
}
