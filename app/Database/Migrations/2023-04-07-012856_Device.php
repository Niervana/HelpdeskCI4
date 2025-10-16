<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Device extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'device_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'merk_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'spesifikasi_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'lokasi_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'status_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Aktif',
            ],
            'password_device' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('device_id', true);
        $this->forge->createTable('device');
    }

    public function down()
    {
        $this->forge->dropTable('device');
    }
}
