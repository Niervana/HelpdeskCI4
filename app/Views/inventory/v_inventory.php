<!-- title -->
<?= $this->section('title') ?>
<title>Data Inventory&mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h6>Total Data: <?php echo $total_rows; ?></h6>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('inventory/add') ?>"><span class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah Data</span></span></a></div>
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
                        <h6>DataTabel Inventory IT</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle <?php echo (isset($inventory) && !empty($inventory)) ? '' : 'disabled'; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('inventory/print-main'); ?>" target="_blank">Print Main Device</a>
                                        <a class="dropdown-item" href="<?php echo site_url('inventory/print-support'); ?>" target="_blank">Print Support Device</a>
                                    </div>
                                </div>
                                <a href="<?php echo site_url('inventory/excel'); ?>" class="btn btn-success <?php echo (isset($inventory) && !empty($inventory)) ? '' : 'disabled'; ?>"><i class="fas fa-file-excel"></i> Excel</a>
                                <a href="<?php echo site_url('inventory/log'); ?>" class="btn btn-dark"><i class="fas fa-file"></i> Log</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="nirvana" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th align="left">Nama</th>
                                        <th>Departemen</th>
                                        <th>Main Device</th>
                                        <th>Support Device</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventory as $no => $value) { ?>
                                        <tr align="center">
                                            <td style="width: 20%;"><?= $value->nama_karyawan; ?></td>
                                            <td><?= $value->departemen_karyawan; ?></td>
                                            <td>
                                                <?php if ($value->manufaktur) : ?>
                                                    <?= $value->manufaktur . ' ' . $value->jenis . ' (' . $value->cpu . ', ' . $value->ram . ', ' . $value->os . ')'; ?>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($value->monitor || $value->keyboard || $value->mouse) : ?>
                                                    <?php
                                                    $support = [];
                                                    if ($value->monitor) $support[] = 'Monitor';
                                                    if ($value->keyboard) $support[] = 'Keyboard';
                                                    if ($value->mouse) $support[] = 'Mouse';
                                                    echo implode(', ', $support);
                                                    ?>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td width="10%">
                                                <a href="<?php echo site_url('inventory/detail/' . $value->inventory_id); ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-magnifying-glass"></i></a>
                                                <a href="<?php echo site_url('inventory/edit/' . $value->inventory_id); ?>" class="btn btn-success btn-circle btn-sm"><i class="fas fa-user-pen"></i></a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus_<?php echo $value->inventory_id; ?>"><i class="fas fa-user-minus"></i></button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if (isset($inventory) && !empty($inventory)) : ?>
                                <?php foreach ($inventory as $value) : ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus_<?php echo $value->inventory_id; ?>" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data inventory ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?= site_url('inventory/' . $value->inventory_id) ?>" method="post" class="d-inline">
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
                        <!-- <div class="mt-3">
                            <a href="<?php echo site_url('inventory/print'); ?>" class="btn btn-primary <?php echo (isset($inventory) && !empty($inventory)) ? '' : 'disabled'; ?>" target="_blank"><i class="fas fa-print"></i> Print</a>
                            <a href="<?php echo site_url('inventory/excel'); ?>" class="btn btn-success <?php echo (isset($inventory) && !empty($inventory)) ? '' : 'disabled'; ?>"><i class="fas fa-file-excel"></i> Excel</a>
                            <a href="<?php echo site_url('inventory/log'); ?>" class="btn btn-dark"><i class="fas fa-file"></i> Log</a>
                        </div> -->
                        <!-- <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fa-sharp fa-solid fa-eye-low-vision"></i> Show/Hide
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item toggle-column" data-column="0">ID</a>
                                <a class="dropdown-item toggle-column" data-column="0 ">Nama</a>
                                <a class="dropdown-item toggle-column" data-column="1">Bagian</a>
                                <a class="dropdown-item toggle-column" data-column="2">IP Address</a>
                                <a class="dropdown-item toggle-column" data-column="3">Inventory</a>
                                <a class="dropdown-item toggle-column" data-column="4">Log</a>
                            </div>
                        </div> -->
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