<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class inventory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'inventory_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'karyawan_id'  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'main_id'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'support_id'  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('inventory_id', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'karyawan_id');
        $this->forge->addForeignKey('main_id', 'maindevice', 'main_id');
        $this->forge->addForeignKey('support_id', 'supportdevice', 'support_id');
        $this->forge->createTable('inventory');
    }

    public function down()
    {
        $this->forge->dropTable('inventory');
    }
}
