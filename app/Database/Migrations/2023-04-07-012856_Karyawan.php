<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'karyawan_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_karyawan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'departemen_karyawan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'create_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'device_aktif' => [ // opsional
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('karyawan_id', true);
        $this->forge->addForeignKey('device_aktif', 'device', 'device_id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
