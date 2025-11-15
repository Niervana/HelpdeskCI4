<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data CCTV Inventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .header-info p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="header-info">
        <h1>Data CCTV Inventory</h1>
        <p><strong>Tanggal Cetak:</strong> <?= date('d-m-Y H:i:s') ?></p>
        <p><strong>Total Data:</strong> <?= count($cctv) ?> item</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Tipe Kamera</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>IP Address</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cctv)): ?>
                <?php $no = 1;
                foreach ($cctv as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($item['lokasi']) ?></td>
                        <td><?= esc($item['tipe_kamera']) ?></td>
                        <td><?= esc($item['merk']) ?></td>
                        <td><?= esc($item['model']) ?></td>
                        <td><?= esc($item['serial_number']) ?></td>
                        <td><?= esc($item['ip_address']) ?></td>
                        <td><?= esc($item['status']) ?></td>
                        <td><?= esc($item['keterangan'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data CCTV</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>