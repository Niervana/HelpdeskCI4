<!-- title -->
<?= $this->section('title') ?>
<title>Log Inventory&mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h6>Total Log Entries: <?php echo count($logs); ?></h6>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('inventory') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Inventory</a></div>
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
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>DataTable Log Inventory</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="log_table" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Karyawan</th>
                                        <th>Action Type</th>
                                        <th>Before Change</th>
                                        <th>After Change</th>
                                        <th>Users</th>
                                        <th>Action Date</th>
                                        <th>IP Address</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($logs as $log) { ?>
                                        <tr align="center">
                                            <td><?= $no++; ?></td>
                                            <td><?= $log['nama_karyawan']; ?></td>
                                            <td><?= $log['action_type']; ?></td>
                                            <td>
                                                <?php if ($log['before_change']) : ?>
                                                    <pre><?php echo json_encode(json_decode($log['before_change']), JSON_PRETTY_PRINT); ?></pre>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($log['after_change']) : ?>
                                                    <pre><?php echo json_encode(json_decode($log['after_change']), JSON_PRETTY_PRINT); ?></pre>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $log['nama_users']; ?></td>
                                            <td><?= $log['action_date']; ?></td>
                                            <td><?= $log['ip_address']; ?></td>
                                            <td><?= $log['description']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
        $('#log_table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<?= $this->endSection() ?>