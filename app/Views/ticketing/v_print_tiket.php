<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tiket IT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-info {
            text-align: center;
            margin-bottom: 20px;
            font-style: italic;
            color: #666;
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

        .status-solved {
            color: green;
            font-weight: bold;
        }

        .status-ongoing {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Data Tiket IT</h1>
    <div class="filter-info">
        Filter:
        <?php
        // Date filter description
        $dateFilterText = '';
        switch ($filter) {
            case 'today':
                $dateFilterText = 'Hari Ini';
                break;
            case 'week':
                $dateFilterText = 'Minggu Ini';
                break;
            case 'month':
                $dateFilterText = 'Bulan Ini';
                break;
            case 'custom':
                if (isset($startDate) && isset($endDate)) {
                    $dateFilterText = 'Tanggal ' . date('d/m/Y', strtotime($startDate)) . ' - ' . date('d/m/Y', strtotime($endDate));
                } else {
                    $dateFilterText = 'Hari Ini';
                }
                break;
            case 'all':
                $dateFilterText = 'Semua Data';
                break;
            default:
                $dateFilterText = 'Hari Ini';
        }

        // Jenis filter description
        $jenisFilterText = '';
        if (isset($jenisFilter) && $jenisFilter !== 'all') {
            $jenisLabels = [
                'Software Trouble' => 'Software Trouble',
                'Hardware Trouble' => 'Hardware Trouble',
                'Phone Trouble' => 'Phone Trouble',
                'Password Trouble' => 'Password Trouble'
            ];
            $jenisFilterText = isset($jenisLabels[$jenisFilter]) ? $jenisLabels[$jenisFilter] : $jenisFilter;
        }

        // Combine filters
        echo $dateFilterText;
        if ($jenisFilterText) {
            echo ' | Jenis: ' . $jenisFilterText;
        }
        ?>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Jenis Tiket</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tiket)): ?>
                <?php foreach ($tiket as $item): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($item['create_date'])) ?></td>
                        <td><?= esc($item['nama_karyawan']) ?></td>
                        <td><?= esc($item['departemen_karyawan']) ?></td>
                        <td><?= esc($item['jenis_tiket']) ?></td>
                        <td><?= esc($item['desk_tiket']) ?></td>
                        <td class="status-<?= $item['status'] ?>">
                            <?= $item['status'] == 'solved' ? 'Solved' : 'Ongoing' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">Tidak ada data tiket</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>