<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class supportdevice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'support_id'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'monitor'           => ['type' => 'VARCHAR', 'constraint' => 75, 'null' => true],
            'keyboard'          => ['type' => 'VARCHAR', 'constraint' => 75, 'null' => true],
            'mouse'             => ['type' => 'VARCHAR', 'constraint' => 75, 'null' => true],
            'usb_converter'     => ['type' => 'VARCHAR', 'constraint' => 75, 'null' => true],
            'external_storage'  => ['type' => 'VARCHAR', 'constraint' => 75, 'null' => true],
        ]);
        $this->forge->addKey('support_id', true);
        $this->forge->createTable('supportdevice');
    }

    public function down()
    {
        $this->forge->dropTable('supportdevice');
    }
}
