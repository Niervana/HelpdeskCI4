<?php
// Simple script to check tickets in database
require_once 'app/Config/Database.php';

use Config\Database;

$db = Database::connect();

echo "Checking tickets in database...\n";

// Count all tickets
$totalTickets = $db->table('tiket')->countAll();
echo "Total tickets in database: $totalTickets\n";

// Count tickets by status
$ongoing = $db->table('tiket')->where('status', 'ongoing')->countAllResults();
$solved = $db->table('tiket')->where('status', 'solved')->countAllResults();
echo "Ongoing tickets: $ongoing\n";
echo "Solved tickets: $solved\n";

// Check today's tickets
$today = date('Y-m-d');
$todayTickets = $db->table('tiket')
    ->where('DATE(create_date)', $today)
    ->countAllResults();
echo "Today's tickets: $todayTickets\n";

// Get sample tickets
$tickets = $db->table('tiket')
    ->select('tiket.*, nama_karyawan, departemen_karyawan')
    ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
    ->orderBy('tiket.create_date', 'DESC')
    ->limit(10)
    ->get()
    ->getResultArray();

echo "\nSample tickets (last 10):\n";
foreach ($tickets as $ticket) {
    echo "- ID: {$ticket['tiket_id']}, Name: {$ticket['nama_karyawan']}, Type: {$ticket['jenis_tiket']}, Status: {$ticket['status']}, Date: {$ticket['create_date']}\n";
}
