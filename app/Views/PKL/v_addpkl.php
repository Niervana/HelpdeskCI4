      <!-- titel -->
      <?= $this->section('title') ?>
      <title>Tambah Data PKL &mdash; HRM</title>
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
                  <h1>Tambah Data PKL</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('pkl'); ?>">Tabel Data Praktek Kerja Lapangan</a></div>
                      <div class="breadcrumb-item">Tambah Data PKL</div>
                  </div>
              </div>
              <div class="section-body">
                  <div class="row">
                      <div class="col-12 col-md-6 col-lg-6">
                          <div class="card">
                              <div class="card-header">
                                  <h4>Input Data</h4>
                              </div>
                              <div class="card-body">
                                  <form action="<?= site_url('pkl') ?>" method="post" autocomplete="off">
                                      <?= csrf_field() ?>
                                      <div class="form-group">
                                          <label>NIS/NIM*</label>
                                          <div class="form-group">
                                              <input type="text" name="nisnim" pattern="[0-9]+" maxlength="16" class="form-control form-check-inline col-md-6" required>
                                          </div>
                                          <label>Nama Lengkap*</label>
                                          <input type="text" name="nama" class="form-control" required>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-check-inline">Tempat Tanggal Lahir* &ensp;</label>
                                          <input type="text" name="tl" class="form-control form-check-inline col-md-4" required>
                                          <input type="date" name="tgl" class="form-control form-check-inline col-md-3">
                                      </div>
                                      <div class="form-group">
                                          <label>Asal Sekolah*</label>
                                          <input type="text" name="sekolah" class="form-control" required>
                                      </div>
                                      <div class="form-group">
                                          <label>Jurusan*</label>
                                          <input type="text" name="jurusan" class="form-control" required>
                                      </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-6">
                          <div class="card">
                              <div class="card-header">
                                  <div class="section-title mt-0">Penempatan</div>
                              </div>
                              <div class="card-body col-md-9">
                                  <label>Departement</label>
                                  <div class="form-group">
                                      <select name="departemen" class="form-control">
                                          <option value="ADM">ADM</option>
                                          <option value="Boiler">Boiler</option>
                                          <option value="C.Bleaching">C.Bleaching</option>
                                          <option value="C.Washing">C.Washing</option>
                                          <option value="Compacting">Compacting</option>
                                          <option value="CPB">CPB</option>
                                          <option value="CSB">CSB</option>
                                          <option value="G.Obat">G.Obat</option>
                                          <option value="GA">GA</option>
                                          <option value="Gudang Greige">Gudang Greige</option>
                                          <option value="Gudang Kain Jadi">Gudang Kain Jadi</option>
                                          <option value="Gudang Obat">Gudang Obat</option>
                                          <option value="HRD">HRD</option>
                                          <option value="Inspecting Greige">Inspecting Greige</option>
                                          <option value="Inspecting Grey">Inspecting Grey</option>
                                          <option value="IT">IT</option>
                                          <option value="K3">K3</option>
                                          <option value="Kantin">Kantin</option>
                                          <option value="Laboratorium">Laboratorium</option>
                                          <option value="LB3">LB3</option>
                                          <option value="LH/WWTP">LH/WWTP</option>
                                          <option value="LongTube">LongTube</option>
                                          <option value="Marketing">Marketing</option>
                                          <option value="Packing">Packing</option>
                                          <option value="Pajak">Pajak</option>
                                          <option value="Pembelian">Pembelian</option>
                                          <option value="PPIC">PPIC</option>
                                          <option value="Printing">Printing</option>
                                          <option value="Produksi">Produksi</option>
                                          <option value="QC">QC</option>
                                          <option value="Sample">Sample</option>
                                          <option value="Security">Security</option>
                                          <option value="Stenter">Stenter</option>
                                          <option value="Teknik">Teknik</option>
                                          <option value="Trading">Trading</option>
                                          <option value="Umum">Umum</option>
                                          <option value="Winding">Winding</option>
                                          <option value="WWTP">WWTP</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-check-inline">Mulai*</label>
                                      <input type="date" name="mulai" class="form-control form-check-inline" required>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-check-inline">Berakhir*</label>
                                      <input type="date" name="berakhir" class="form-control form-check-inline" required>
                                  </div>
                                  <button type="submit" class="btn btn-success">Save <i class="fas fa-floppy-disk"></i></button>
                                  <button type="reset" class="btn btn-secondary">Reset <i class="fas fa-arrows-rotate"></i></button>
                              </div>
                              </form>
                          </div>
                      </div>
          </section>
      </div>
      <!-- akhir -->
      <?= $this->endSection() ?>