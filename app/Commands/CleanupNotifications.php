<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CleanupNotifications extends BaseCommand
{
    protected $group       = 'Maintenance';
    protected $name        = 'notifications:cleanup';
    protected $description = 'Hapus notifikasi lama yang sudah dibaca';

    public function run(array $params)
    {
        $notifModel = new \App\Models\NotificationModel();
        $deleted = $notifModel->deleteOld(7); // Hapus yang > 7 hari

        CLI::write("Berhasil menghapus {$deleted} notifikasi lama.", 'green');
    }
}
