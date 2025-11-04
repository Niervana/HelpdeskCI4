<!-- title -->
<?= $this->section('title') ?>
<title>tiketing &mdash; Nirvana</title>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Tickets</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Tickets</div>
        </div>
    </div>

    <div class="section-body">
        <!-- Header dengan Total dan Sort -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div><strong>Total Ticket: <?= $totalTicket ?></strong></div>
            <div>
                <label class="mr-2">Filter</label>
                <div class="btn-group" role="group">
                    <a href="<?= base_url('ticket?filter=today') ?>"
                        class="btn btn-sm <?= $currentFilter == 'today' ? 'btn-primary' : 'btn-outline-primary' ?>">
                        Hari Ini
                    </a>
                    <a href="<?= base_url('ticket?filter=week') ?>"
                        class="btn btn-sm <?= $currentFilter == 'week' ? 'btn-primary' : 'btn-outline-primary' ?>">
                        Minggu Ini
                    </a>
                    <a href="<?= base_url('ticket?filter=month') ?>"
                        class="btn btn-sm <?= $currentFilter == 'month' ? 'btn-primary' : 'btn-outline-primary' ?>">
                        Bulan Ini
                    </a>
                    <a href="<?= base_url('ticket?filter=all') ?>"
                        class="btn btn-sm <?= $currentFilter == 'all' ? 'btn-primary' : 'btn-outline-primary' ?>">
                        All
                    </a>

                </div>
            </div>
        </div>

        <!-- Form Input Ticket -->
        <div class="card">
            <div class="card-header">
                <h4>Input Ticket Baru</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('ticket/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="nama">Nama Karyawan:</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama karyawan" required autocomplete="off">
                        <div id="karyawan-suggestions" class="list-group" style="display: none;"></div>
                        <small class="form-text text-muted">
                            Departemen akan otomatis terisi berdasarkan nama karyawan
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="jenis_tiket">Jenis Tiket:</label>
                        <select class="form-control" id="jenis_tiket" name="jenis_tiket">
                            <option value="Software Trouble">Software Trouble</option>
                            <option value="Hardware Trouble">Hardware Trouble</option>
                            <option value="Phone Trouble">Phone Trouble</option>
                            <option value="Password Trouble">Password Trouble</option>
                        </select>
                        <div class="form-group">
                            <label for="desk_tiket">Deskripsi Tiket:</label>
                            <textarea class="form-control" id="desk_tiket" name="desk_tiket"
                                rows="4" placeholder="Deskripsi masalah yang terjadi" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload
                            </button>
                        </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Ticket -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Daftar Ticket</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Nama</th>
                                <th>Department</th>
                                <th>User</th>
                                <th>Troubleshooting</th>
                                <th>Detail</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($tiket)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data ticket</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($tiket as $ticket): ?>
                                    <tr>
                                        <td><?= date('d/m/Y H:i', strtotime($ticket['create_date'])) ?></td>
                                        <td><?= esc($ticket['nama_karyawan']) ?></td>
                                        <td><?= esc($ticket['departemen_karyawan']) ?></td>
                                        <td>-</td>
                                        <td><?= esc(substr($ticket['jenis_tiket'], 0, 50)) ?>...</td>
                                        <td>
                                            <a href="<?= base_url('ticket/detail/' . $ticket['tiket_id']) ?>"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                        <td>
                                            <select class="form-control status-select" data-id="<?= $ticket['tiket_id'] ?>">
                                                <option value="ongoing" <?= $ticket['status'] == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                                <option value="solved" <?= $ticket['status'] == 'solved' ? 'selected' : '' ?>>Solved</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#nama').on('input', function() {
            var term = $(this).val();
            if (term.length >= 2) {
                $.ajax({
                    url: '<?= base_url('tiket/getKaryawan') ?>',
                    type: 'GET',
                    data: {
                        term: term
                    },
                    success: function(data) {
                        var suggestions = $('#karyawan-suggestions');
                        suggestions.empty();
                        if (data.length > 0) {
                            data.forEach(function(karyawan) {
                                suggestions.append('<a href="#" class="list-group-item list-group-item-action karyawan-item" data-nama="' + karyawan.nama + '">' + karyawan.nama + ' - ' + karyawan.departemen + '</a>');
                            });
                            suggestions.show();
                        } else {
                            suggestions.hide();
                        }
                    }
                });
            } else {
                $('#karyawan-suggestions').hide();
            }
        });

        $(document).on('click', '.karyawan-item', function(e) {
            e.preventDefault();
            var nama = $(this).data('nama');
            $('#nama').val(nama);
            $('#karyawan-suggestions').hide();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#nama, #karyawan-suggestions').length) {
                $('#karyawan-suggestions').hide();
            }
        });

        $('.status-select').on('change', function() {
            var id = $(this).data('id');
            var status = $(this).val();
            $.ajax({
                url: '<?= base_url('tiket/updateStatus/') ?>' + id,
                type: 'POST',
                data: {
                    status: status,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function(response) {
                    if (response.success) {
                        // Optional: Show success message or update UI
                        console.log('Status updated successfully');
                    } else {
                        alert('Failed to update status');
                    }
                }
            });
        });
    });
</script>

<!-- <div class="section-header">
        <h1>Tickets</h1>
    </div>

    <div class="section-body">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div><strong>Total Ticket: 0</strong></div>
            <div>Sort : date / month / year</div>
        </div>

        <form action="" method="post" style="max-width: 600px;">
            <div class="form-group mb-3">
                <label for="date">Input date:</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Select date" required>
            </div>
            <div class="form-group mb-3">
                <label for="name">Input name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group mb-3">
                <label for="trouble">Input trouble:</label>
                <textarea class="form-control" id="trouble" name="trouble" rows="4" placeholder="Describe trouble" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <hr class="my-5">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Depart</th>
                        <th>Device</th>
                        <th>Trouble</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    Data rows akan di-loop di sini
                    <tr>
                        <td colspan="6" class="text-center">No data available</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> -->
<?= $this->endSection() ?>