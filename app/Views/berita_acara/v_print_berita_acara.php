<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara - <?= esc($berita_acara['jenis_kegiatan']) ?></title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18pt;
            text-transform: uppercase;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 14pt;
            font-weight: normal;
        }

        .content {
            margin: 20px 0;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .info-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }

        .info-table .label {
            font-weight: bold;
            background-color: #f5f5f5;
            width: 30%;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin: 40px 0 5px 0;
            padding-bottom: 5px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10pt;
            color: #666;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>BERITA ACARA</h1>
        <h2><?= esc($berita_acara['jenis_kegiatan']) ?></h2>
        <p>Nomor: BA/<?= date('Y', strtotime($berita_acara['tanggal'])) ?>/<?= esc($berita_acara['beritaacara_id']) ?></p>
    </div>

    <div class="content">
        <p>Pada hari ini, <strong><?php
                                    $hari = date('l', strtotime($berita_acara['tanggal']));
                                    $hari_indonesia = [
                                        'Monday' => 'Senin',
                                        'Tuesday' => 'Selasa',
                                        'Wednesday' => 'Rabu',
                                        'Thursday' => 'Kamis',
                                        'Friday' => 'Jumat',
                                        'Saturday' => 'Sabtu',
                                        'Sunday' => 'Minggu'
                                    ];
                                    echo $hari_indonesia[$hari] ?? $hari;
                                    ?></strong> tanggal <strong><?= date('d', strtotime($berita_acara['tanggal'])) ?></strong> bulan <strong><?php
                                                                                                                                                $bulan = date('F', strtotime($berita_acara['tanggal']));
                                                                                                                                                $bulan_indonesia = [
                                                                                                                                                    'January' => 'Januari',
                                                                                                                                                    'February' => 'Februari',
                                                                                                                                                    'March' => 'Maret',
                                                                                                                                                    'April' => 'April',
                                                                                                                                                    'May' => 'Mei',
                                                                                                                                                    'June' => 'Juni',
                                                                                                                                                    'July' => 'Juli',
                                                                                                                                                    'August' => 'Agustus',
                                                                                                                                                    'September' => 'September',
                                                                                                                                                    'October' => 'Oktober',
                                                                                                                                                    'November' => 'November',
                                                                                                                                                    'December' => 'Desember'
                                                                                                                                                ];
                                                                                                                                                echo $bulan_indonesia[$bulan] ?? $bulan;
                                                                                                                                                ?></strong> tahun <strong><?= date('Y', strtotime($berita_acara['tanggal'])) ?></strong>, telah dilakukan kegiatan sebagai berikut:</p>

        <table class="info-table">
            <tr>
                <td class="label">Jenis Kegiatan</td>
                <td>: <?= esc($berita_acara['jenis_kegiatan']) ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal & Waktu</td>
                <td>: <?= date('d F Y, H:i', strtotime($berita_acara['tanggal'])) ?> WIB</td>
            </tr>
            <tr>
                <td class="label">Lokasi</td>
                <td>: <?= esc($berita_acara['lokasi']) ?></td>
            </tr>
            <tr>
                <td class="label">Pelaksana</td>
                <td>: <?= esc($berita_acara['pelaksana']) ?></td>
            </tr>
        </table>

        <h3>Keterangan:</h3>
        <div style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; min-height: 100px; background-color: #f9f9f9;">
            <p style="margin: 0; white-space: pre-line;"><?= esc($berita_acara['keterangan']) ?></p>
        </div>

        <p>Demikian berita acara ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p>Pelaksana,</p>
            <p><?= esc($berita_acara['pelaksana']) ?></p>
            <div class="signature-line"></div>
            <p>( ____________________ )</p>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?> | Niervana IT Helpdesk</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>