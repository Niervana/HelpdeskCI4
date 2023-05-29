 <?= $this->extend('layout/default') ?>
 <?= $this->section('title') ?>
 <title>Absensi &mdash; Nirvana</title>
 <?= $this->endSection() ?>
 <?= $this->section('content') ?>
 <section class="section">
     <div class="section-header">
         <h1>Ini absen staff</h1>
     </div>
     <div class="section-body">
         <pre>
            <?php var_dump($absen); ?>
         </pre>

     </div>
 </section>
 <?= $this->endSection() ?>