<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Inventory IT - Main Device</title>
    <style>
        @page {
            margin: 10mm;
            size: A4 landscape;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8pt;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #333;
        }

        .header h1 {
            font-size: 14pt;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 9pt;
            color: #666;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7pt;
        }

        .data-table th {
            background-color: #007bff;
            color: white;
            padding: 5px 2px;
            text-align: center;
            border: 1px solid #007bff;
            font-weight: bold;
            font-size: 7pt;
            vertical-align: middle;
            white-space: nowrap;
        }

        .data-table td {
            padding: 4px 2px;
            border: 1px solid #ddd;
            vertical-align: top;
            font-size: 7pt;
            word-wrap: break-word;
            overflow: hidden;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Column width optimization */
        .col-no {
            width: 3%;
        }

        .col-name {
            width: 12%;
        }

        .col-dept {
            width: 10%;
        }

        .col-mfr {
            width: 8%;
        }

        .col-type {
            width: 8%;
        }

        .col-cpu {
            width: 10%;
        }

        .col-ram {
            width: 6%;
        }

        .col-os {
            width: 8%;
        }

        .col-lic-win {
            width: 10%;
        }

        .col-storage {
            width: 8%;
        }

        .col-office {
            width: 8%;
        }

        .col-lic-off {
            width: 10%;
        }

        .col-ip {
            width: 10%;
        }

        .col-host {
            width: 10%;
        }

        .col-cred {
            width: 10%;
        }

        .text-center {
            text-align: center;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .footer {
            position: fixed;
            bottom: 5mm;
            left: 5mm;
            right: 5mm;
            text-align: center;
            font-size: 8pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 3px;
        }

        /* Abbreviations helper */
        abbr {
            text-decoration: none;
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DATA INVENTORY IT - MAIN DEVICE</h1>
        <p>Dicetak: <?= date('d/m/Y H:i:s') ?> | Total: <?= count($inventory) ?> items</p>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-name">Nama Karyawan</th>
                <th class="col-dept">Departemen</th>
                <th class="col-mfr">Manufaktur</th>
                <th class="col-type">Jenis</th>
                <th class="col-cpu">CPU</th>
                <th class="col-ram">RAM</th>
                <th class="col-os">OS</th>
                <th class="col-lic-win">Lic.Win</th>
                <th class="col-storage">Storage</th>
                <th class="col-office">Office</th>
                <th class="col-lic-off">Lic.Off</th>
                <th class="col-ip">IP Address</th>
                <th class="col-host">Hostname</th>
                <th class="col-cred">Credential</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($inventory)): ?>
                <?php $no = 1;
                foreach ($inventory as $item): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-truncate"><?= esc($item->nama_karyawan) ?></td>
                        <td class="text-truncate"><?= esc($item->departemen_karyawan) ?></td>
                        <td class="text-truncate"><?= esc($item->manufaktur ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->jenis ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->cpu ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->ram ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->os ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->lisensi_windows ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->storage ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->office ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->lisensi_office ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->ipaddress ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->hostname ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->credential ?: '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="15" class="text-center" style="padding: 10px;">Tidak ada data inventory</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        IT Support System - Data Inventory Main Device |Develop By Nirvana| Halaman <span class="page-number"></span>
    </div>
</body>

</html>