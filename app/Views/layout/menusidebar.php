<?php $currentSegment = service('request')->getUri()->getSegment(1); ?>

<li class="menu-header">Administrator</li>
<li class="nav-item<?= ($currentSegment === 'tiket') ? ' active' : '' ?>">
    <a href="<?= base_url('tiket'); ?>" class="nav-link"><i class="fas fa-ticket-simple fa-beat"></i> <span>Ticket</span></a>
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
<li class="menu-header">User</li>
<li class="nav-item<?= ($currentSegment === '-') ? ' active' : '' ?>">
    <a href="<?= base_url('-'); ?>" class="nav-link"><i class="fas fa-solid fa-house-user"></i></i> <span>Dashboard</span></a>
</li>
<li class="nav-item<?= ($currentSegment === '-') ? ' active' : '' ?>">
    <a href="<?= base_url('-'); ?>" class="nav-link"><i class="fas fa-ticket-simple"></i> <span>Ticket</span></a>
</li>