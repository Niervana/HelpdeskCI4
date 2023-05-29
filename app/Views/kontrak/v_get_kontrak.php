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
        <h6>Total Data Karyawan Kontrak : <?php echo $total_rows; ?></h6>
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
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Tanggal Masuk Kerja</th>
                                        <th>Mulai Kontrak</th>
                                        <th>Akhir Kontrak</th>
                                        <th>Lama Perpanjangan</th>
                                        <th>Status</th>
                                        <th>Infromation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($karyawankontrak as $no => $value) {
                                        $contract_start_date = date_create($value->kontrak_awal);
                                        $contract_end_date = date_create($value->kontrak_akhir);
                                        $current_date = date_create();

                                        if ($contract_end_date < $contract_start_date || $contract_end_date < $current_date) {
                                            $value->status = 'End';
                                        } else {
                                            $value->status = 'Ongoing';
                                        }

                                        $date = date("Y-m-d");
                                        $timeStart = strtotime("$value->kontrak_awal");
                                        $timeEnd = strtotime("$value->kontrak_akhir");
                                        $diff = abs((date("Y", $timeEnd) - date("Y", $timeStart)) * 12 + (date("m", $timeEnd) - date("m", $timeStart)));
                                        $value->lama_perpanjangan = $diff;
                                    ?>
                                        <tr align="center">
                                            <td><?= $value->id_karyawan; ?></td>
                                            <td style="width: 20%;"><?= $value->nama_karyawan; ?></td>
                                            <td><?= $value->jabatan_karyawan; ?></td>
                                            <td><?= $value->devisi_karyawan; ?></td>
                                            <td><?= $value->tanggal_masuk; ?></td>
                                            <td><?= $value->kontrak_awal; ?></td>
                                            <td><?= $value->kontrak_akhir; ?></td>
                                            <td><?= $value->lama_perpanjangan, " Bulan"; ?></td>
                                            <?php if (($value->status) === "End") { ?>
                                                <td>
                                                    <div class="badge badge-success"><?= $value->status; ?></div>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <div class="badge badge-primary"><?= $value->status; ?></div>
                                                </td>
                                            <?php } ?>
                                            <td><?= $value->renew; ?></td>

                                            <td width="10%"><a href="<?php echo site_url('kontrak/edit/' . $value->id_kontrak); ?>" class="btn btn-success btn-circle btn-sm fas fa-user-pen"></i></a>
                                                <form action="<?= site_url('karyawankontrak' . $value->id_kontrak) ?>" method="post" class="d-inline">
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