<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLogForeignKey extends Migration
{
    public function up()
    {
        // Drop the existing foreign key
        $this->forge->dropForeignKey('log', 'log_inventory_id_foreign');

        // Add the new foreign key with SET NULL on delete
        $this->forge->addForeignKey('inventory_id', 'inventory', 'inventory_id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        // Drop the SET NULL foreign key
        $this->forge->dropForeignKey('log', 'log_inventory_id_foreign');

        // Re-add the CASCADE foreign key (reverting to original)
        $this->forge->addForeignKey('inventory_id', 'inventory', 'inventory_id', 'CASCADE', 'CASCADE');
    }
}
