<!-- title -->
<?= $this->section('title') ?>
<title>Users Finger Details &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
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
                        <h6>DataUsers FingerPrint Solution</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr align="center">
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Role</td>
                                        <td>Password</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $key => $user) { ?>
                                        <tr align="center">
                                            <td style="width: 20%;"><?= $user[0]; ?></td>
                                            <td><?= $user[1]; ?></td>
                                            <td style="width: 20%;"><?= $user[2]; ?></td>
                                            <td style="width: 20%;"><?= $user[3]; ?></td>
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

<?= $this->section('script') ?>

<?= $this->endSection() ?>