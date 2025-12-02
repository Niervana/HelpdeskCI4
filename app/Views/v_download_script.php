<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Download Inventory Collector Script</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Download Inventory Collector Script</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle"></i> Instruksi Penggunaan:</h5>
                            <ol>
                                <li>Jalankan inventory_collector yang telah di unduh pada folder download.</li>
                                <li>Masukkan email Anda yang terdaftar saat diminta.</li>
                                <li>Script akan mengumpulkan spesifikasi PC Anda dan mengirimkan data collect ke server.</li>
                                <li>Data yang dikumpulkan: manufaktur, CPU, RAM, OS, IP address, hostname, storage.</li>
                                <li>Data lainnya (jenis, lisensi, dll.) akan di check manual oleh IT.</li>
                            </ol>
                        </div>
                        <div class="row justify-content-center mb-4">
                            <div class="col-12 col-md-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white d-flex justify-content-center">
                                        <h5>Executable File</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="https://drive.usercontent.google.com/download?id=1TT41lFU2aSuwd69726Sd2ddKEjCsAM08&export=download&authuser=0" class="btn btn-primary btn-lg" target="_blank">
                                            <!-- <a href="https://drive.google.com/file/d/1CNhj52Xav-o2dSVgA4m7KIcOe0wWJLmU/view?usp=sharing" class="btn btn-primary btn-lg" target="_blank"> -->
                                            <i class="fas fa-download"></i> inventory_collector.exe
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5>Penyelesaian Masalah:</h5>
                            <ul>
                                <li>Jika terjadi error saat membaca data, kemungkinan beberapa informasi tidak tersedia di sistem komputer Anda.</li>
                                <li>Pastikan alamat email yang Anda masukkan sudah terdaftar di sistem IT Helpdesk.</li>
                                <li>Jika gagal terhubung, periksa koneksi internet Anda dan pastikan tidak ada firewall yang memblokir.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-4">
                        <div class="card-body text-center">
                            <a href="https://github.com/Niervana/ITHelpdeskAPIPy.git" target="_blank" class="btn btn-info btn-lg"><i class="fab fa-github"></i> View on GitHub</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>