<!-- title -->
<?= $this->section('title') ?>
<title>CCTV - ITM Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h6>Total Data: <?= $total ?? 0 ?></h6>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('cctv/add') ?>"><span class="btn btn-success"><i class="fa-solid fa-user-plus"></i> &ensp;<span>Tambah Data</span></span></a></div>
        </div>
    </div>
    <?php
    if (session()->getFlashdata('success')) : ?>
        <script>
            iziToast.success({
                title: 'Success',
                message: '<?= session()->getFlashdata('success') ?>',
                position: 'topCenter',
                color: 'white',
                backgroundColor: '#fff'
            });
        </script>
    <?php endif; ?>
    <?php
    if (session()->getFlashdata('error')) : ?>
        <script>
            iziToast.error({
                title: 'Error',
                message: '<?= session()->getFlashdata('error') ?>',
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
                        <h6>DataTable CCTV Inventory</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <!-- Excel export functionality can be added later if needed -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="nirvana" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Tipe Kamera</th>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Serial Number</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cctv)): ?>
                                        <?php $no = 1;
                                        foreach ($cctv as $item): ?>
                                            <tr>
                                                <td align="center"><?= $no++ ?></td>
                                                <td><?= esc($item['lokasi']) ?></td>
                                                <td><?= esc($item['tipe_kamera']) ?></td>
                                                <td><?= esc($item['merk']) ?></td>
                                                <td><?= esc($item['model']) ?></td>
                                                <td><?= esc($item['serial_number']) ?></td>
                                                <td><?= esc($item['ip_address']) ?></td>
                                                <td>
                                                    <span class="badge badge-<?= $item['status'] === 'Active' ? 'success' : ($item['status'] === 'Inactive' ? 'danger' : 'warning') ?>">
                                                        <?= esc($item['status']) ?>
                                                    </span>
                                                </td>
                                                <td align="center">
                                                    <a href="<?= site_url('cctv/detail/' . $item['id']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= site_url('cctv/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus_<?php echo $item['id']; ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" align="center">Tidak ada data CCTV</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php if (!empty($cctv)) : ?>
                                <?php foreach ($cctv as $item) : ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus_<?php echo $item['id']; ?>" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data CCTV ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?= site_url('cctv/' . $item['id']) ?>" method="post" class="d-inline">
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
    $(document).ready(function() {
        $('#nirvana').DataTable({
            "pageLength": 25,
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>