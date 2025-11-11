<!-- title -->
<?= $this->section('title') ?>
<title>Details Inventory &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- header -->
<?= $this->section('header') ?>
<div class="main-wrapper main-wrapper-1">
    <?= $this->endSection() ?>
    <?= $this->extend('layout/default') ?>
    <!-- konten -->
    <?= $this->section('content') ?>
    <!-- awal -->
    <section class="section">
        <div class="section-header">
            <h1>Details Inventory</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('inventory'); ?>">Tabel Data Inventory</a></div>
                <div class="breadcrumb-item">Detail Inventory</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card">
                        <div class="card-header">
                            <figure class="avatar mr-2 avatar-xl">
                                <img src="/avatar-2.png" alt="avatar">
                            </figure>
                            <h4><?php echo $inventory->nama_karyawan; ?></h4>
                        </div>
                        <div class="card-body">
                            <h5>Data Karyawan</h5>
                            <h6>Nama Karyawan: <?php echo $inventory->nama_karyawan; ?></h6>
                            <h6>Departemen: <?php echo $inventory->departemen_karyawan; ?></h6>

                            <h5>Main Device</h5>
                            <h6>Manufaktur: <?php echo $inventory->manufaktur ?: '-'; ?></h6>
                            <h6>Jenis: <?php echo $inventory->jenis ?: '-'; ?></h6>
                            <h6>CPU: <?php echo $inventory->cpu ?: '-'; ?></h6>
                            <h6>RAM: <?php echo $inventory->ram ?: '-'; ?></h6>
                            <h6>OS: <?php echo $inventory->os ?: '-'; ?></h6>
                            <h6>Lisensi Windows: <?php echo $inventory->lisensi_windows ?: '-'; ?></h6>
                            <h6>Storage: <?php echo $inventory->storage ?: '-'; ?></h6>
                            <h6>Office: <?php echo $inventory->office ?: '-'; ?></h6>
                            <h6>Lisensi Office: <?php echo $inventory->lisensi_office ?: '-'; ?></h6>
                            <h6>IP Address: <?php echo $inventory->ipaddress ?: '-'; ?></h6>
                            <h6>Hostname: <?php echo $inventory->hostname ?: '-'; ?></h6>
                            <h6>Credential: <?php echo $inventory->credential ?: '-'; ?></h6>

                            <h5>Support Device</h5>
                            <h6>Monitor: <?php echo $inventory->monitor ?: '-'; ?></h6>
                            <h6>Keyboard: <?php echo $inventory->keyboard ?: '-'; ?></h6>
                            <h6>Mouse: <?php echo $inventory->mouse ?: '-'; ?></h6>
                            <h6>USB Converter: <?php echo $inventory->usb_converter ?: '-'; ?></h6>
                            <h6>External Storage: <?php echo $inventory->external_storage ?: '-'; ?></h6>
                            <h6>Printer: <?php echo $inventory->printer ?: '-'; ?></h6>
                            <h6>Scanner: <?php echo $inventory->scanner ?: '-'; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<!-- akhir -->
<?= $this->endSection() ?>