<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">

<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <style type="text/css">
    < !-- @page {
      size: A4 landscape;
      margin: 0;
    }

    body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      background-size: 100% 100%;
      background-repeat: no-repeat;
      background-image: url('<?= base_url() ?>img/sertifikat.png">');
    }

    .page {
      position: relative;
      width: 100%;
      height: 100%;
    }

    p {
      margin: 0;
      padding: 0;
    }

    .ft10 {
      font-size: 15px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #000000;
    }

    .ft11 {
      font-size: 15px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #000000;
    }

    .ft12 {
      font-size: 30px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #000000;
    }

    .ft13 {
      font-size: 25px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #2b6c49;
    }

    .ft14 {
      font-size: 12px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #000000;
    }

    .ft15 {
      font-size: 11px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #000000;
    }

    .ft16 {
      font-size: 12px;
      /* Menyesuaikan ukuran font agar lebih sesuai dengan format A4 */
      line-height: 20px;
      /* Menyesuaikan ukuran line-height agar lebih sesuai dengan format A4 */
      font-family: Times;
      color: #000000;
    }

    .center-image {
      max-width: 100%;
      max-height: 100%;
    }

    -->
  </style>
</head>

<body>

  <!-- Main container -->
  <div id="page1-div" style="position: relative;">
    <!-- Certificate image -->
    <img class="center-image" width="1666" height="1320" src="<?= base_url() ?>img/sertifikat.png">
    <!-- Company name -->
    <p style="position: absolute; top: 43px; left: 0; right: 0; text-align: center;" class="ft10">
      <b>PT. HARAPAN KURNIA TEXTILE INDONESIA</b>
    </p>
    <!-- Company address -->
    <p style="position: absolute; top: 74px; left: 0; right: 0; text-align: center;" class="ft11">
      JL. Letkol GA Manulang No 73 Padalarang, 40553 Jawa Barat
    </p>
    <!-- Company contact -->
    <p style="position: absolute; top: 108px; left: 0; right: 0; text-align: center;" class="ft11">
      Telp. 022-6808008/022-6809747 Fax. 022-6809748
    </p>
    <!-- Certificate title -->
    <p style="position: absolute; top: 189px; left: 0px; text-align: center; width: 100%;" class="ft12">
      <b style="letter-spacing: 1px"><u>S E R T I F I K A T</u></b>
    </p>
    <!-- Certificate number -->
    <p style="position: absolute; top: 224px; left: 0; right: 0; text-align: center;" class="ft11">
      No: <?php echo $pkl->sertifikat; ?>
    </p>
    <!-- Info -->
    <p style="position: absolute; top: 270px; left: 0; right: 0; text-align: center;" class="ft11">
      Pimpinan / Manajer HRD / Bagian Diklat PT. Harapan Kurnia Textile Indonesia, memberikan sertifikat kepada :
    </p>
    <!-- Certificate recipient -->
    <p style="position: absolute; top: 300px; left: 0; right: 0; text-align: center;" class="ft13">
      <b><?= $pkl->nama; ?></b>
    </p>
    <!-- Info -->
    <p style="position: absolute; top: 350px; left: 0; right: 0; text-align: center;" class="ft14">
      Tempat, Tanggal Lahir &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?= $pkl->tl; ?>, <?= $pkl->tgl; ?>
    </p>
    <p style="position: absolute; top: 365px; left: 0; right: 0; text-align: center;" class="ft14">
      Nomor Induk Siswa/Mahasiswa &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?= $pkl->nisnim; ?>
    </p>
    <p style="position: absolute; top: 380px; left: 0; right: 0; text-align: center;" class="ft14">
      Prodi / Jurusan &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp; &nbsp; &nbsp; <?= $pkl->jurusan; ?>
    </p>
    <p style="position: absolute; top: 400px; left: 0; right: 0; text-align: center;" class="ft11">
      Telah menyelesaikan program Magang di PT. Harapan Kurnia Textile Indonesia yang diselenggarakan mulai dari
    </p>
    <p style="position: absolute; top: 420px; left: 0; right: 0; text-align: center;" class="ft11">
      tanggal <?php
              $tglMulai = new DateTime($pkl->mulai);
              $tglBerakhir = new DateTime($pkl->berakhir);
              $selama = $tglMulai->diff($tglBerakhir)->m;
              echo $pkl->mulai;
              ?> s/d <?php echo $pkl->berakhir ?> selama <?php echo $selama ?> Bulan dengan kualifikasi :
    <p style="position: absolute; top: 440px; left: 0; right: 0; text-align: center;" class="ft11">
      NILAI
    </p>
    <p style="position: absolute; top: 490px; left: 0; right: 0; text-align: center;" class="ft14">
      Padalarang, <?php echo date('d-m-y') ?>
    </p>
    <p style="position: absolute; top: 510px; left: 0; right: 0; text-align: center; white-space: nowrap;" class="ft14">
      Pimpinan Perusahaan
    </p>
    <!-- Signature -->
    <p style="position: absolute; top: 720px; left: 0; right: 0; text-align: center; white-space: nowrap;" class="ft15">
      HRD Manager
    </p>
    <!-- Signature name -->
    <p style="position: absolute; top: 700px; left: 0; right: 0; text-align: center; white-space: nowrap;" class="ft14">
      Winner Mardohar Parulian Tambunan
    </p>
  </div>
</body>

</html>