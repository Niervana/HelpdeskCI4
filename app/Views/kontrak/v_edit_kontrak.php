      <!-- titel -->
      <?= $this->section('title') ?>
      <title>Update Data Karyawan &mdash; HRM</title>
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
                  <h1>Update Data Karyawan Kontrak</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('kontrak'); ?>">Tabel Data Karyawan</a></div>
                      <div class="breadcrumb-item">Update Data Karyawan Kontrak</div>
                  </div>
              </div>
              <div class="section-body">
                  <div class="row">
                      <div class="col-12 col-md-6 col-lg-6">
                          <div class="card">
                              <div class="card-header">
                                  <h4>Edit Data</h4>
                              </div>
                              <div class="card-body">
                                  <form action="<?= site_url('kontrak' . $karyawankontrak->id_kontrak) ?>" method="post" autocomplete="off">
                                      <?= csrf_field() ?>
                                      <input type="hidden" name="_method" value="PUT">
                                      <label for="kontrak_awal">Awal / Mulai*</label> &emsp;&emsp;&emsp;&emsp;&emsp;<label for="kontrak_akhir">Kontrak Akhir*</label>
                                      <div class="form-group">
                                          <input type="date" name="kontrak_awal" value="<?= $karyawankontrak->kontrak_awal ?>" class="form-control form-check-inline col-md-3" required>
                                          <input type="date" name="kontrak_akhir" value="<?= $karyawankontrak->kontrak_akhir ?>" class="form-control form-check-inline col-md-3" required>
                                      </div>

                                      <!-- Buat javascipt -->
                                      <!-- <div class="form-group">
                                          <label>Date Range Picker</label>
                                          <div class="input-group">
                                              <div class="input-group-prepend">
                                                  <div class="input-group-text">
                                                      <i class="fas fa-calendar"></i>
                                                  </div>
                                              </div>
                                              <input type="text" name="daterange" value="<?= $karyawankontrak->kontrak_awal ?>">
                                          </div>
                                      </div>
                                      <div class="form-group"> -->
                                      <div class="form-group">
                                          <div class="control-label">Renew</div>
                                          <label class="custom-switch mt-2">
                                              <input type="checkbox" name="renew" value="Renew" class="custom-switch-input form-control">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description">Iya atuh masa engga</span>
                                          </label>
                                      </div>
                              </div>

                          </div>
                          <button type="submit" class="btn btn-success">Save <i class="fas fa-floppy-disk"></i></button>
                          </form>
                      </div>
                  </div>
              </div>
      </div>
      </div>
      </section>
      </div>


      <!-- akhir -->
      <!-- <script>
          $(function() {
              $('input[name="daterange"]').daterangepicker({
                  // Format tanggal yang ditampilkan pada elemen input
                  locale: {
                      format: 'MM/DD/YYYY'
                  },
                  // Rentang tanggal awal dan akhir yang dapat dipilih
                  startDate: moment().startOf('hour'),
                  endDate: moment().startOf('hour').add(32, 'hour'),
                  // Callback function yang akan dipanggil ketika range tanggal diubah
                  // Fungsi ini akan menampilkan rentang tanggal yang dipilih pada console log
                  "apply.daterangepicker": function(ev, picker) {
                      console.log("Range Tanggal: " + picker.startDate.format('MM/DD/YYYY') + " - " + picker.endDate.format('MM/DD/YYYY'));
                  }
              });
          });
      </script> -->
      <?= $this->endSection() ?>