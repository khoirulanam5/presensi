<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Presensi Pegawai</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        body {
            margin: 30px;
            margin-top: 70px;
            margin-left: 50px;
            margin-right: 50px;
            font-family: Arial, sans-serif;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-logo {
            height: 100px;
        }
        .header-text {
            text-align: center;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .signature {
            text-align: left;
            margin-top: 50px;
            margin-left: auto; /* Secara default, biarkan di tengah */
            width: fit-content;
        }

        @media print and (orientation: portrait) {
            .signature {
                margin-left: 470px; /* Margin khusus untuk mode potret */
            }
        }

        @media print and (orientation: landscape) {
            .signature {
                margin-left: 700px; /* Margin khusus untuk mode lanskap */
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-container">
        <div>
            <img src="<?= base_url('assets/logo.png') ?>" alt="Logo" class="header-logo">
        </div>
        <div class="header-text">
            <h4><b>PEMERINTAH KABUPATEN KUDUS</b></h4>
            <h4><b>INSPEKTORAT DAERAH KABUPATEN KUDUS</b></h4>
            <p>Alamat: Komplek Perkantoran Kudus, Jl. Mejobo No.35, Kudus, Jawa Tengah<br>
               Telepon: (0291) 437127
            </p>
        </div>
    </div>
    <hr style="border: 2px solid black;">
    
    <!-- Content Section -->
    <h3 style="text-align: left;">Data Absensi pegawai</h3>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Foto Masuk</th>
                <th>Tanggal dan Jam Masuk</th>
                <th>Lokasi Masuk</th>
                <th>Foto Keluar</th>
                <th>Tanggal dan Jam Keluar</th>
                <th>Lokasi Keluar</th>
                <th>Jumlah Jam Kerja</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($absensi as $item): 
                // Konversi jam masuk dan jam keluar menjadi detik
                $jamMasuk = strtotime($item->jam_masuk);
                $jamKeluar = strtotime($item->jam_keluar);

                // Periksa apakah kedua jam valid untuk perhitungan
                if ($jamMasuk && $jamKeluar && $jamKeluar > $jamMasuk) {
                    // Hitung selisih dalam detik, lalu konversi ke jam
                    $durasiJam = round(($jamKeluar - $jamMasuk) / 3600, 1); // Dibulatkan ke 1 desimal
                } else {
                    $durasiJam = 0; // Jika data tidak valid
                }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $item->nm_pengguna; ?></td>
                    <td>
                        <?php if (!empty($item->selfie)) : ?>
                            <img src="<?= base_url('assets/img/absensi/' . $item->selfie) ?>" alt="Foto Masuk" style="width: 100px; height: auto;">
                        <?php else : ?>
                            <span>Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $item->jam_masuk; ?></td>
                    <td><?= $item->lokasi_masuk; ?></td>
                    <td>
                        <?php if (!empty($item->selfie_keluar)) : ?>
                            <img src="<?= base_url('assets/img/absensi/' . $item->selfie_keluar) ?>" alt="Foto Keluar" style="width: 100px; height: auto;">
                        <?php else : ?>
                            <span>Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $item->jam_keluar; ?></td>
                    <td><?= $item->lokasi_keluar; ?></td>
                    <td><?= $durasiJam; ?> jam</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Signature Section -->
    <div class="signature">
        <?php foreach($absensi as $item): ?>
        <p style="text-align: left;">Kudus, <?= date('d F Y'); ?></p>
        <p style="text-align: left;"><b>KEPALA INSPEKTORAT</b></p>
        <br><br><br>
        <div style="text-align: left; display: inline-block;">
            <p><b><u>Prof Mega</u></b></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>
