<?php
require_once 'vendor/autoload.php';
require_once 'app/Config/Database.php';

$db = \Config\Database::connect();

$tickets = $db->table('tiket')->countAll();
echo 'Total tickets: ' . $tickets . PHP_EOL;

$ongoing = $db->table('tiket')->where('status', 'ongoing')->countAllResults();
echo 'Ongoing tickets: ' . $ongoing . PHP_EOL;

$solved = $db->table('tiket')->where('status', 'solved')->countAllResults();
echo 'Solved tickets: ' . $solved . PHP_EOL;

$today = $db->table('tiket')->where('DATE(create_date)', date('Y-m-d'))->countAllResults();
echo 'Today tickets: ' . $today . PHP_EOL;

// Show some sample tickets
echo PHP_EOL . 'Sample tickets:' . PHP_EOL;
$tickets = $db->table('tiket')->limit(5)->get()->getResult();
foreach ($tickets as $ticket) {
    echo 'ID: ' . $ticket->tiket_id . ', Status: ' . $ticket->status . ', Date: ' . $ticket->create_date . PHP_EOL;
}
