<!-- title -->
<?= $this->section('title') ?>
<title>Tambah Data CCTV &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Tambah Data CCTV</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('cctv') ?>"><span class="btn btn-dark"><i class="fas fa-arrow-left"></i> &ensp;<span>Kembali</span></span></a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah CCTV</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('cctv/insert') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi *</label>
                                        <input type="text" class="form-control <?= (isset($errors['lokasi'])) ? 'is-invalid' : '' ?>" id="lokasi" name="lokasi" value="<?= old('lokasi') ?>" required>
                                        <?php if (isset($errors['lokasi'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['lokasi'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipe_kamera">Tipe Kamera *</label>
                                        <select class="form-control <?= (isset($errors['tipe_kamera'])) ? 'is-invalid' : '' ?>" id="tipe_kamera" name="tipe_kamera" required>
                                            <option value="">Pilih Tipe Kamera</option>
                                            <option value="Dome" <?= old('tipe_kamera') === 'Dome' ? 'selected' : '' ?>>Dome</option>
                                            <option value="Bullet" <?= old('tipe_kamera') === 'Bullet' ? 'selected' : '' ?>>Bullet</option>
                                            <option value="PTZ" <?= old('tipe_kamera') === 'PTZ' ? 'selected' : '' ?>>PTZ</option>
                                            <option value="Fixed" <?= old('tipe_kamera') === 'Fixed' ? 'selected' : '' ?>>Fixed</option>
                                        </select>
                                        <?php if (isset($errors['tipe_kamera'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['tipe_kamera'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="merk">Merk *</label>
                                        <input type="text" class="form-control <?= (isset($errors['merk'])) ? 'is-invalid' : '' ?>" id="merk" name="merk" value="<?= old('merk') ?>" required>
                                        <?php if (isset($errors['merk'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['merk'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="model">Model *</label>
                                        <input type="text" class="form-control <?= (isset($errors['model'])) ? 'is-invalid' : '' ?>" id="model" name="model" value="<?= old('model') ?>" required>
                                        <?php if (isset($errors['model'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['model'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="serial_number">Serial Number *</label>
                                        <input type="text" class="form-control <?= (isset($errors['serial_number'])) ? 'is-invalid' : '' ?>" id="serial_number" name="serial_number" value="<?= old('serial_number') ?>" required>
                                        <?php if (isset($errors['serial_number'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['serial_number'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="ip_address">IP Address *</label>
                                        <input type="text" class="form-control <?= (isset($errors['ip_address'])) ? 'is-invalid' : '' ?>" id="ip_address" name="ip_address" value="<?= old('ip_address') ?>" required>
                                        <?php if (isset($errors['ip_address'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['ip_address'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status *</label>
                                        <select class="form-control <?= (isset($errors['status'])) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                                            <option value="Active" <?= old('status') === 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= old('status') === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                            <option value="Maintenance" <?= old('status') === 'Maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                        </select>
                                        <?php if (isset($errors['status'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['status'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= site_url('cctv') ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>