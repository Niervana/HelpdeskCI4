<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
<title>Dashboard &mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('CSS') ?>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<!-- fullcalendar.js -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1/index.global.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>


<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <!-- <div class="row">
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
                        <?php //echo $total_karyawan; 
                        ?>
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
                        <?php //echo $total_karyawan_tetap; 
                        ?>
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
                        <?php //echo $total_karyawan_kontrak; 
                        ?>
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
                    <?php //echo $total_pkl; 
                    ?>
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
                        -
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
                        -
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
                        -
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Badan Usaha</h4>
                </div>
                <div class="card-body">
                    <canvas id="grafik-badanusaha"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Incoming Libur Nasional</h4>
                </div>
                <div class="card-body mt-3 pt-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table-libur">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Calendar</h4>
                </div>
                <div class="card-body mb-3">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div> -->


    <!-- <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Departemen</h4>
            </div>
            <div class="card-body">
                <canvas id="grafik-karyawan"></canvas>
            </div>
        </div>
    </div> -->


</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<!-- <script>
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
</script> -->
<!-- <script>
    var ctx = document.getElementById('grafik-karyawan').getContext('2d');
    var data_karyawan = <?php //echo json_encode($departemen); 
                        ?>;

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
</script> -->
<!-- <script>
    var ctx = document.getElementById('grafik-badanusaha').getContext('2d');
    var data_karyawan = <?php //echo json_encode($badanusaha); 
                        ?>;

    var labels = [];
    var data = [];

    for (var i = 0; i < data_karyawan.length; i++) {
        labels.push(data_karyawan[i]['badan_usaha']);
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
        type: 'pie',
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            editable: true, // Mengaktifkan fitur drag and drop
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            dateClick: function(info) {
                var currentTime = moment().format('HH:mm'); // Ambil waktu saat ini
                var isAllDay = moment().diff(info.date, 'days') > 0; // Cek apakah tanggal yang diklik adalah all-day event
                var timeLabel = isAllDay ? '(All Day)' : '(Waktu saat ini: ' + currentTime + ')'; // Tampilkan label sesuai dengan jenis event

                var title = prompt('Kegiatan ' + timeLabel + ':');
                if (title) {
                    var eventData = {
                        title: title,
                        start: info.date
                    };

                    if (!isAllDay) {
                        eventData.allDay = false;
                        eventData.start.setHours(moment().hours()); // Set jam ke waktu saat ini
                        eventData.start.setMinutes(moment().minutes()); // Set menit ke waktu saat ini
                    }

                    calendar.addEvent(eventData);
                    saveEventsToLocalStorage();
                }
            },
            eventClick: function(info) {
                if (confirm('Anda yakin ingin menghapus kegiatan ini?')) {
                    info.event.remove();
                    saveEventsToLocalStorage();
                }
            },
            eventDrop: function(info) { // Menghandle perubahan saat elemen di-drop ke tanggal lain
                saveEventsToLocalStorage();
            },
            eventDidMount: function(info) {
                addRedBackgroundToWeekend(info.el, info.event.start);
            },
            events: getEventsFromLocalStorage()
        });

        calendar.render();

        function addRedBackgroundToWeekend(element, date) {
            if (date.getDay() === 0 || date.getDay() === 6) {
                element.classList.add('weekend');
            }
        }

        function saveEventsToLocalStorage() {
            var events = calendar.getEvents().map(function(event) {
                return {
                    title: event.title,
                    start: event.start.toISOString()
                };
            });

            localStorage.setItem('calendarEvents', JSON.stringify(events));
        }

        function getEventsFromLocalStorage() {
            var events = JSON.parse(localStorage.getItem('calendarEvents')) || [];

            events.forEach(function(event) {
                event.start = new Date(event.start);
            });

            return events;
        }
    });
</script>

<script>
    fetch('https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json')
        .then(response => response.json())
        .then(data => {
            const liburNasional = data;

            const tableLibur = document.getElementById('table-libur');
            const currentDate = new Date();

            let rowCount = 0;
            Object.keys(liburNasional).forEach(date => {
                if (rowCount >= 10) {
                    return;
                }

                const liburDate = new Date(date);
                if (liburDate < currentDate) {
                    return;
                }

                const libur = liburNasional[date];
                const row = tableLibur.insertRow();
                const tanggalCell = row.insertCell();
                const keteranganCell = row.insertCell();

                tanggalCell.innerText = date;
                keteranganCell.innerText = libur.summary[0];

                rowCount++;
            });
        })
        .catch(error => {
            console.log('Terjadi kesalahan:', error);
        });
</script> -->

<?= $this->endSection() ?>