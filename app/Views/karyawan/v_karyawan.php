<!-- title -->
<?= $this->section('title') ?>
<title>Data Karyawan HKTI&mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h6>Total Data Karyawan: <?php echo $total_rows; ?></h6>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('karyawan/add') ?>"><span class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah Data</span></span></a></div>
        </div>
    </div>
    <?php
    if (session()->getFlashdata('success')) : ?>
        <script>
            iziToast.success({
                title: 'Sucess',
                message: '<?= session()->getFlashdata('success') ?>',
                position: 'topCenter',
                color: 'white',
                backgroundColor: '#fff'
            });
        </script>
    <?php endif; ?>
    <div class="section-body">
        <!-- awal -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>DataTabel Karyawan HKTI</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th align="left">Nama</th>
                                        <th>Gender</th>
                                        <th>TTL</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Pendidikan</th>
                                        <th>Jurusan</th>
                                        <th>Divisi</th>
                                        <th>Jabatan</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th>Badan</th>
                                        <th align="center">Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($karyawan as $no => $value) { ?>
                                        <tr align="center">
                                            <td><?= $value->id_karyawan; ?></td>
                                            <td style="width: 20%;"><?= $value->nama_karyawan; ?></td>
                                            <td><?= $value->gender_karyawan; ?></td>
                                            <td><?= $value->tmpt_lahir . ', ' . $value->tgl_lahir; ?></td>
                                            <td><?= $value->alamat_karyawan; ?></td>
                                            <td><?= $value->email_karyawan; ?></td>
                                            <td><?= $value->nomor_telp; ?></td>
                                            <td><?= $value->pendidikan_karyawan; ?></td>
                                            <td><?= $value->jurusan_pendidikan; ?></td>
                                            <td style="width: 20%;"><?= $value->devisi_karyawan; ?></td>
                                            <td style="width: 20%;"><?= $value->jabatan_karyawan; ?></td>
                                            <td><?= number_format($value->salary); ?></td>
                                            <td><?= $value->status_karyawan; ?></td>
                                            <td><?= $value->badan_usaha; ?></td>
                                            <td><a href="<?php echo site_url('karyawan/show_detail/' . $value->id_tetap); ?>" class="btn btn-info btn-circle btn-sm fas fa-magnifying-glass"></i></a>
                                            <td width="10%">
                                                <a href="<?php echo site_url('karyawan/edit/' . $value->id_tetap); ?>" class="btn btn-success btn-circle btn-sm fas fa-user-pen"></i></a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus_<?php echo $value->id_tetap; ?>"><i class="fas fa-user-minus"></i></button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if (isset($value) && !empty($value)) : ?>
                                <?php foreach ($karyawan as $value) : ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus_<?php echo $value->id_tetap; ?>" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data karyawan ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?= site_url('karyawan' . $value->id_tetap) ?>" method="post" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fa-sharp fa-solid fa-eye-low-vision"></i> Show/Hide
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item toggle-column" data-column="0">ID</a>
                                <a class="dropdown-item toggle-column" data-column="1">Nama</a>
                                <a class="dropdown-item toggle-column" data-column="2">Gender</a>
                                <a class="dropdown-item toggle-column" data-column="3">TTL</a>
                                <a class="dropdown-item toggle-column" data-column="4">Alamat</a>
                                <a class="dropdown-item toggle-column" data-column="5">Email</a>
                                <a class="dropdown-item toggle-column" data-column="6">Telepon</a>
                                <a class="dropdown-item toggle-column" data-column="7">Pendidikan</a>
                                <a class="dropdown-item toggle-column" data-column="8">Jurusan</a>
                                <a class="dropdown-item toggle-column" data-column="9">Devisi</a>
                                <a class="dropdown-item toggle-column" data-column="10">Jabatan</a>
                                <a class="dropdown-item toggle-column" data-column="11">Salary</a>
                                <a class="dropdown-item toggle-column" data-column="12">Status</a>
                                <a class="dropdown-item toggle-column" data-column="13">Badan</a>
                            </div>
                        </div>

</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
</script>

<?= $this->endSection() ?>