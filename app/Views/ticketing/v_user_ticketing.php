<!-- title -->
<?= $this->section('title') ?>
<title>Tickets &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Tickets</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Tickets</div>
        </div>
    </div>

    <div class="section-body">
        <!-- Form Input Ticket -->
        <div class="card">
            <div class="card-header">
                <h4>Input Ticket Baru</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <script>
                        iziToast.success({
                            title: 'Success',
                            message: '<?= session()->getFlashdata('success') ?>',
                            position: 'topCenter',
                            color: 'white',
                            backgroundColor: '#fff'
                        });
                    </script>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <script>
                        iziToast.error({
                            title: 'Error',
                            message: '<?= session()->getFlashdata('error') ?>',
                            position: 'topCenter',
                            color: 'white',
                            backgroundColor: '#fff'
                        });
                    </script>
                <?php endif; ?>

                <form action="<?= base_url('tiket') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="jenis_tiket">Jenis Tiket:</label>
                        <select class="form-control" id="jenis_tiket" name="jenis_tiket" required>
                            <option value="Software Trouble">Software Trouble</option>
                            <option value="Hardware Trouble">Hardware Trouble</option>
                            <option value="Phone Trouble">Phone Trouble</option>
                            <option value="Password Trouble">Password Trouble</option>
                            <option value="Network Trouble">Network Trouble</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desk_tiket">Deskripsi Tiket:</label>
                        <textarea class="form-control" id="desk_tiket" name="desk_tiket"
                            rows="4" placeholder="Jelaskan masalah hidup yang Anda alami" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Kirim Tiket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="card mt-4">
            <div class="card-header">
                <h4><i class="fas fa-info-circle"></i> Informasi & Kontak</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Queue Information -->
                    <div class="col-md-6">
                        <div class="alert alert-info h-100">
                            <h5><i class="fas fa-clock"></i> Jumlah Tiket dalam Antrian</h5>
                            <h2 class="text-primary mb-3"><?= $unsolved_count ?></h2>
                            <p class="mb-3">Tiket yang belum diselesaikan oleh admin IT</p>
                            <hr>
                            <h6><i class="fas fa-info-circle"></i> Estimasi Waktu</h6>
                            <p class="mb-0">Tiket Anda akan diproses sesuai urutan antrian.</p>
                            <p class="mb-0">Admin IT akan menghubungi Anda segera setelah tiket diproses.</p>
                        </div>
                    </div>

                    <!-- Alternative Communication -->
                    <div class="col-md-6">
                        <div class="alert alert-warning h-100">
                            <h5><i class="fas fa-exclamation-triangle"></i> Jika Sistem Tidak Dapat Diakses</h5>
                            <p class="mb-3">Jika Anda mengalami masalah jaringan atau sistem tidak dapat diakses, silakan hubungi admin IT melalui WhatsApp:</p>
                            <div class="mb-2">
                                <a href="https://wa.me/628979000028" target="_blank" class="btn btn-success btn-block">
                                    <i class="fab fa-whatsapp"></i> Nirvana (+628979000028)
                                </a>
                            </div>
                            <div class="mb-2">
                                <a href="https://wa.me/6282218841643" target="_blank" class="btn btn-success btn-block">
                                    <i class="fab fa-whatsapp"></i> Dede (+6282218841643)
                                </a>
                            </div>
                            <small class="text">* Khusus untuk kasus darurat seperti gangguan jaringan yang menghalangi akses ke sistem ini</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>