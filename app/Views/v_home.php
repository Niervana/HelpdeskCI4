<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Dashboard &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('CSS') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard Human Resource Development</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $total_karyawan; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karyawan Tetap</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $total_karyawan_tetap; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karyawan Kontrak</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $total_karyawan_kontrak; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>PKL</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $total_pkl; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-clock"></i>
                </div>
                <div class=" card-wrap">
                    <div class="card-header" id="clockHeader">
                        <span id="clockTime"></span>
                    </div>
                    <div class="card-body">
                        <div id="date-time" style="font-size: 14px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-fingerprint"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Present</h4>
                    </div>
                    <div class="card-body">
                        42
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-clock"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Late</h4>
                    </div>
                    <div class="card-body">
                        1,201
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-user-minus"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Unpresent</h4>
                    </div>
                    <div class="card-body">
                        47
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Summary</h4>
                    <div class="card-header-action">
                        <a href="#summary-chart" data-tab="summary-tab" class="btn active">Chart</a>
                        <a href="#summary-text" data-tab="summary-tab" class="btn">Text</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="summary">
                        <div class="summary-info" data-tab-group="summary-tab" id="summary-text">
                            <h4>$1,858</h4>
                            <div class="text-muted">Sold 4 items on 2 customers</div>
                            <div class="d-block mt-2">
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                            <canvas id="myChart" height="180"></canvas>
                        </div>
                        <div class="summary-item">
                            <h6 class="mt-3">Statistic <span class="text-muted">Karyawan Hadir</span></h6>
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-right">12%</div>
                                        <div class="media-title"><a href="#">Hari ini</a></div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-right">41%</div>
                                        <div class="media-title"><a href="#">Minggu ini</a></div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-right">41%</div>
                                        <div class="media-title"><a href="#">Bulan ini</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Chart Departemen</h4>
                </div>
                <div class="card-body">
                    <canvas id="grafik-karyawan"></canvas>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Log Activity</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    function showDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: false
        };
        const dateTime = now.toLocaleString('id-ID', options);
        document.getElementById('date-time').innerText = dateTime;
    }
    setInterval(showDateTime, 1000);
</script>
<script>
    var ctx = document.getElementById('grafik-karyawan').getContext('2d');
    var data_karyawan = <?php echo json_encode($departemen); ?>;

    var labels = [];
    var data = [];

    for (var i = 0; i < data_karyawan.length; i++) {
        labels.push(data_karyawan[i]['devisi_karyawan']);
        data.push(data_karyawan[i]['jumlah']);
    }
    var dynamicColors = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };

    var backgroundColors = [];
    for (var i = 0; i < data_karyawan.length; i++) {
        backgroundColors.push(dynamicColors());
    }
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Karyawan',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                position: 'right'
            }
        }
    });
</script>
<?= $this->endSection() ?>