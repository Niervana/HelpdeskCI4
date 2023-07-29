<!-- title -->
<?= $this->section('title') ?>
<title>Account Manager &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-body">
        <!-- awal -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Data Account</h6>
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
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h6>Account Request</h6>
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
                                    <?php foreach ($users2 as $no => $value) { ?>
                                        <tr align="center">
                                            <td><?= $value->id_karyawan; ?></td>
                                            <td style="width: 20%;"><?= $value->nama_users; ?></td>
                                            <td style="width: 20%;"><?= $value->email_users; ?></td>
                                            <td><?= $value->role; ?></td>
                                            <td><?= $value->createdat_users; ?></td>
                                            <td width="10%">
                                                <a href="<?php echo site_url('account/move/' . $value->id_users2); ?>" class="btn btn-success btn-circle btn-sm fas fa-check"></i></a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus_<?php echo $value->id_users2; ?>"><i class="fas fa-user-minus"></i></button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if (isset($value) && !empty($value)) : ?>
                                <?php foreach ($users2 as $value) : ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus_<?php echo $value->id_users2; ?>" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data account ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?= site_url('account' . $value->id_users2) ?>" method="post" class="d-inline">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir -->
</section>
<?= $this->endSection() ?>