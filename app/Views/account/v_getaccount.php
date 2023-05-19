<!-- title -->
<?= $this->section('title') ?>
<title>Account Manager &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href=" <?php echo site_url('account/add') ?>"><span class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah User</span></span></a></div>
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
                        <h6>Data Account</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th align="left">Nama</th>
                                        <th>email</th>
                                        <th>role</th>

                                        <th>created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $no => $value) { ?>
                                        <tr align="center">
                                            <td><?= $value->id_karyawan; ?></td>
                                            <td style="width: 20%;"><?= $value->nama_users; ?></td>
                                            <td style="width: 20%;"><?= $value->email_users; ?></td>
                                            <td><?= $value->role; ?></td>


                                            <td><?= $value->createdat_users; ?></td>
                                            <td width="10%"><a href="<?php echo site_url('account/edit/' . $value->id_users); ?>" class="btn btn-success btn-circle btn-sm fas fa-user-pen"></i></a>
                                                <form action="<?= site_url('account' . $value->id_users) ?>" method="post" class="d-inline" onsubmit="return confirm('Ingin Hapus Data?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-user-minus"></i></button>
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