<?php
$currentSegment = service('request')->getUri()->getSegment(1);
$user = userLogin();
$role = $user ? $user->role : null;

// Check for unsolved tickets for admin notification
$hasUnsolvedTickets = false;
if ($role == 1) {
    $db = \Config\Database::connect();
    $unsolvedCount = $db->table('tiket')->where('status', 'ongoing')->countAllResults();
    $hasUnsolvedTickets = $unsolvedCount > 0;
}
?>

<?php if ($role == 1): ?>
    <!-- Menu untuk Admin (Role 1) - Akses Penuh -->
    <li class="menu-header">Administrator</li>
    <li class="nav-item<?= ($currentSegment === 'berita-acara') ? ' active' : '' ?>">
        <a href="<?= base_url('berita-acara'); ?>" class="nav-link"><i class="fas fa-file-alt"></i> <span>Berita Acara</span></a>
    </li>
    <li class="nav-item<?= ($currentSegment === 'tiket') ? ' active' : '' ?>">
        <a href="<?= base_url('tiket'); ?>" class="nav-link"><i class="fas fa-ticket-simple<?= $hasUnsolvedTickets ? ' fa-beat' : '' ?>"></i> <span>Ticket</span></a>
    </li>
    <li class="nav-item<?= ($currentSegment === 'inventory') ? ' active' : '' ?>">
        <a href="<?= base_url('inventory'); ?>" class="nav-link"><i class="fas fa-solid fa-server"></i> <span>Inventory</span></a>
    </li>
    <li class="nav-item dropdown<?= ($currentSegment === 'cctv') ? ' active' : '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-video-camera"></i> <span>CCTV</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= base_url('cctv'); ?>">CCTV Inventory</a></li>
            <li><a class="nav-link" href="http://10.10.90.90/doc/page/login.asp?_1762828508144" target="_blank">Web Portal</a></li>
        </ul>
    </li>
    <li class="nav-item<?= ($currentSegment === 'download-script') ? ' active' : '' ?>">
        <a href="<?= base_url('download-script'); ?>" class="nav-link"><i class="fas fa-download"></i> <span>Download Script</span></a>
    </li>

<?php elseif ($role == 2): ?>
    <!-- Menu untuk User (Role 2) - Administrator Menu Disabled -->
    <li class="menu-header">Administrator</li>
    <li class="nav-item disabled">
        <a href="javascript:void(0)" class="nav-link" style="opacity: 0.5; cursor: not-allowed;" onclick="return false;">
            <i class="fas fa-file-alt"></i> <span>Berita Acara</span>
        </a>
    </li>
    <li class="nav-item disabled">
        <a href="javascript:void(0)" class="nav-link" style="opacity: 0.5; cursor: not-allowed;" onclick="return false;">
            <i class="fas fa-ticket-simple"></i> <span>Ticket</span>
        </a>
    </li>
    <li class="nav-item disabled">
        <a href="javascript:void(0)" class="nav-link" style="opacity: 0.5; cursor: not-allowed;" onclick="return false;">
            <i class="fas fa-solid fa-server"></i> <span>Inventory</span>
        </a>
    </li>
    <li class="nav-item dropdown disabled">
        <a href="javascript:void(0)" class="nav-link has-dropdown" style="opacity: 0.5; cursor: not-allowed;" onclick="return false;">
            <i class="fas fa-video-camera"></i> <span>CCTV</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="javascript:void(0)" style="opacity: 0.5; cursor: not-allowed;" onclick="return false;">CCTV Inventory</a></li>
            <li><a class="nav-link" href="javascript:void(0)" style="opacity: 0.5; cursor: not-allowed;" onclick="return false;">Web Portal</a></li>
        </ul>
    </li>
    <!-- Menu User yang Aktif -->
    <li class="menu-header">User</li>
    <li class="nav-item<?= ($currentSegment === '') ? ' active' : '' ?>">
        <a href="<?= base_url(''); ?>" class="nav-link"><i class="fas fa-solid fa-house-user"></i> <span>Dashboard</span></a>
    </li>
    <li class="nav-item<?= ($currentSegment === 'tiket') ? ' active' : '' ?>">
        <a href="<?= base_url('tiket'); ?>" class="nav-link"><i class="fas fa-ticket-simple"></i> <span>Ticket</span></a>
    </li>
    <li class="nav-item<?= ($currentSegment === 'download-script') ? ' active' : '' ?>">
        <a href="<?= base_url('download-script'); ?>" class="nav-link"><i class="fas fa-download"></i> <span>Download Script</span></a>
    </li>
<?php endif; ?>