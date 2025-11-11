<?php $currentSegment = service('request')->getUri()->getSegment(1); ?>

<li class="menu-header">Side Menu</li>

<!-- new -->
<li class="nav-item<?= ($currentSegment === 'tiket') ? ' active' : '' ?>">
    <a href="<?= base_url('tiket'); ?>" class="nav-link"><i class="fas fa-ticket-simple fa-beat"></i> <span>Ticket</span></a>
</li>
<li class="nav-item<?= ($currentSegment === 'inventory') ? ' active' : '' ?>">
    <a href="<?= base_url('inventory'); ?>" class="nav-link"><i class="fas fa-solid fa-server"></i> <span>Inventory</span></a>
</li>
<!-- <li class="nav-item<?= ($currentSegment === '-') ? ' active' : '' ?>">
    <a href="<?= base_url('-'); ?>" class="nav-link"><i class="fas fa-solid fa-repeat"></i> <span>Device Exchange</span></a>
</li> -->


<!-- old -->
<!-- <li class=" nav-item">
            <a href="<?= base_url('forgetfp'); ?>" class="nav-link"><i class="far fa-clipboard-user fa-beat"></i> <span>Fingerprint Access</span></a>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-business-time fa-bounce"></i> <span>TimeSheet</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('attendance'); ?>">Attendance</a></li>
        <li><a class="nav-link" href="<?= base_url('officeshift'); ?>">Config Sift</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Config Libur</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Request Cuti</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-spreadsheet"></i> <span>Report</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Daily</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Mountly</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Date Wish</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-people-group"></i> <span>Inventory</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('karyawan'); ?>">Datalist Karyawan</a></li>
        <li><a class="nav-link" href="<?= base_url('kontrak'); ?>">Datalist Kontrak</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Magang</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('pkl'); ?>">Datalist Magang</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Penilaian</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-duotone fa-envelope-open-text"></i> <span>Sertifikat</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 1</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 2</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 3</a></li>
    </ul>
</li>

<li class=" menu-header">Finansial</li>
<li class="active"><a class="nav-link" href="<?= base_url(''); ?>"><i class="fas fa-money-check-dollar"></i><span>Finance</span></a></li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-check-dollar"></i> <span>Finance</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 1</a></li>
        <li><a class="nav-link beep beep-sidebar" href="<?= base_url(''); ?>">Menu 2</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 3</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calculator"></i> <span>Payroll</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 1</a></li>
        <li><a class="nav-link beep beep-sidebar" href="<?= base_url(''); ?>">Menu 2</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 3</a></li>
    </ul>
</li>
<li class=" menu-header">Request</li>
<li class="nav-item dropdown">
    <a href="<?= base_url('tiket'); ?>" class="nav-link"><i class="fas fa-ticket-simple"></i> <span>Ticket</span></a>
</li>

<li class=" menu-header">IT</li>
<li class="nav-item">
    <a href="<?= base_url('account'); ?>" class="nav-link"><i class="fas fa-user"></i> <span>User</span></a>
</li>
<li class="nav-item">
    <a href="<?= base_url('tiket/reply'); ?>" class="nav-link"><i class="fas fa-ticket"></i> <span>Tiket Request</span></a>
</li> -->