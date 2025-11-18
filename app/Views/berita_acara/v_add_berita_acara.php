<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Tambah Berita Acara &mdash; Nirvana</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Tambah Berita Acara</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('berita-acara'); ?>">Berita Acara</a></div>
            <div class="breadcrumb-item active">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-plus"></i> Form Tambah Berita Acara</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('berita-acara/store'); ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi <span class="text-danger">*</span></label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control <?= (isset($errors['lokasi'])) ? 'is-invalid' : '' ?>" value="<?= old('lokasi') ?>" placeholder="Main Office, Prod, Ext" required>
                                        <?php if (isset($errors['lokasi'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['lokasi'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pelaksana">Pelaksana <span class="text-danger">*</span></label>
                                        <input type="text" name="pelaksana" id="pelaksana" class="form-control <?= (isset($errors['pelaksana'])) ? 'is-invalid' : '' ?>" value="<?= old('pelaksana') ?>" placeholder="Nama" required>
                                        <?php if (isset($errors['pelaksana'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['pelaksana'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kegiatan">Jenis Kegiatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="form-control <?= (isset($errors['jenis_kegiatan'])) ? 'is-invalid' : '' ?>" value="<?= old('jenis_kegiatan') ?>" placeholder="Instalasi, Perbaikan, Pengadaan" required>
                                        <?php if (isset($errors['jenis_kegiatan'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['jenis_kegiatan'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal & Waktu <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="tanggal" id="tanggal" class="form-control <?= (isset($errors['tanggal'])) ? 'is-invalid' : '' ?>" value="<?= old('tanggal') ?>" required>
                                        <small class="form-text text-muted">Format: 24 jam (HH:MM)</small>
                                        <?php if (isset($errors['tanggal'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['tanggal'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                <textarea name="keterangan" id="keterangan" class="form-control <?= (isset($errors['keterangan'])) ? 'is-invalid' : '' ?>" rows="5" placeholder="Jelaskan detail kegiatan yang dilakukan..." required><?= old('keterangan') ?></textarea>
                                <?php if (isset($errors['keterangan'])): ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['keterangan'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="<?= base_url('berita-acara'); ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>