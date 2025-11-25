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
                    <div class="card-header">
                        <h4><i class="fas fa-download"></i> Download Script untuk Mengumpulkan Data PC</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5><i class="fas fa-download"></i> Download Executable File (.exe)</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="https://drive.usercontent.google.com/download?id=1CNhj52Xav-o2dSVgA4m7KIcOe0wWJLmU&export=download&authuser=0&confirm=t&uuid=6afbcd75-ab00-42a9-b2e8-9c327b0d3cd3&at=ALWLOp5sHPjwIij3uoxy2mFPmnUC%3A1763974012421" class="btn btn-primary btn-lg" target="_blank">
                                            <!-- <a href="https://drive.google.com/file/d/1CNhj52Xav-o2dSVgA4m7KIcOe0wWJLmU/view?usp=sharing" class="btn btn-primary btn-lg" target="_blank"> -->
                                            <i class="fas fa-download"></i> Download inventory_collector.exe
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h5><i class="fab fa-github"></i> Repository GitHub</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="https://github.com/Niervana/ITHelpdeskAPIPy.git" target="_blank" class="btn btn-info btn-lg"><i class="fab fa-github"></i> View on GitHub</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle"></i> Instruksi Penggunaan:</h5>
                            <footer><i class="fas fa-info-circle"></i> Skip langkah 1- 4 jika mengunduh file execute</footer>
                            <ol>
                                <li>Unduh dan install Python (standalone) dari <a href="https://www.python.org/downloads/" target="_blank">https://www.python.org/downloads/</a></li>
                                <li>Unduh script Python dan file requirements.txt di bawah ini.</li>
                                <li>Install dependencies dengan menjalankan: <code>pip install -r requirements.txt</code></li>
                                <li>Jalankan script dengan: <code>python inventory_collector.py</code></li>
                                <li>Masukkan email Anda yang terdaftar saat diminta.</li>
                                <li>Script akan mengumpulkan spesifikasi PC Anda dan mengirimkannya ke server.</li>
                                <li>Data yang dikumpulkan: manufaktur, CPU, RAM, OS, IP address, hostname, storage.</li>
                                <li>Data lainnya (jenis, lisensi, dll.) akan diisi manual oleh admin.</li>
                            </ol>
                        </div>

                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Syarat Minimum:</h5>
                            <ul>
                                <li>Sistem operasi Windows 7, 8, 10, atau 11</li>
                                <li>Program Python versi 3.6 atau yang lebih baru</li>
                                <li>Koneksi internet untuk mengirim data ke server</li>
                            </ul>
                        </div>


                        <div class="mt-4">
                            <h5>Penyelesaian Masalah:</h5>
                            <ul>
                                <li>Jika program tidak bisa dijalankan, pastikan program Python sudah terinstall di komputer Anda.</li>
                                <li>Jika terjadi error saat membaca data, kemungkinan beberapa informasi tidak tersedia di sistem komputer Anda.</li>
                                <li>Pastikan alamat email yang Anda masukkan sudah terdaftar di sistem IT Helpdesk.</li>
                                <li>Jika gagal terhubung, periksa koneksi internet Anda dan pastikan tidak ada firewall yang memblokir.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>