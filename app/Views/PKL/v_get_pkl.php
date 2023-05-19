<!-- title -->
<?= $this->section('title') ?>
<title>PKL &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">

    <div class="section-header">
        <h6>Total Data PKL : <?php echo $total_rows; ?></h6>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href=" <?php echo site_url('pkl/add') ?>"><span class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah Data</span></span></a></div>
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
                        <h6>DataTabel Praktek Kerja Lapangan </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr align="center">
                                        <th>NIS/NIM</th>
                                        <th align="left">Nama</th>
                                        <th>Asal Sekolah</th>
                                        <th>Jurusan</th>
                                        <th>Penempatan</th>
                                        <th>Mulai</th>
                                        <th>Berakhir</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pkl as $no => $value) {
                                        if (strtotime($value->berakhir) < time()) {
                                            $value->status = 'End';
                                        } else {
                                            $value->status = 'Ongoing';
                                        }
                                        $date = date("Y-m-d");
                                        $timeStart = strtotime("$value->mulai");
                                        $timeEnd = strtotime("$value->berakhir");
                                        $value->durasi = date("m", $timeEnd) - date("m", $timeStart);
                                    ?>
                                        <tr align="center">

                                            <td><?= $value->nisnim; ?></td>
                                            <td width="15%"><?= $value->nama; ?></td>
                                            <td><?= $value->sekolah; ?></td>
                                            <td><?= $value->jurusan; ?></td>
                                            <td><?= $value->departemen; ?></td>
                                            <td><?= $value->mulai; ?></td>
                                            <td><?= $value->berakhir; ?></td>
                                            <td><?= $value->durasi, "Bulan"; ?></td>
                                            <?php if (($value->status) === "End") { ?>
                                                <td>
                                                    <div class="badge badge-success"><?= $value->status; ?></div>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <div class="badge badge-primary"><?= $value->status; ?></div>
                                                </td>
                                            <?php } ?>
                                            <td width="10%"><a href="<?php echo site_url('pkl/edit/' . $value->id_pkl); ?>" class="btn btn-success btn-circle btn-sm fas fa-user-pen"></i></a>
                                                <form action="<?= site_url('pkl' . $value->id_pkl) ?>" method="post" class="d-inline" onsubmit="return confirm('Ingin Hapus Data?')">
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