<!-- title -->
<?= $this->section('title') ?>
<title>Karyawan Kontrak &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h6>Total Data Karyawan Konrak : <?php echo $total_rows; ?></h6>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success!</b>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="section-body">
        <!-- awal -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>DataTabel Karyawan Kontrak </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr align="center">

                                        <th>ID</th>
                                        <th align="left">Nama</th>
                                        <th>Gender</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($karyawankontrak as $no => $value) { ?>
                                        <tr align="center">
                                            <td><?= $value->id_karyawan; ?></td>
                                            <td width="15%"><?= $value->nama_karyawan; ?></td>
                                            <td><?= $value->jabatan_karyawan; ?></td>
                                            <td><?= $value->devisi_karyawan; ?></td>
                                            <td width="10%"><a href="<?php echo site_url('karyawan/edit/' . $value->id_tetap); ?>" class="btn btn-success btn-circle btn-sm fas fa-user-pen"></i></a>
                                                <form action="<?= site_url('karyawan' . $value->id_tetap) ?>" method="post" class="d-inline">
                                                    <?= csrf_field() ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir -->
</section>
<?= $this->endSection() ?>