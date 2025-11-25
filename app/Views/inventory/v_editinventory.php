<!-- title -->
<?= $this->section('title') ?>
<title>Update Data Inventory &mdash; Nirvana</title>
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
            <h1>Update Data Inventory</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('inventory'); ?>">Tabel Data Inventory</a></div>
                <div class="breadcrumb-item">Update Data Inventory</div>
            </div>
        </div>
        <div class="section-body">
            <form action="<?= site_url('inventory/update/' . $inventory->inventory_id) ?>" method="post" autocomplete="off" id="myForm">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="row align-items-stretch">
                    <div class="col-12 col-md-6 col-lg-6 d-flex flex-column">
                        <div class="card flex-fill mb-3 d-flex flex-column">
                            <div class="card-header">
                                <h4>Edit Data Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Karyawan*</label>
                                    <input type="text" name="nama_karyawan" value="<?= $inventory->nama_karyawan ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Departemen*</label>
                                    <input type="text" name="departemen_karyawan" value="<?= $inventory->departemen_karyawan ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email*</label>
                                    <input type="email" name="email_users" value="<?= $inventory->email_users ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password*</label>
                                    <input type="password" name="password_users" value="<?= $inventory->password_users ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="card flex-fill d-flex flex-column">
                            <div class="card-header">
                                <h4>Support Device</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Monitor</label>
                                    <input type="text" name="monitor" value="<?= $inventory->monitor ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Keyboard</label>
                                    <input type="text" name="keyboard" value="<?= $inventory->keyboard ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mouse</label>
                                    <input type="text" name="mouse" value="<?= $inventory->mouse ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>USB Converter</label>
                                    <input type="text" name="usb_converter" value="<?= $inventory->usb_converter ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>External Storage</label>
                                    <input type="text" name="external_storage" value="<?= $inventory->external_storage ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Printer</label>
                                    <input type="text" name="printer" value="<?= $inventory->printer ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Scanner</label>
                                    <input type="text" name="scanner" value="<?= $inventory->scanner ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 d-flex">
                        <div class="card flex-fill d-flex flex-column">
                            <div class="card-header">
                                <h4>Main Device</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Manufaktur</label>
                                    <input type="text" name="manufaktur" value="<?= $inventory->manufaktur ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" name="jenis" value="<?= $inventory->jenis ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>CPU</label>
                                    <input type="text" name="cpu" value="<?= $inventory->cpu ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>RAM</label>
                                    <input type="text" name="ram" value="<?= $inventory->ram ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>OS</label>
                                    <input type="text" name="os" value="<?= $inventory->os ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Lisensi Windows</label>
                                    <input type="text" name="lisensi_windows" value="<?= $inventory->lisensi_windows ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Storage</label>
                                    <input type="text" name="storage" value="<?= $inventory->storage ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Office</label>
                                    <input type="text" name="office" value="<?= $inventory->office ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Lisensi Office</label>
                                    <input type="text" name="lisensi_office" value="<?= $inventory->lisensi_office ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>IP Address</label>
                                    <input type="text" name="ipaddress" value="<?= $inventory->ipaddress ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Hostname</label>
                                    <input type="text" name="hostname" value="<?= $inventory->hostname ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Credential</label>
                                    <input type="text" name="credential" value="<?= $inventory->credential ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-success mx-2">Save <i class="fas fa-floppy-disk"></i></button>
                        <button type="reset" class="btn btn-secondary mx-2">Reset <i class="fas fa-arrows-rotate"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- akhir -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    // seleksi form menggunakan ID
    var form = document.getElementById("myForm");
    // tambahkan event listener ke form saat melakukakan submit
    form.addEventListener("submit", function(event) {
        // stop default behavior of submitting the form
        event.preventDefault();
        form.submit();
    });
</script>
<?= $this->endSection() ?>