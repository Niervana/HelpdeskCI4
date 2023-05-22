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
                  <h1>Update Data Karyawan</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="<?= base_url('karyawan'); ?>">Tabel Data Karyawan</a></div>
                      <div class="breadcrumb-item">Update Data Karyawan</div>
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
                                  <form action="<?= site_url('karyawan' . $karyawan->id_tetap) ?>" method="post" autocomplete="off">
                                      <?= csrf_field() ?>
                                      <input type="hidden" name="_method" value="PUT">
                                      <label>ID Karyawan</label> &emsp;&emsp;&emsp;&emsp;&emsp;<label>Nomor Induk Kependudukan</label>
                                      <div class="form-group">
                                          <input type="text" name="id_karyawan" value="<?= $karyawan->id_karyawan ?>" pattern="[0-9]+" maxlength="4" class="form-control form-check-inline col-md-3">
                                          <input type="text" name="nik_karyawan" value="<?= $karyawan->nik_karyawan ?>" pattern="[0-9]+" maxlength="16" class="form-control form-check-inline col-md-6">
                                      </div>
                                      <div class="form-group">
                                          <label>Nama Lengkap</label>
                                          <input type="text" name="nama_karyawan" value="<?= $karyawan->nama_karyawan ?>" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label class="form-check-inline">Tempat Tanggal Lahir &ensp;</label>
                                          <input type="text" name="tmpt_lahir" value="<?= $karyawan->tmpt_lahir ?>" class="form-control form-check-inline col-md-3">
                                          <input type="date" name="tgl_lahir" value="<?= $karyawan->tgl_lahir ?>" class="form-control form-check-inline col-md-3">
                                      </div>
                                      <div class="form-group">
                                          <label>Alamat Lengkap</label>
                                          <input type="text" name="alamat_karyawan" value="<?= $karyawan->alamat_karyawan ?>" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label class="form-label">Jenis Kelamin</label>
                                          <div class="selectgroup w-100">
                                              <label class="selectgroup-item">
                                                  <input type="radio" name="gender_karyawan" value="L" id="L" class="selectgroup-input" <?= ($karyawan->gender_karyawan == "L") ? "checked" : "" ?>>
                                                  <span class="selectgroup-button">Laki-laki</span>
                                              </label>
                                              <label class="selectgroup-item">
                                                  <input type="radio" name="gender_karyawan" value="P" id="P" class="selectgroup-input" <?= ($karyawan->gender_karyawan == "P") ? "checked" : "" ?>>
                                                  <span class="selectgroup-button">Perempuan</span>
                                              </label>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label>email</label>
                                          <input type="text" name="email_karyawan" value="<?= $karyawan->email_karyawan ?>" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>contact</label>
                                          <input type="text" name="nomor_telp" pattern="[0-9]+" value="<?= $karyawan->nomor_telp ?>" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>Pendidikan Terakhir</label>
                                          <div class="form-group">
                                              <?php
                                                $pendidikanList = [
                                                    'SD', 'SMP', 'SMK', 'SMA', 'STM', 'SLTA', 'D1', 'D2', 'D3', 'S1', 'S2'
                                                ];
                                                ?>
                                              <select name="pendidikan_karyawan" class="form-control">
                                                  <?php foreach ($pendidikanList as $pendidikan_karyawan) : ?>
                                                      <option value="<?= $pendidikan_karyawan ?>" <?= $karyawan->pendidikan_karyawan === $pendidikan_karyawan ? 'selected' : '' ?>><?= $pendidikan_karyawan ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label>Jurusan</label>
                                          <input type="text" name="jurusan_pendidikan" value="<?= $karyawan->jurusan_pendidikan ?>" class="form-control">
                                      </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-6">
                          <d class="card">
                              <div class="card-header">
                                  <div class="section-title mt-0">Posisi</div>
                              </div>
                              <div class="card-body col-md-9">
                                  <label>Departement</label>
                                  <div class="form-group">
                                      <?php
                                        $departemenList = [
                                            'ADM', 'Boiler', 'C.Bleaching', 'C.Washing', 'Compacting', 'CPB', 'CSB', 'G.Obat', 'GA', 'Gudang Greige',
                                            'Gudang Kain Jadi', 'Gudang Obat', 'HRD', 'Inspecting Greige', 'Inspecting Grey', 'IT', 'K3', 'Kantin', 'Laboratorium', 'LB3',
                                            'LH/WWTP', 'Long Tube', 'Marketing', 'Packing', 'Pajak', 'Pembelian', 'PPIC', 'Printing', 'Produksi', 'QC', 'Sample', 'Security',
                                            'Teknik', 'Trading', 'Umum', 'Winding', 'WWTP'
                                        ];
                                        ?>
                                      <select name="devisi_karyawan" class="form-control">
                                          <?php foreach ($departemenList as $devisi_karyawan) : ?>
                                              <option value="<?= $devisi_karyawan ?>" <?= $karyawan->devisi_karyawan === $devisi_karyawan ? 'selected' : '' ?>><?= $devisi_karyawan ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>

                                  <label>Jabatan</label>
                                  <div class="form-group">
                                      <?php
                                        $jabatanList = [
                                            'Manager', 'Komandan Regu', 'Kepala Bagian', 'Kepala Regu', 'Kepala Shift', 'Wakil Kepala Bagian',
                                            'Wakil Kepala Regu', 'Staff', 'Staff SPV Area', 'Operator', 'Anggota',
                                            'Juru Masak', 'PHL'
                                        ];
                                        ?>
                                      <select name="jabatan_karyawan" class="form-control">
                                          <?php foreach ($jabatanList as $jabatan_karyawan) : ?>
                                              <option value="<?= $jabatan_karyawan ?>" <?= $karyawan->jabatan_karyawan === $jabatan_karyawan ? 'selected' : '' ?>><?= $jabatan_karyawan ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>

                                  <label>Status Karyawan</label>
                                  <div class="form-group">
                                      <div class="form-group">
                                          <?php
                                            $statusList = [
                                                'Tetap', 'Kontrak'
                                            ];
                                            ?>
                                          <select name="status_karyawan" class="form-control">
                                              <?php foreach ($statusList as $status_karyawan) : ?>
                                                  <option value="<?= $status_karyawan ?>" <?= $karyawan->status_karyawan === $status_karyawan ? 'selected' : '' ?>><?= $status_karyawan ?></option>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-check-inline">Tanggal Masuk</label>
                                      <input type="date" name="tanggal_masuk" value="<?= $karyawan->tanggal_masuk ?>" class="form-control form-check-inline" required>
                                  </div>
                                  <label>Badan Usaha</label>
                                  <div class="form-group">
                                      <div class="form-group">
                                          <?php
                                            $usahaList = [
                                                'HKTI', 'KJP', '198', 'KTN', 'HSB', 'KPN', 'CHM'
                                            ];
                                            ?>
                                          <select name="badan_usaha" class="form-control">
                                              <?php foreach ($usahaList as $badan_usaha) : ?>
                                                  <option value="<?= $badan_usaha ?>" <?= $karyawan->badan_usaha === $badan_usaha ? 'selected' : '' ?>><?= $badan_usaha ?></option>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>
                                  </div>
                                  <button type="submit" class="btn btn-success">Save <i class="fas fa-floppy-disk"></i></button>
                              </div>
                              </form>
                      </div>
                  </div>
          </section>
      </div>
      <!-- akhir -->
      <?= $this->endSection() ?>