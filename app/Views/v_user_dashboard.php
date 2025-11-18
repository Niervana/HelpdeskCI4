<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Dashboard &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('CSS') ?>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<!-- fullcalendar.js -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1/index.global.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>


<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-ticket-simple"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tiket Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <?= $today_count ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tiket Minggu Ini</h4>
                        </div>
                        <div class="card-body">
                            <?= $week_count ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tiket Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <?= $month_count ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Tiket</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_count ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Device Information -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Perangkat Anda</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($user_devices)): ?>
                            <div class="row">
                                <?php foreach ($user_devices as $device): ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <i class="fas fa-desktop"></i> Your Device
                                                </h6>
                                                <?php if ($device->main_id): ?>
                                                    <p class="card-text mb-1"><i class="fas fa-building"></i> <strong>Manufaktur:</strong> <?= esc($device->manufaktur) ?></p>
                                                    <p class="card-text mb-1"><i class="fas fa-laptop"></i> <strong>Jenis:</strong> <?= esc($device->jenis) ?></p>
                                                    <p class="card-text mb-1"><i class="fas fa-microchip"></i> <strong>CPU:</strong> <?= esc($device->cpu) ?></p>
                                                    <p class="card-text mb-1"><i class="fas fa-memory"></i> <strong>RAM:</strong> <?= esc($device->ram) ?> GB</p>
                                                    <p class="card-text mb-1"><i class="fas fa-hdd"></i> <strong>Storage:</strong> <?= esc($device->storage) ?> GB</p>
                                                    <p class="card-text mb-1"><i class="fa-brands fa-windows"></i> <strong>OS:</strong> <?= esc($device->os) ?></p>
                                                    <p class="card-text mb-1"><i class="fas fa-user-shield"></i> <strong>Hostname:</strong> <?= esc($device->hostname) ?></p>
                                                    <p class="card-text mb-1"><i class="fas fa-network-wired"></i> <strong>IP Address:</strong> <?= esc($device->ipaddress) ?></p>
                                                    <p class="card-text mb-1"><i class="fas fa-block-brick-fire"></i> <strong>Credential:</strong> <?= esc($device->credential) ?></p>

                                                <?php else: ?>
                                                    <p class="card-text text-muted">Tidak ada data device</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <i class="fas fa-mouse"></i> Perangkat Pendukung
                                                </h6>
                                                <?php if ($device->support_id): ?>
                                                    <?php if ($device->monitor): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-desktop"></i> <strong>Monitor:</strong> <?= esc($device->monitor) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($device->keyboard): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-keyboard"></i> <strong>Keyboard:</strong> <?= esc($device->keyboard) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($device->mouse): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-mouse"></i> <strong>Mouse:</strong> <?= esc($device->mouse) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($device->printer): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-print"></i> <strong>Printer:</strong> <?= esc($device->printer) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($device->scanner): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-scanner"></i> <strong>Scanner:</strong> <?= esc($device->scanner) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($device->usb_converter): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-usb-drive"></i> <strong>USB Converter:</strong> <?= esc($device->usb_converter) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($device->external_storage): ?>
                                                        <p class="card-text mb-1"><i class="fas fa-hdd"></i> <strong>External Storage:</strong> <?= esc($device->external_storage) ?> GB</p>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <p class="card-text text-muted">Tidak ada data support device</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="text-center">
                                <p class="text-info"><i class="fas fa-info-circle"></i> Tolong hubungi admin IT, untuk melengkapi data perangkat</p>
                            </div>
                        <?php else: ?>
                            <div class="text-center">
                                <p class="text-muted">Tidak ada data perangkat yang tersedia</p>
                                <p class="text-info"><i class="fas fa-info-circle"></i> Tolong hubungi admin IT, untuk melengkapi data perangkat</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>