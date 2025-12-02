<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Dashboard &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('CSS') ?>
<!-- No external libraries needed for this dashboard -->
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
        <!-- Statistics Cards -->
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
                        <h4><i class="fas fa-desktop"></i> Perangkat Anda</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($user_devices) && is_array($user_devices)): ?>
                            <?php foreach ($user_devices as $device): ?>
                                <!-- Centered Main and Support Device Cards -->
                                <div class="row justify-content-center">
                                    <!-- Main Device Card -->
                                    <div class="col-md-6 col-lg-5 mb-4">
                                        <div class="card h-100 border-primary shadow-sm">
                                            <div class="card-header bg-primary text-white text-center">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-laptop"></i> Perangkat Utama
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if (isset($device->main_id) && $device->main_id): ?>
                                                    <div class="row text-center">
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-building fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>Manufaktur</strong></p>
                                                            <small class="text-muted"><?= esc($device->manufaktur ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-cogs fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>Jenis</strong></p>
                                                            <small class="text-muted"><?= esc($device->jenis ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-microchip fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>CPU</strong></p>
                                                            <small class="text-muted"><?= esc($device->cpu ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-memory fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>RAM</strong></p>
                                                            <small class="text-muted"><?= esc($device->ram ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-hdd fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>Storage</strong></p>
                                                            <small class="text-muted"><?= esc($device->storage ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fa-brands fa-windows fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>OS</strong></p>
                                                            <small class="text-muted"><?= esc($device->os ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-user-shield fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>Hostname</strong></p>
                                                            <small class="text-muted"><?= esc($device->hostname ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <i class="fas fa-network-wired fa-2x text-primary mb-2"></i>
                                                            <p class="mb-1"><strong>IP Address</strong></p>
                                                            <small class="text-muted"><?= esc($device->ipaddress ?? 'N/A') ?></small>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="text-center py-4">
                                                        <i class="fas fa-laptop fa-4x text-muted mb-3"></i>
                                                        <h6 class="text-muted">Data perangkat utama belum tersedia</h6>
                                                        <p class="text-muted small">Silakan lengkapi data perangkat Anda</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Support Device Card -->
                                    <div class="col-md-6 col-lg-5 mb-4">
                                        <div class="card h-100 border-info shadow-sm">
                                            <div class="card-header bg-info text-white text-center">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-mouse"></i> Perangkat Pendukung
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if (isset($device->support_id) && $device->support_id): ?>
                                                    <div class="row text-center">
                                                        <?php if (!empty($device->monitor)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-desktop fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>Monitor</strong></p>
                                                                <small class="text-muted"><?= esc($device->monitor) ?></small>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($device->keyboard)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-keyboard fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>Keyboard</strong></p>
                                                                <small class="text-muted"><?= esc($device->keyboard) ?></small>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($device->mouse)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-mouse fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>Mouse</strong></p>
                                                                <small class="text-muted"><?= esc($device->mouse) ?></small>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($device->printer)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-print fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>Printer</strong></p>
                                                                <small class="text-muted"><?= esc($device->printer) ?></small>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($device->scanner)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-scanner fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>Scanner</strong></p>
                                                                <small class="text-muted"><?= esc($device->scanner) ?></small>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($device->usb_converter)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-usb-drive fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>USB Converter</strong></p>
                                                                <small class="text-muted"><?= esc($device->usb_converter) ?></small>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($device->external_storage)): ?>
                                                            <div class="col-6 mb-3">
                                                                <i class="fas fa-hdd fa-2x text-info mb-2"></i>
                                                                <p class="mb-1"><strong>External Storage</strong></p>
                                                                <small class="text-muted"><?= esc($device->external_storage) ?> GB</small>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if (empty(array_filter([
                                                        $device->monitor,
                                                        $device->keyboard,
                                                        $device->mouse,
                                                        $device->printer,
                                                        $device->scanner,
                                                        $device->usb_converter,
                                                        $device->external_storage
                                                    ]))): ?>
                                                        <div class="text-center py-4">
                                                            <i class="fas fa-mouse fa-3x text-muted mb-3"></i>
                                                            <p class="text-muted small">Tidak ada perangkat pendukung yang tercatat</p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="text-center py-4">
                                                        <i class="fas fa-mouse fa-4x text-muted mb-3"></i>
                                                        <h6 class="text-muted">Data perangkat pendukung belum tersedia</h6>
                                                        <p class="text-muted small">Silakan lengkapi data perangkat pendukung Anda</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- Call to Action -->
                            <div class="text-center mt-4">
                                <div class="alert alert-info d-inline-block">
                                    <i class="fas fa-info-circle"></i> <strong>Informasi:</strong>
                                    Hubungi IT untuk melengkapi atau memperbarui data perangkat Anda.
                                    <a href="<?= base_url('download-script'); ?>" class="alert-link ml-2">
                                        <i class="fas fa-download"></i> Download Script Inventory
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-desktop fa-5x text-muted mb-4"></i>
                                <h5 class="text-muted mb-3">Tidak ada data perangkat yang tersedia</h5>
                                <p class="text-muted mb-4">Silakan lengkapi data perangkat Anda untuk monitoring yang lebih baik.</p>
                                <a href="<?= base_url('download-script'); ?>" class="btn btn-primary btn-lg">
                                    <i class="fas fa-download"></i> Download Script Inventory
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Berita Acara -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-file-alt"></i> Berita Acara Terbaru</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('berita-acara'); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        $recentBeritaAcara = array_slice($berita_acara ?? [], 0, 5); // Show only 5 most recent
                        if (!empty($recentBeritaAcara)):
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="20%">Jenis Kegiatan</th>
                                            <th width="20%">Lokasi</th>
                                            <th width="20%">Pelaksana</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="25%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recentBeritaAcara as $ba): ?>
                                            <tr>
                                                <td>
                                                    <strong class="text-primary"><?= esc($ba['jenis_kegiatan'] ?? 'N/A') ?></strong>
                                                </td>
                                                <td>
                                                    <i class="fas fa-map-marker-alt text-muted"></i> <?= esc($ba['lokasi'] ?? 'N/A') ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-user text-muted"></i> <?= esc($ba['pelaksana'] ?? 'N/A') ?>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar text-muted"></i>
                                                        <?= isset($ba['tanggal']) ? date('d M Y', strtotime($ba['tanggal'])) : 'N/A' ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        <?= isset($ba['keterangan']) ? esc(substr($ba['keterangan'], 0, 60)) . (strlen($ba['keterangan']) > 60 ? '...' : '') : 'N/A' ?>
                                                    </small>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data Berita Acara</h5>
                                <p class="text-muted">Berita acara kegiatan akan ditampilkan di sini.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>