<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class maindevice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'main_id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'manufaktur' => ['type' => 'VARCHAR', 'constraint' => 75],
            'jenis'      => ['type' => 'VARCHAR', 'constraint' => 75],
            'cpu'        => ['type' => 'VARCHAR', 'constraint' => 75],
            'ram'        => ['type' => 'VARCHAR', 'constraint' => 50],
            'os'         => ['type' => 'VARCHAR', 'constraint' => 75],
            'lisensi'    => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'ipaddress'  => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'hostname'   => ['type' => 'VARCHAR', 'constraint' => 75, 'null' => true],
            'credential' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        ]);
        $this->forge->addKey('main_id', true);
        $this->forge->createTable('maindevice');
    }

    public function down()
    {
        $this->forge->dropTable('maindevice');
    }
}
