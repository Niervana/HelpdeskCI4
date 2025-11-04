<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class log extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'log_id'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'log_type'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'before_change'  => ['type' => 'TEXT', 'null' => true],
            'after_change'   => ['type' => 'TEXT', 'null' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'action_date'    => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('log_id', true);
        $this->forge->createTable('log');
    }

    public function down()
    {
        $this->forge->dropTable('log');
    }
}
