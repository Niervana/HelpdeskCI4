<!-- <li class="menu-header">Dashboard</li> -->
<!-- <li class="nav-item">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="#">Dashboard 1</a></li>
        <li><a class="nav-link" href="#">Dashboard 2</a></li>
    </ul>
</li> -->
<li class="menu-header">HRM</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-clipboard-user fa-beat"></i> <span>Absensi</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('absenstaff'); ?>">Staff</a></li>
        <li><a class="nav-link" href="<?= base_url('absenoperator'); ?>">Operator</a></li>
        <li><a class="nav-link" href="<?= base_url('userdatafingerprint'); ?>">Userdata</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-people-group"></i> <span>Human Resource</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url('karyawan'); ?>">Data Karyawan</a></li>
        <li><a class="nav-link" href="<?= base_url('kontrak'); ?>">Kontrak Aktif</a></li>
        <li><a class="nav-link" href="<?= base_url('pkl'); ?>">Pelatihan Kerja Lapangan</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-duotone fa-envelope-open-text"></i> <span>Surat</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 1</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 2</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 3</a></li>
    </ul>
</li>

<li class=" menu-header">Finansial</li>
<!-- <li class="active"><a class="nav-link" href="<?= base_url(''); ?>"><i class="fas fa-money-check-dollar"></i><span>Finance</span></a></li> -->
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-check-dollar"></i> <span>Finance</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 1</a></li>
        <li><a class="nav-link beep beep-sidebar" href="<?= base_url(''); ?>l">Menu 2</a></li>
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 3</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calculator"></i> <span>Payroll</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= base_url(''); ?>">Menu 1</a></li>
        <li><a class="nav-link beep beep-sidebar" href="<?= base_url(''); ?>l">Menu 2</a></li>
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
</li>