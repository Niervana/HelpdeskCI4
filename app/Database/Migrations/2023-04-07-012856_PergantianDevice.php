<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogPergantianDevice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'log_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'karyawan_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'device_lama' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'device_baru' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('log_id', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'karyawan_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('device_lama', 'device', 'device_id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('device_baru', 'device', 'device_id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('log_pergantian_device');
    }

    public function down()
    {
        $this->forge->dropTable('log_pergantian_device');
    }
}
