<!-- title -->
<?= $this->section('title') ?>
<title>Detail CCTV &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Detail CCTV</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('cctv') ?>"><span class="btn btn-dark"><i class="fas fa-arrow-left"></i> &ensp;<span>Kembali</span></span></a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi CCTV</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="30%"><strong>Lokasi</strong></td>
                                        <td>: <?= esc($cctv['lokasi']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tipe Kamera</strong></td>
                                        <td>: <?= esc($cctv['tipe_kamera']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Merk</strong></td>
                                        <td>: <?= esc($cctv['merk']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Model</strong></td>
                                        <td>: <?= esc($cctv['model']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Serial Number</strong></td>
                                        <td>: <?= esc($cctv['serial_number']) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="30%"><strong>IP Address</strong></td>
                                        <td>: <?= esc($cctv['ip_address']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>: <span class="badge badge-<?= $cctv['status'] === 'Active' ? 'success' : ($cctv['status'] === 'Inactive' ? 'danger' : 'warning') ?>"><?= esc($cctv['status']) ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keterangan</strong></td>
                                        <td>: <?= esc($cctv['keterangan'] ?: '-') ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created At</strong></td>
                                        <td>: <?= $cctv['created_at'] ? date('d/m/Y H:i:s', strtotime($cctv['created_at'])) : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Updated At</strong></td>
                                        <td>: <?= $cctv['updated_at'] ? date('d/m/Y H:i:s', strtotime($cctv['updated_at'])) : '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="<?= site_url('cctv/edit/' . $cctv['id']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <a href="<?= site_url('cctv') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>