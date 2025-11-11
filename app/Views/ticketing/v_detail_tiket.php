<!-- title -->
<?= $this->section('title') ?>
<title>Detail Tiket &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Detail Tiket</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/tiket">Tickets</a></div>
            <div class="breadcrumb-item">Detail Tiket</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Detail Tiket #<?= esc($ticket['tiket_id']) ?></h4>
                <div class="card-header-action">
                    <a href="<?= base_url('tiket') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>ID Tiket:</strong></label>
                            <p>#<?= esc($ticket['tiket_id']) ?></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Nama Karyawan:</strong></label>
                            <p><?= esc($ticket['nama_karyawan']) ?></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Departemen:</strong></label>
                            <p><?= esc($ticket['departemen_karyawan']) ?></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Jenis Tiket:</strong></label>
                            <p><?= esc($ticket['jenis_tiket']) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Tanggal Dibuat:</strong></label>
                            <p><?= date('d/m/Y H:i:s', strtotime($ticket['create_date'])) ?></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Status:</strong></label>
                            <p>
                                <span class="badge badge-<?= $ticket['status'] == 'solved' ? 'success' : 'warning' ?>">
                                    <?= $ticket['status'] == 'solved' ? 'Solved' : 'Ongoing' ?>
                                </span>
                            </p>
                        </div>
                        <div class="form-group">
                            <label><strong>Deskripsi Tiket:</strong></label>
                            <p style="white-space: pre-wrap;"><?= esc($ticket['desk_tiket']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label><strong>Aksi:</strong></label><br>
                            <button type="button" class="btn btn-warning btn-sm update-status" data-id="<?= $ticket['tiket_id'] ?>" data-status="ongoing">
                                <i class="fas fa-clock"></i> Set Ongoing
                            </button>
                            <button type="button" class="btn btn-success btn-sm update-status" data-id="<?= $ticket['tiket_id'] ?>" data-status="solved">
                                <i class="fas fa-check"></i> Set Solved
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('.update-status').on('click', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var button = $(this);

            if (confirm('Apakah Anda yakin ingin mengubah status tiket ini menjadi ' + (status === 'solved' ? 'Solved' : 'Ongoing') + '?')) {
                $.ajax({
                    url: '<?= base_url('tiket/updateStatus/') ?>' + id,
                    type: 'POST',
                    data: {
                        status: status,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update badge
                            var badge = $('.badge');
                            if (status === 'solved') {
                                badge.removeClass('badge-warning').addClass('badge-success').text('Solved');
                            } else {
                                badge.removeClass('badge-success').addClass('badge-warning').text('Ongoing');
                            }

                            // Show success message
                            toastr.success('Status tiket berhasil diperbarui');
                        } else {
                            toastr.error('Gagal memperbarui status tiket');
                        }
                    },
                    error: function() {
                        toastr.error('Terjadi kesalahan saat memperbarui status');
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>