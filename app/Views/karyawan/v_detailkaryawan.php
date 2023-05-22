      <!-- titel -->
      <?= $this->section('title') ?>
      <title>Details Karyawan &mdash; HRM</title>
      <?= $this->endSection() ?>
      <!-- header -->
      <?= $this->section('header') ?>
      <div class="main-wrapper main-wrapper-1">
          <?= $this->endSection() ?>
          <?= $this->extend('layout/default') ?>
          <!-- konten -->
          <?= $this->section('content') ?>
          <!-- awal -->
          <section class="section">
              <div class="section-header">
                  <h1>Details</h1>
                  </h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('karyawan'); ?>">Tabel Data Karyawan</a></div>
                      <div class="breadcrumb-item">Detail Karyawan</div>
                  </div>
              </div>
              <div class="section-body">
                  <div class="row">
                      <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                          <div class="card">
                              <div class="card-header">
                                  <figure class="avatar mr-2 avatar-xl">
                                      <img src="/avatar-2.png" alt="avatar">
                                  </figure>
                                  <h4><?php

                                        use Kint\Zval\Value;

                                        echo $karyawan->nama_karyawan; ?></h4>
                              </div>
                              <div class="card-body">
                                  <?php
                                    $fields = [
                                        'ID Karyawan' => 'id_karyawan',
                                        'NIK' => 'nik_karyawan',
                                        'Jenis Kelamin' => 'gender_karyawan',
                                        'Tanggal Lahir' => 'tgl_lahir',
                                        'Tempat Lahir' => 'tmpt_lahir',
                                        'Alamat' => 'alamat_karyawan',
                                        'Email' => 'email_karyawan',
                                        'Pendidikan Terakhir' => 'pendidikan_karyawan',
                                        'Jurusan Terakhir' => 'jurusan_pendidikan',
                                        'Devisi' => 'devisi_karyawan',
                                        'Jabatan' => 'jabatan_karyawan',
                                        'Status' => 'status_karyawan',
                                        'No.Telp' => 'nomor_telp',
                                        'Tanggal Masuk' => 'tanggal_masuk',
                                        'Badan Usaha' => 'badan_usaha'
                                    ];
                                    $gender = ($karyawan->gender_karyawan === "L") ? "Laki-laki" : "Perempuan";
                                    foreach ($fields as $label => $field) :
                                    ?>
                                      <h6><?php echo "$label : ";
                                            if ($field == 'gender_karyawan') {
                                                echo $gender;
                                            } else {
                                                echo "{$karyawan->$field}";
                                            }
                                            ?></h6>
                                  <?php endforeach; ?>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </section>
      </div>
      <!-- akhir -->
      <?= $this->endSection() ?>