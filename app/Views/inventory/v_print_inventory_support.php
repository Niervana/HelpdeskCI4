<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Inventory IT - Support Device</title>
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
            background-color: #28a745;
            color: white;
            padding: 5px 2px;
            text-align: center;
            border: 1px solid #28a745;
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
            width: 4%;
        }

        .col-name {
            width: 15%;
        }

        .col-dept {
            width: 12%;
        }

        .col-monitor {
            width: 10%;
        }

        .col-kbd {
            width: 10%;
        }

        .col-mouse {
            width: 10%;
        }

        .col-usb {
            width: 10%;
        }

        .col-ext {
            width: 10%;
        }

        .col-printer {
            width: 10%;
        }

        .col-scanner {
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
        <h1>DATA INVENTORY IT - SUPPORT DEVICE</h1>
        <p>Dicetak: <?= date('d/m/Y H:i:s') ?> | Total: <?= count($inventory) ?> items</p>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-name">Nama Karyawan</th>
                <th class="col-dept">Departemen</th>
                <th class="col-monitor">Monitor</th>
                <th class="col-kbd">Keyboard</th>
                <th class="col-mouse">Mouse</th>
                <th class="col-usb">USB Conv</th>
                <th class="col-ext">Ext.Storage</th>
                <th class="col-printer">Printer</th>
                <th class="col-scanner">Scanner</th>
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
                        <td class="text-truncate"><?= esc($item->monitor ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->keyboard ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->mouse ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->usb_converter ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->external_storage ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->printer ?: '-') ?></td>
                        <td class="text-truncate"><?= esc($item->scanner ?: '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center" style="padding: 10px;">Tidak ada data inventory</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        IT Support System - Data Inventory Support Device |Develop By Nirvana| Halaman <span class="page-number"></span>
    </div>
</body>

</html>