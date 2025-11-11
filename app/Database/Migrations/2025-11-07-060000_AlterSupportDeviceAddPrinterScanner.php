<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSupportDeviceAddPrinterScanner extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supportdevice', [
            'printer' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => true,
            ],
            'scanner' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supportdevice', ['printer', 'scanner']);
    }
}
