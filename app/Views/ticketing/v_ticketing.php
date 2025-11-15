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
        <!-- Form Input Ticket -->
        <div class="card">
            <div class="card-header">
                <h4>Input Ticket Baru</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
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

                <?php if (session()->getFlashdata('error')): ?>
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

                <form action="<?= base_url('tiket') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="nama">Nama Karyawan:</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama karyawan" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="jenis_tiket">Jenis Tiket:</label>
                        <select class="form-control" id="jenis_tiket" name="jenis_tiket" required>
                            <option value="Software Trouble">Software Trouble</option>
                            <option value="Hardware Trouble">Hardware Trouble</option>
                            <option value="Phone Trouble">Phone Trouble</option>
                            <option value="Password Trouble">Password Trouble</option>
                            <option value="Network Trouble">Network Trouble</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desk_tiket">Deskripsi Tiket:</label>
                        <textarea class="form-control" id="desk_tiket" name="desk_tiket"
                            rows="4" placeholder="Jelaskan masalah yang dialami karyawan" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Kirim Tiket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <strong>Total Ticket: <span id="totalTicketCount"><?= $totalTicket ?></span></strong>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mr-2">Filter Tanggal:</label>
                                <div class="btn-group btn-group-sm" role="group" data-filter-type="filter">
                                    <a href="<?= base_url('tiket?filter=today&jenis=' . $currentJenisFilter) ?>"
                                        class="btn filter-btn <?= $currentFilter == 'today' ? 'btn-primary' : 'btn-outline-primary' ?>"
                                        data-filter="today"
                                        title="Hari Ini">
                                        <i class="fas fa-calendar-day"></i>
                                    </a>
                                    <a href="<?= base_url('tiket?filter=week&jenis=' . $currentJenisFilter) ?>"
                                        class="btn filter-btn <?= $currentFilter == 'week' ? 'btn-primary' : 'btn-outline-primary' ?>"
                                        data-filter="week"
                                        title="Minggu Ini">
                                        <i class="fas fa-calendar-week"></i>
                                    </a>
                                    <a href="<?= base_url('tiket?filter=month&jenis=' . $currentJenisFilter) ?>"
                                        class="btn filter-btn <?= $currentFilter == 'month' ? 'btn-primary' : 'btn-outline-primary' ?>"
                                        data-filter="month"
                                        title="Bulan Ini">
                                        <i class="fas fa-calendar-alt"></i>
                                    </a>
                                    <a href="<?= base_url('tiket?filter=all&jenis=' . $currentJenisFilter) ?>"
                                        class="btn filter-btn <?= $currentFilter == 'all' ? 'btn-primary' : 'btn-outline-primary' ?>"
                                        data-filter="all"
                                        title="All">
                                        <i class="fas fa-calendar"></i>
                                    </a>
                                    <button type="button" class="btn <?= $currentFilter == 'custom' ? 'btn-primary' : 'btn-outline-primary' ?>" id="customDateFilter" title="Pilih Tanggal" data-toggle="modal" data-target="#dateRangeModal">
                                        <i class="fas fa-calendar-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="mr-2">Filter Jenis:</label>
                                <div class="btn-group btn-group-sm" role="group" data-filter-type="jenis">
                                    <?php foreach ($jenisTiketList as $key => $value): ?>
                                        <?php
                                        $icon = '';
                                        switch ($key) {
                                            case 'all':
                                                $icon = 'fas fa-list';
                                                break;
                                            case 'Software Trouble':
                                                $icon = 'fas fa-code';
                                                break;
                                            case 'Hardware Trouble':
                                                $icon = 'fas fa-cogs';
                                                break;
                                            case 'Phone Trouble':
                                                $icon = 'fas fa-phone';
                                                break;
                                            case 'Password Trouble':
                                                $icon = 'fas fa-key';
                                                break;
                                            case 'Network Trouble':
                                                $icon = 'fas fa-wifi';
                                                break;
                                        }
                                        ?>
                                        <a href="<?= base_url('tiket?filter=' . $currentFilter . '&jenis=' . $key) ?>"
                                            class="btn jenis-btn <?= $currentJenisFilter == $key ? 'btn-success' : 'btn-outline-success' ?>"
                                            data-jenis="<?= $key ?>"
                                            title="<?= $value ?>">
                                            <i class="<?= $icon ?>"></i>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Ticket -->
            <div class="card-header">
                <h4>Daftar Ticket</h4>
                <div class="card-header-action">
                    <a href="<?= base_url('tiket/print?filter=' . $currentFilter . '&jenis=' . $currentJenisFilter) ?>"
                        class="btn btn-primary print-link <?php echo (isset($tiket) && !empty($tiket)) ? '' : 'disabled'; ?>"
                        target="_blank">
                        <i class="fas fa-print"></i> Print PDF
                    </a>
                    <a href="<?= base_url('tiket/excel?filter=' . $currentFilter . '&jenis=' . $currentJenisFilter) ?>"
                        class="btn btn-success excel-link <?php echo (isset($tiket) && !empty($tiket)) ? '' : 'disabled'; ?>">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Nama</th>
                                <th>Department</th>
                                <th>Trouble</th>
                                <th>Detail</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="ticketTableBody">
                            <?php if (empty($tiket)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data ticket</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($tiket as $ticket): ?>
                                    <tr>
                                        <td><?= date('d/m/Y H:i', strtotime($ticket['create_date'])) ?></td>
                                        <td><?= esc($ticket['nama_karyawan']) ?></td>
                                        <td><?= esc($ticket['departemen_karyawan']) ?></td>
                                        <td><?= esc($ticket['jenis_tiket']) ?></td>
                                        <td>
                                            <a href="<?= base_url('tiket/detail/' . $ticket['tiket_id']) ?>"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input status-toggle"
                                                    id="status-<?= $ticket['tiket_id'] ?>"
                                                    data-id="<?= $ticket['tiket_id'] ?>"
                                                    <?= $ticket['status'] == 'solved' ? 'checked disabled' : '' ?>>
                                                <label class="custom-control-label" for="status-<?= $ticket['tiket_id'] ?>">
                                                    <?= $ticket['status'] == 'solved' ? 'Solved' : 'Ongoing' ?>
                                                </label>
                                            </div>
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

<!-- Modal for Custom Date Range -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateRangeModalLabel">Filter Berdasarkan Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="startDate">Tanggal Mulai:</label>
                    <input type="date" class="form-control" id="startDate" required>
                </div>
                <div class="form-group">
                    <label for="endDate">Tanggal Akhir:</label>
                    <input type="date" class="form-control" id="endDate" required>
                </div>
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> Pilih rentang tanggal untuk memfilter data ticket.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="applyDateRange">
                    <i class="fas fa-check"></i> Terapkan Filter
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Current filter values
        let currentFilter = '<?= $currentFilter ?>';
        let currentJenis = '<?= $currentJenisFilter ?>';
        let customDateRange = null; // Store custom date range

        // Function to load filtered data
        function loadFilteredData(filter, jenis, startDate = null, endDate = null) {
            let ajaxData = {
                filter: filter,
                jenis: jenis
            };

            // Add date range if custom filter
            if (filter === 'custom' && startDate && endDate) {
                ajaxData.start_date = startDate;
                ajaxData.end_date = endDate;
            }

            $.ajax({
                url: '<?= base_url('tiket/getFilteredData') ?>',
                type: 'GET',
                data: ajaxData,
                beforeSend: function() {
                    $('#ticketTableBody').html('<tr><td colspan="6" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
                },
                success: function(response) {
                    // Update total ticket count
                    $('#totalTicketCount').text(response.totalTicket);

                    // Update table body
                    let tbody = $('#ticketTableBody');
                    tbody.empty();

                    if (response.tiket.length === 0) {
                        tbody.append('<tr><td colspan="6" class="text-center">Tidak ada data ticket</td></tr>');
                    } else {
                        response.tiket.forEach(function(ticket) {
                            let isSolved = ticket.status == 'solved';
                            let date = new Date(ticket.create_date);
                            let formattedDate = date.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            }) + ' ' + date.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            let row = '<tr>' +
                                '<td>' + formattedDate + '</td>' +
                                '<td>' + escapeHtml(ticket.nama_karyawan) + '</td>' +
                                '<td>' + escapeHtml(ticket.departemen_karyawan) + '</td>' +
                                '<td>' + escapeHtml(ticket.jenis_tiket) + '</td>' +
                                '<td><a href="<?= base_url('tiket/detail/') ?>' + ticket.tiket_id + '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a></td>' +
                                '<td>' +
                                '<div class="custom-control custom-switch">' +
                                '<input type="checkbox" class="custom-control-input status-toggle" id="status-' + ticket.tiket_id + '" data-id="' + ticket.tiket_id + '" ' + (isSolved ? 'checked disabled' : '') + '>' +
                                '<label class="custom-control-label" for="status-' + ticket.tiket_id + '">' +
                                (isSolved ? 'Solved' : 'Ongoing') +
                                '</label>' +
                                '</div>' +
                                '</td>' +
                                '</tr>';
                            tbody.append(row);
                        });
                    }

                    // Update print and excel links
                    let printUrl = '<?= base_url('tiket/print?filter=') ?>' + filter + '&jenis=' + jenis;
                    let excelUrl = '<?= base_url('tiket/excel?filter=') ?>' + filter + '&jenis=' + jenis;

                    // Add date range to URLs if custom filter
                    if (filter === 'custom' && customDateRange) {
                        printUrl += '&start_date=' + customDateRange.start + '&end_date=' + customDateRange.end;
                        excelUrl += '&start_date=' + customDateRange.start + '&end_date=' + customDateRange.end;
                    }

                    $('.print-link').attr('href', printUrl);
                    $('.excel-link').attr('href', excelUrl);

                    // Enable/disable export buttons
                    let hasData = response.tiket.length > 0;
                    if (hasData) {
                        $('.print-link, .excel-link').removeClass('disabled');
                    } else {
                        $('.print-link, .excel-link').addClass('disabled');
                    }

                    // Update current filter values
                    currentFilter = filter;
                    currentJenis = jenis;
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
                    $('#ticketTableBody').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data. Silakan refresh halaman.</td></tr>');
                }
            });
        }

        // Function to escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            let map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, function(m) {
                return map[m];
            });
        }

        // Handle filter date button clicks
        $('.filter-btn').on('click', function(e) {
            e.preventDefault();
            let filterValue = $(this).data('filter');

            // Reset custom date range when switching to preset filters
            customDateRange = null;

            // Update button states
            $('.filter-btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $('#customDateFilter').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');

            // Update URL without reload
            let currentUrl = new URL(window.location);
            currentUrl.searchParams.set('filter', filterValue);
            currentUrl.searchParams.set('jenis', currentJenis);
            currentUrl.searchParams.delete('start_date');
            currentUrl.searchParams.delete('end_date');
            window.history.pushState({}, '', currentUrl);

            // Update all filter button hrefs
            updateFilterButtonHrefs(filterValue, currentJenis);

            // Load filtered data
            loadFilteredData(filterValue, currentJenis);
        });

        // Handle filter jenis button clicks
        $('.jenis-btn').on('click', function(e) {
            e.preventDefault();
            let jenisValue = $(this).data('jenis');

            // Update button states
            $('.jenis-btn').removeClass('btn-success').addClass('btn-outline-success');
            $(this).removeClass('btn-outline-success').addClass('btn-success');

            // Update URL without reload
            let currentUrl = new URL(window.location);
            currentUrl.searchParams.set('filter', currentFilter);
            currentUrl.searchParams.set('jenis', jenisValue);
            window.history.pushState({}, '', currentUrl);

            // Update all filter button hrefs
            updateFilterButtonHrefs(currentFilter, jenisValue);

            // Load filtered data with custom date if active
            if (currentFilter === 'custom' && customDateRange) {
                loadFilteredData(currentFilter, jenisValue, customDateRange.start, customDateRange.end);
            } else {
                loadFilteredData(currentFilter, jenisValue);
            }
        });

        // Function to update all filter button hrefs
        function updateFilterButtonHrefs(filterValue, jenisValue) {
            // Update filter date buttons
            $('.filter-btn').each(function() {
                let btnFilter = $(this).data('filter');
                $(this).attr('href', '<?= base_url('tiket?filter=') ?>' + btnFilter + '&jenis=' + jenisValue);
            });

            // Update filter jenis buttons
            $('.jenis-btn').each(function() {
                let btnJenis = $(this).data('jenis');
                $(this).attr('href', '<?= base_url('tiket?filter=') ?>' + filterValue + '&jenis=' + btnJenis);
            });
        }

        // Autocomplete for employee names
        $('#nama').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?= base_url('tiket/getKaryawan') ?>',
                    type: 'GET',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.nama_karyawan + ' - ' + item.departemen_karyawan,
                                value: item.nama_karyawan
                            };
                        }));
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#nama').val(ui.item.value);
                return false;
            }
        });

        // Handle status toggle with event delegation
        $(document).on('change', '.status-toggle', function() {
            if ($(this).prop('disabled')) {
                return;
            }

            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 'solved' : 'ongoing';
            let label = $(this).siblings('label');
            let checkbox = $(this);

            $.ajax({
                url: '<?= base_url('tiket/updateStatus/') ?>' + id,
                type: 'POST',
                data: {
                    status: status,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function(response) {
                    if (response.success) {
                        label.text(status === 'solved' ? 'Solved' : 'Ongoing');
                        if (status === 'solved') {
                            checkbox.prop('disabled', true);
                        }
                        iziToast.success({
                            title: 'Success',
                            message: 'Status berhasil diupdate',
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Gagal mengupdate status',
                            position: 'topRight'
                        });
                        checkbox.prop('checked', !checkbox.is(':checked'));
                    }
                },
                error: function() {
                    iziToast.error({
                        title: 'Error',
                        message: 'Gagal mengupdate status',
                        position: 'topRight'
                    });
                    checkbox.prop('checked', !checkbox.is(':checked'));
                }
            });
        });

        // Custom date filter - Open modal
        $('#customDateFilter').on('click', function() {
            // Set default dates (current month)
            let today = new Date();
            let firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            let lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

            // If custom date range exists, use it
            if (customDateRange) {
                $('#startDate').val(customDateRange.start);
                $('#endDate').val(customDateRange.end);
            } else {
                $('#startDate').val(formatDateForInput(firstDay));
                $('#endDate').val(formatDateForInput(lastDay));
            }
        });

        // Apply custom date range filter
        $('#applyDateRange').on('click', function() {
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

            if (!startDate || !endDate) {
                iziToast.warning({
                    title: 'Perhatian',
                    message: 'Silakan pilih tanggal mulai dan tanggal akhir',
                    position: 'topRight'
                });
                return;
            }

            // Validate date range
            if (new Date(startDate) > new Date(endDate)) {
                iziToast.warning({
                    title: 'Perhatian',
                    message: 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir',
                    position: 'topRight'
                });
                return;
            }

            // Store custom date range
            customDateRange = {
                start: startDate,
                end: endDate
            };

            // Update button states - set custom filter as active
            $('.filter-btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $('#customDateFilter').removeClass('btn-outline-primary').addClass('btn-primary');

            // Update URL
            let currentUrl = new URL(window.location);
            currentUrl.searchParams.set('filter', 'custom');
            currentUrl.searchParams.set('jenis', currentJenis);
            currentUrl.searchParams.set('start_date', startDate);
            currentUrl.searchParams.set('end_date', endDate);
            window.history.pushState({}, '', currentUrl);

            // Close modal
            $('#dateRangeModal').modal('hide');

            // Load filtered data with custom date range
            loadFilteredData('custom', currentJenis, startDate, endDate);

            iziToast.success({
                title: 'Success',
                message: 'Filter tanggal berhasil diterapkan',
                position: 'topRight'
            });
        });

        // Format date for input field (YYYY-MM-DD)
        function formatDateForInput(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        // Check if page loaded with custom date filter
        (function initCustomDateFilter() {
            let urlParams = new URLSearchParams(window.location.search);
            let filter = urlParams.get('filter');
            let startDate = urlParams.get('start_date');
            let endDate = urlParams.get('end_date');

            if (filter === 'custom' && startDate && endDate) {
                customDateRange = {
                    start: startDate,
                    end: endDate
                };
                $('.filter-btn').removeClass('btn-primary').addClass('btn-outline-primary');
                $('#customDateFilter').removeClass('btn-outline-primary').addClass('btn-primary');
            }
        })();
    });
</script>

<?= $this->endSection() ?>