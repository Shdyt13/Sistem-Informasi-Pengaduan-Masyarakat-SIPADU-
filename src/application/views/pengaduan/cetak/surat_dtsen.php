<!DOCTYPE html>
<html>
<head>
    <title>Permohonan DTSEN</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 12pt; }
        .header { text-align: center; font-weight: bold; border-bottom: 3px solid black; padding-bottom: 5px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; }
        .no-border { border: none !important; }
    </style>
</head>
<body onload="window.print()">

    <?php
    // Format Tanggal Indonesia
    $bulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', 
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', 
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    $tgl_surat = date('d', strtotime($row['tgl_pengaduan'])) . ' ' . $bulan[date('m', strtotime($row['tgl_pengaduan']))] . ' ' . date('Y', strtotime($row['tgl_pengaduan']));
    ?>

    <div class="header">
        FORMULIR PERMOHONAN<br>
        Keterangan Terdaftar Data Tunggal Sosial Ekonomi Nasional (DTSEN)
    </div>

    <p>Saya yang bertanda tangan dibawah ini:</p>
    <table style="border:none;">
        <tr><td class="no-border" width="100">Nama</td><td class="no-border">: <?= $row['nama_pelapor'] ?></td></tr>
        <tr><td class="no-border">NIK</td><td class="no-border">: <?= $row['nik'] ?></td></tr>
        
        <tr><td class="no-border">Alamat</td><td class="no-border">: <?= isset($row['alamat_pelapor']) ? $row['alamat_pelapor'] : '-' ?></td></tr>
        <tr><td class="no-border">No.HP</td><td class="no-border">: <?= isset($row['hp_pelapor']) ? $row['hp_pelapor'] : '-' ?></td></tr>
    </table>

    <p style="text-align: justify;">
        Dengan ini mengajukan permohonan cetak Surat Keterangan Terdaftar Data Tunggal Sosial Ekonomi Nasional (DTSEN), 
        sesuai berkas salinan Kartu Keluarga yang saya sertakan atas nama sebagai berikut:
    </p>

    <table>
        <thead>
            <tr>
                <th>NO</th><th>NAMA</th><th>NIK</th><th>KEPERLUAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">1</td>
                <td><?= $row['nama_pelapor'] ?></td>
                <td><?= $row['nik'] ?></td>
                <td>Pengajuan DTSEN</td>
            </tr>
            <?php $no=2; foreach($anggota as $a): ?>
            <tr>
                <td align="center"><?= $no++ ?></td>
                <td><?= $a['nama'] ?></td>
                <td><?= $a['nik'] ?></td>
                <td>Anggota Keluarga</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p style="margin-top: 20px; text-align: justify;">
        Demikian surat permohonan ini saya ajukan. Saya bersedia menjaga dan bertanggung jawab terhadap keamanan data 
        dan menghindari penggunaan data oleh pihak yang tidak berkepentingan.
    </p>

    <br>
    <div style="float: right; text-align: center;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">
                <p>
                    Tanjungpinang, <?= date('d-m-Y', strtotime($row['tgl_pengaduan'])) ?><br>
                    Pemohon,
                </p>
                
                <div style="margin: 10px 0;">
                    <img src="<?= $qrcode_url; ?>" alt="QR Code NIK" style="width: 80px; height: 80px;">
                    
                    <br>
                    <small style="font-size: 10px; color: #555;"><?= $row['nik'] ?></small>
                </div>

                <p style="text-decoration: underline; font-weight: bold;">
                    <?= strtoupper($row['nama_pelapor']) ?>
                </p>
            </td>
        </tr>
    </div>

</body>
</html>