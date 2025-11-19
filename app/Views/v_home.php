<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Dashboard Admin &mdash; Nirvana</title>
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body {
        background-color: #f4f6f9;
    }

    .section {
        padding: 25px;
    }

    /* Stat Card Styles - Stisla Like */
    .card-stat {
        border: none;
        border-radius: 3px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        margin-bottom: 30px;
        transition: all 0.3s;
    }

    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .card-stat .card-body {
        padding: 25px;
    }

    .card-stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        float: left;
        margin-right: 15px;
    }

    .card-stat-details {
        overflow: hidden;
    }

    .card-stat-title {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .card-stat-number {
        font-size: 28px;
        font-weight: 700;
        color: #34395e;
        line-height: 1.2;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 3px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        margin-bottom: 30px;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #f4f6f9;
        padding: 20px 25px;
        font-weight: 600;
        color: #34395e;
    }

    .card-header h4 {
        font-size: 16px;
        margin: 0;
        font-weight: 600;
    }

    .card-body {
        padding: 25px;
    }

    /* Table Styles */
    .table {
        color: #6c757d;
    }

    .table thead th {
        border-bottom: 1px solid #f4f6f9;
        color: #34395e;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 15px;
    }

    .table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-top: 1px solid #f4f6f9;
    }

    .table tbody tr:hover {
        background-color: #fafbfe;
    }

    /* Berita Acara Scroll */
    .berita-acara-scroll {
        max-height: 400px;
        overflow-y: auto;
    }

    .berita-acara-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .berita-acara-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .berita-acara-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 3px;
    }

    .berita-acara-scroll::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
    }

    /* Toast Container */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Badge Styles */
    .badge-status {
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-ongoing {
        background-color: #fdfdea;
        color: #ffa426;
    }

    .badge-solved {
        background-color: #dff0ff;
        color: #3abaf4;
    }

    /* Button Styles */
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section {
            padding: 15px;
        }

        .card-stat .card-body {
            padding: 20px;
        }

        .card-stat-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .card-stat-number {
            font-size: 24px;
        }

        .berita-acara-scroll {
            max-height: 300px;
        }

        .chart-container {
            height: 250px;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">


    <div class="section-body">
        <!-- Stat Cards Row -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="card-stat-icon bg-primary">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-stat-details">
                            <div class="card-stat-title">Total Tickets</div>
                            <div class="card-stat-number" id="totalTicketsCount">
                                <?= $total_tickets ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="card-stat-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-stat-details">
                            <div class="card-stat-title">Ongoing</div>
                            <div class="card-stat-number" id="ongoingCount">
                                <?= $ongoing_count ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="card-stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-stat-details">
                            <div class="card-stat-title">Solved</div>
                            <div class="card-stat-number" id="solvedCount">
                                <?= $solved_count ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="card-stat-icon bg-info">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="card-stat-details">
                            <div class="card-stat-title">Today</div>
                            <div class="card-stat-number" id="todayCount">
                                <?= $today_count ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <!-- Left Column: Berita Acara -->
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-file-alt"></i> Berita Acara Terbaru</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('berita-acara'); ?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        $recentBeritaAcara = array_slice($berita_acara ?? [], 0, 10);
                        if (!empty($recentBeritaAcara)):
                        ?>
                            <div class="berita-acara-scroll">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Jenis Kegiatan</th>
                                                <th>Lokasi</th>
                                                <th>Pelaksana</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recentBeritaAcara as $ba): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= esc($ba['jenis_kegiatan']) ?></strong>
                                                    </td>
                                                    <td><?= esc($ba['lokasi']) ?></td>
                                                    <td><?= esc($ba['pelaksana']) ?></td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <?= date('d M Y', strtotime($ba['tanggal'])) ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('berita-acara/detail/' . $ba['beritaacara_id']); ?>"
                                                            class="btn btn-primary btn-icon btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada data Berita Acara</p>
                                <a href="<?= base_url('berita-acara/add'); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Buat Berita Acara Pertama
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Chart -->
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-pie"></i> Ticket by Type</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="ticketTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Global variables
    let lastNotificationId = 0;
    let notificationInterval;
    let isPageVisible = true;

    // Initialize when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeDashboard();
        startNotificationPolling();
    });

    // Handle page visibility change
    document.addEventListener('visibilitychange', function() {
        isPageVisible = !document.hidden;
        if (isPageVisible) {
            startNotificationPolling();
        }
    });

    function initializeDashboard() {
        updateStatsCounts();
        initializeChart();

        const notifBtn = document.getElementById('notificationBtn');
        if (notifBtn) {
            notifBtn.addEventListener('click', function() {
                markAllNotificationsRead();
            });
        }
    }

    function initializeChart() {
        const ctx = document.getElementById('ticketTypeChart').getContext('2d');
        const chartData = <?= json_encode($ticket_stats_by_type ?? []) ?>;
        const labels = chartData.map(item => item.jenis_tiket);
        const data = chartData.map(item => parseInt(item.total));

        const colors = [
            '#6777ef', '#fc544b', '#ffa426', '#47c363', '#3abaf4',
            '#6c757d', '#e83e8c', '#fd7e14', '#20c997', '#17a2b8'
        ];

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors.slice(0, labels.length),
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                family: 'Nunito, sans-serif'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#34395e',
                        titleFont: {
                            size: 13
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 10,
                        cornerRadius: 3,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    function updateStatsCounts() {
        const total = <?= $total_tickets ?? 0 ?>;
        const ongoing = <?= $ongoing_count ?? 0 ?>;
        const solved = <?= $solved_count ?? 0 ?>;
        const today = <?= $today_count ?? 0 ?>;

        document.getElementById('totalTicketsCount').textContent = total;
        document.getElementById('ongoingCount').textContent = ongoing;
        document.getElementById('solvedCount').textContent = solved;
        document.getElementById('todayCount').textContent = today;
    }

    function startNotificationPolling() {
        if (notificationInterval) {
            clearInterval(notificationInterval);
        }

        notificationInterval = setInterval(function() {
            if (!isPageVisible) return;
            fetchNotifications();
        }, 3000);
    }

    function fetchNotifications() {
        fetch('<?= base_url('tiket/getNotifications') ?>?lastId=' + lastNotificationId)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.notifications.length > 0) {
                    const newNotifications = data.notifications.filter(notification => {
                        const notificationKey = `shown_${notification.id}`;
                        if (localStorage.getItem(notificationKey)) {
                            return false;
                        }
                        localStorage.setItem(notificationKey, 'true');
                        return true;
                    });

                    if (newNotifications.length > 0) {
                        newNotifications.forEach(notification => {
                            showNotificationToast(notification);
                        });

                        // Update last notification ID
                        const maxId = Math.max(...data.notifications.map(n => n.id));
                        lastNotificationId = maxId;

                        // Update badge count
                        updateNotificationBadge(data.count);

                        // Play notification sound
                        playNotificationSound();

                        // Update stats
                        updateStatsCounts();
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
            });
    }

    function showNotificationToast(notification) {
        const toastContainer = document.getElementById('toastContainer');

        const toastHtml = `
            <div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="10000">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-bell me-2"></i>
                        <strong>${notification.title}</strong><br>
                        <small>${notification.message}</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        toastContainer.insertAdjacentHTML('beforeend', toastHtml);

        const toastElement = toastContainer.lastElementChild;
        const toast = new bootstrap.Toast(toastElement);
        toast.show();

        toastElement.addEventListener('hidden.bs.toast', function() {
            toastElement.remove();
        });
    }

    function updateNotificationBadge(count) {
        const badge = document.getElementById('notificationBadge');
        if (badge) {
            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.classList.remove('d-none');
            } else {
                badge.classList.add('d-none');
            }
        }
    }

    function markAllNotificationsRead() {
        const toasts = document.querySelectorAll('.toast');
        const notificationIds = Array.from(toasts).map(toast => {
            return toast.dataset.notificationId;
        }).filter(id => id);

        if (notificationIds.length === 0) return;

        fetch('<?= base_url('tiket/markNotificationsRead') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    ids: notificationIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toasts.forEach(toast => {
                        const bsToast = bootstrap.Toast.getInstance(toast);
                        if (bsToast) bsToast.hide();
                    });
                    updateNotificationBadge(0);
                }
            })
            .catch(error => {
                console.error('Error marking notifications read:', error);
            });
    }

    function playNotificationSound() {
        try {
            const audioContext = new(window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);


            Format: [frequency, startTime, duration]
            const notes = [
                [523.25, 0, 0.15], // C5
                [659.25, 0.15, 0.15], // E5
                [783.99, 0.3, 0.3] // G5
            ];


            notes.forEach(([freq, start, duration]) => {
                oscillator.frequency.setValueAtTime(freq, audioContext.currentTime + start);
            });

            gainNode.gain.setValueAtTime(0.2, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.6);

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.6);
        } catch (error) {
            console.log('Web Audio API not supported');
        }
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', function() {
        if (notificationInterval) {
            clearInterval(notificationInterval);
        }
    });
</script>
<?= $this->endSection() ?>