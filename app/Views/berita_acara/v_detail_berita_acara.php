<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Detail Berita Acara &mdash; Nirvana</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Detail Berita Acara</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('berita-acara'); ?>">Berita Acara</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-file-alt"></i> Detail Berita Acara</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('berita-acara/print/' . $berita_acara['beritaacara_id']); ?>" class="btn btn-secondary" target="_blank">
                                <i class="fas fa-print"></i> Print
                            </a>
                            <a href="<?= base_url('berita-acara/edit/' . $berita_acara['beritaacara_id']); ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('berita-acara'); ?>" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Jenis Kegiatan:</strong></label>
                                    <p class="text-primary h5"><?= esc($berita_acara['jenis_kegiatan']) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Tanggal & Waktu:</strong></label>
                                    <p class="h6"><?php
                                                    $bulan_indonesia = [
                                                        'January' => 'Januari',
                                                        'February' => 'Februari',
                                                        'March' => 'Maret',
                                                        'April' => 'April',
                                                        'May' => 'Mei',
                                                        'June' => 'Juni',
                                                        'July' => 'Juli',
                                                        'August' => 'Agustus',
                                                        'September' => 'September',
                                                        'October' => 'Oktober',
                                                        'November' => 'November',
                                                        'December' => 'Desember'
                                                    ];
                                                    $bulan = date('F', strtotime($berita_acara['tanggal']));
                                                    echo date('d', strtotime($berita_acara['tanggal'])) . ' ' . $bulan_indonesia[$bulan] . ' ' . date('Y, H:i', strtotime($berita_acara['tanggal'])) . ' WIB';
                                                    ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Lokasi:</strong></label>
                                    <p class="h6"><?= esc($berita_acara['lokasi']) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Pelaksana:</strong></label>
                                    <p class="h6"><?= esc($berita_acara['pelaksana']) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><strong>Keterangan:</strong></label>
                            <div class="border p-3 rounded bg-light">
                                <p class="mb-0" style="white-space: pre-line;"><?= esc($berita_acara['keterangan']) ?></p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle"></i> Informasi Tambahan</h6>
                                    <p class="mb-1"><strong>ID Berita Acara:</strong> #<?= esc($berita_acara['beritaacara_id']) ?></p>
                                    <p class="mb-0"><strong>Dibuat pada:</strong> <?= date('d/m/Y H:i', strtotime($berita_acara['tanggal'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>