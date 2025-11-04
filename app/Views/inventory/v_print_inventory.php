<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Inventory IT</title>
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

        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>
    <h1>Data Inventory IT</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Main Device</th>
                <th>Support Device</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($inventory)): ?>
                <?php foreach ($inventory as $item): ?>
                    <tr>
                        <td><?= esc($item->nama_karyawan) ?></td>
                        <td><?= esc($item->departemen_karyawan) ?></td>
                        <td>
                            <?php if ($item->manufaktur): ?>
                                <?= esc($item->manufaktur . ' ' . $item->jenis . ' (' . $item->cpu . ', ' . $item->ram . ', ' . $item->os . ')') ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $support = [];
                            if ($item->monitor) $support[] = 'Monitor';
                            if ($item->keyboard) $support[] = 'Keyboard';
                            if ($item->mouse) $support[] = 'Mouse';
                            echo esc(implode(', ', $support) ?: '-');
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="no-data">Tidak ada data inventory</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>