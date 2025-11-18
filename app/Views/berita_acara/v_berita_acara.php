<!-- title -->
<?= $this->section('title') ?>
<title>Berita Acara &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Berita Acara</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Berita Acara</div>
        </div>
    </div>

    <div class="section-body">
        <!-- awal -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>DataTabel Berita Acara</h4>
                        <div class="card-header-action">
                            <a href="<?php echo site_url('berita-acara/add'); ?>" class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah Data</span></span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="nirvana" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th align="left">Jenis Kegiatan</th>
                                        <th>Lokasi</th>
                                        <th>Pelaksana</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($berita_acara as $no => $value) { ?>
                                        <tr>
                                            <td style="width: 25%; text-align: center;">
                                                <strong><?= esc($value['jenis_kegiatan']) ?></strong>
                                            </td>
                                            <td style="width: 20%; text-align: center;"><?= esc($value['lokasi']) ?></td>
                                            <td style="width: 20%; text-align: center;">
                                                <span class="badge badge-info"><?= esc($value['pelaksana']) ?></span>
                                            </td>
                                            <td style="width: 15%; text-align: center;">
                                                <span title="<?= date('d/m/Y H:i', strtotime($value['tanggal'])) ?>">
                                                    <?= date('d/m/Y H:i', strtotime($value['tanggal'])) ?>
                                                </span>
                                            </td>
                                            <td width="20%" style="text-align: center;">
                                                <a href="<?php echo site_url('berita-acara/detail/' . $value['beritaacara_id']); ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-magnifying-glass"></i></a>
                                                <a href="<?php echo site_url('berita-acara/edit/' . $value['beritaacara_id']); ?>" class="btn btn-success btn-circle btn-sm"><i class="fas fa-user-pen"></i></a>
                                                <a href="<?php echo site_url('berita-acara/print/' . $value['beritaacara_id']); ?>" class="btn btn-secondary btn-circle btn-sm" target="_blank"><i class="fas fa-print"></i></a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus_<?php echo $value['beritaacara_id']; ?>"><i class="fas fa-user-minus"></i></button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if (isset($berita_acara) && !empty($berita_acara)) : ?>
                                <?php foreach ($berita_acara as $value) : ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus_<?php echo $value['beritaacara_id']; ?>" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data berita acara ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?= site_url('berita-acara/' . $value['beritaacara_id']) ?>" method="post" class="d-inline">
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

</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
</script>

<?= $this->endSection() ?>