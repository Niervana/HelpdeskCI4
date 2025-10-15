<!-- title -->
<?= $this->section('title') ?>
<title>Users Fingerprint&mdash; Nirvana</title>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<!-- default -->
<?= $this->extend('layout/default') ?>
<!-- konten -->
<?= $this->section('content') ?>
<section class="section">
    <section class="section">
        <div class="section-header">
            <h1>Fingerprint Access</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Fingerprint Access</a></div>
            </div>
        </div>
        <div class="section-body">
            <!-- awal -->
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Solution X-100C</h4>
                        </div>
                        <div class=" card-body text-center">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?= base_url() ?>/template/assets/img/1.jpg" alt="MBAA">
                                    </div>
                                </div>
                            </div>
                            <div>&nbsp;
                                <div class="buttons">
                                    <a id="myButton" href="<?= base_url('userdatafingerprint'); ?>" class="btn btn-primary">Tarik Userdata</a>
                                    <a id="myTombol" href="<?= base_url('attendancedatafingerprint'); ?>" class="btn btn-primary">Tarik Attendance</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- akhir -->

    </section>
    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script>
        const myButton = document.getElementById("myButton");
        myButton.addEventListener("click", function() {
            myButton.classList.add("disabled", "btn-progress");
            myButton.setAttribute("disabled", "true");
        });
        const myTombol = document.getElementById("myTombol");
        myTombol.addEventListener("click", function() {
            myTombol.classList.add("disabled", "btn-progress");
            myTombol.setAttribute("disabled", "true");
        });
    </script>
    <?= $this->endSection() ?>