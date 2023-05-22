      <!-- titel -->
      <?= $this->section('title') ?>
      <title>Tambah Data Karyawan &mdash; HRM</title>
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
                  <h1>Tambah Data Karyawan</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('karyawan'); ?>">Tabel Data Karyawan</a></div>
                      <div class="breadcrumb-item">Tambah Data Karyawan</div>
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
                                  <form action="<?= site_url('karyawan') ?>" method="post" autocomplete="off">
                                      <?= csrf_field() ?>
                                      <div class="form-group">
                                          <label for="id_karyawan">ID Karyawan*</label> &emsp;&emsp;&emsp;&emsp;&emsp;<label for="nik_karyawan">Nomor Induk Kependudukan*</label>
                                          <div class="form-group">
                                              <input type="text" name="id_karyawan" pattern="[0-9]+" maxlength="4" class="form-control form-check-inline col-md-3" required>
                                              <input type="text" name="nik_karyawan" pattern="[0-9]+" maxlength="16" class="form-control form-check-inline col-md-6" required>
                                          </div>
                                          <label>Nama Lengkap*</label>
                                          <input type="text" name="nama_karyawan" class="form-control" required>
                                      </div>
                                      <div class="form-group">
                                          <label class="form-check-inline">Tempat Tanggal Lahir* &ensp;</label>
                                          <input type="text" name="tmpt_lahir" class="form-control form-check-inline col-md-4" required>
                                          <input type="date" name="tgl_lahir" class="form-control form-check-inline col-md-3" required>
                                      </div>
                                      <div class="form-group">
                                          <label>Alamat lengkap</label>
                                          <input type="text" name="alamat_karyawan" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label class="form-label">Jenis Kelamin</label>
                                          <div class="selectgroup w-100">
                                              <label class="selectgroup-item">
                                                  <input type="radio" name="gender_karyawan" value="L" class="selectgroup-input" checked="">
                                                  <span class="selectgroup-button">Laki-laki</span>
                                              </label>
                                              <label class="selectgroup-item">
                                                  <input type="radio" name="gender_karyawan" value="P" class="selectgroup-input">
                                                  <span class="selectgroup-button">Perempuan</span>
                                              </label>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label>email</label>
                                          <input type="text" name="email_karyawan" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>contact</label>
                                          <input type="text" name="nomor_telp" pattern="[0-9]+" class="form-control">
                                      </div>
                                      <label>Pendidikan Terakhir</label>
                                      <div class="form-group">
                                          <select name="pendidikan_karyawan" class="form-control">
                                              <option value="SD">SD</option>
                                              <option value="SMP">SMP</option>
                                              <option value="SMK">SMK</option>
                                              <option value="SMA">SMA</option>
                                              <option value="SLTA">SLTA</option>
                                              <option value="STM">STM</option>
                                              <option value="D1">D1</option>
                                              <option value="D2">D2</option>
                                              <option value="D3">D3</option>
                                              <option value="S1">S1</option>
                                              <option value="S2">S2</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Jurusan</label>
                                          <input type="text" name="jurusan_pendidikan" class="form-control">
                                      </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-6">
                          <div class="card">
                              <div class="card-header">
                                  <div class="section-title mt-0">Posisi</div>
                              </div>
                              <div class="card-body col-md-9">
                                  <label>Departement</label>
                                  <div class="form-group">
                                      <select name="devisi_karyawan" class="form-control">
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
                                  <label>Jabatan</label>
                                  <div class="form-group">
                                      <select name="jabatan_karyawan" class="form-control">
                                          <option value="Manager">Manager</option>
                                          <option value="Komandan Regu">Komandan Regu</option>
                                          <option value="Kepala Bagian">Kepala Bagian</option>
                                          <option value="Kepala Shift">Kepala Shift</option>
                                          <option value="Wakil Kepala Bagian">Wakil Kepala Bagian</option>
                                          <option value="Wakil Kepala Regu">Wakil Kepala Regu</option>
                                          <option value="Staff">Staff</option>
                                          <option value="Staff SPV Area">Staff SPV Area</option>
                                          <option value="Operator">Operator</option>
                                          <option value="Anggota">Anggota</option>
                                          <option value="Juru Masak">Juru Masak</option>
                                          <option value="PHL">PHL</option>
                                      </select>
                                  </div>
                                  <label>Status Karyawan</label>
                                  <div class="form-group">
                                      <select name="status_karyawan" class="form-control">
                                          <option value="Tetap">Tetap</option>
                                          <option value="Kontrak">Kontrak</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-check-inline">Tanggal Masuk</label>
                                      <input type="date" name="tanggal_masuk" class="form-control form-check-inline" required>
                                  </div>
                                  <label>Badan Usaha</label>
                                  <div class="form-group">
                                      <select name="badan_usaha" class="form-control">
                                          <option value="HKTI">HKTI</option>
                                          <option value="KJP">KJP</option>
                                          <option value="198">198</option>
                                          <option value="KTN">KTN</option>
                                          <option value="HSB">HSB</option>
                                          <option value="KPN">KPN</option>
                                          <option value="CHM">CHM</option>
                                      </select>
                                  </div>
                                  <button type="submit" class="btn btn-success">Save <i class="fas fa-floppy-disk"></i></button>
                                  <button type="reset" class="btn btn-secondary">Reset <i class="fas fa-arrows-rotate"></i></button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

          </section>
      </div>
      <!-- akhir -->
      <?= $this->endSection() ?>