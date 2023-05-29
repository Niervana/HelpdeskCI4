<!-- title -->
<?= $this->section('title') ?>
<title>Users Finger Details &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <!-- <h6>Total Users terdaftar : <?php echo var_dump($total); ?></h6> -->
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href=" <?php echo site_url('karyawan/add') ?>"><span class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah Data</span></span></a></div>
        </div>
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
                        <h6>DataTaUsers FingerPrint Solution</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr align="center">

                                        <td>UID</td>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Role</td>
                                        <td>Password</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $key => $user) { ?>
                                        <tr align="center">
                                            <td><?= $key; ?></td>
                                            <td style="width: 20%;"><?= $user[0]; ?></td>
                                            <td><?= $user[1]; ?></td>
                                            <td style="width: 20%;"><?= $user[2]; ?></td>
                                            <td style="width: 20%;"><?= $user[3]; ?></td>
                                            <!-- <td><a href="<?php echo site_url('karyawan/show_detail/' . $value->id_tetap); ?>" class="btn btn-info btn-circle btn-sm fas fa-magnifying-glass"></i></a>
                                            <td width="10%"><a href="<?php echo site_url('karyawan/edit/' . $value->id_tetap); ?>" class="btn btn-success btn-circle btn-sm fas fa-user-pen"></i></a>
                                                <form action="<?= site_url('karyawan' . $value->id_tetap) ?>" method="post" class="d-inline" onsubmit="return confirm('Ingin Hapus Data?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-user-minus"></i></button>
                                                </form>
                                            </td> -->
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