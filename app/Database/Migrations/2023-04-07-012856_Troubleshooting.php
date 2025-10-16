<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Troubleshooting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ts_id' => [
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
            'device_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'trouble' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('ts_id', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'karyawan_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('device_id', 'device', 'device_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('troubleshooting');
    }

    public function down()
    {
        $this->forge->dropTable('troubleshooting');
    }
}
