<!DOCTYPE html>
<html>
<head>
    <title>Formulir Reaktivasi PBI-JK</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12pt; }
        .header { text-align: center; font-weight: bold; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; font-size: 11pt; }
        .no-border { border: none !important; }
    </style>
</head>
<body onload="window.print()">

    <?php
    // 1. SETUP TANGGAL & DATA
    $bulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', 
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', 
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    $tgl_db = date('d', strtotime($row['tgl_pengaduan']));
    $bln_db = $bulan[date('m', strtotime($row['tgl_pengaduan']))];
    $thn_db = date('Y', strtotime($row['tgl_pengaduan']));
    $tanggal_lengkap = $tgl_db . ' ' . $bln_db . ' ' . $thn_db;

    // 2. PREPARE CHECKLIST
    $syarat_array = explode(',', $row['syarat_terlampir']); 
    $syarat_bersih = array_map('trim', $syarat_array);

    function cek_box($teks_dicari, $array_data) {
        return in_array($teks_dicari, $array_data) ? '<b>X</b>' : '&nbsp;&nbsp;';
    }
    ?>

    <div class="header">
        FORMULIR PERMOHONAN REAKTIVASI<br>
        Penerima Bantuan Iuran Jaminan Kesehatan (PBI JK) APBN
    </div>

    <p>Saya yang bertandatangan dibawah ini :</p>
    <table style="border:none;">
        <tr><td class="no-border" width="100">Nama</td><td class="no-border">: <?= $row['nama_pelapor'] ?></td></tr>
        
        <tr><td class="no-border">NO.HP</td><td class="no-border">: <?= isset($row['hp_pelapor']) ? $row['hp_pelapor'] : '-' ?></td></tr>
        <tr><td class="no-border">Alamat</td><td class="no-border">: <?= isset($row['alamat_pelapor']) ? $row['alamat_pelapor'] : '-' ?></td></tr>
    </table>

    <p>Dengan ini mengajukan permohonan untuk reaktivasi PBI JK APBN</p>

    <table>
        <thead>
            <tr style="background-color: #f0f0f0;">
                <th>NO</th><th>NAMA</th><th>TEMPAT/TGL LAHIR</th><th>AGAMA</th><th>PEKERJAAN</th><th>ALAMAT</th><th>KET</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">1</td>
                <td><?= $row['nama_pelapor'] ?></td>
                <td>
                    <?php 
                        echo isset($row['tempat_lahir']) ? $row['tempat_lahir'] . ', ' : ''; 
                        echo isset($row['tgl_lahir']) ? date('d-m-Y', strtotime($row['tgl_lahir'])) : '-';
                    ?>
                </td>
                <td><?= isset($row['agama']) ? $row['agama'] : '-' ?></td>
                <td><?= isset($row['kerja_pelapor']) ? $row['kerja_pelapor'] : '-' ?></td>
                <td><?= isset($row['alamat_pelapor']) ? $row['alamat_pelapor'] : '-' ?></td>
                <td>KEPALA KELUARGA</td>
            </tr>
            <?php $no=2; foreach($anggota as $a): ?>
            <tr>
                <td align="center"><?= $no++ ?></td>
                <td><?= $a['nama'] ?></td>
                <td><?= $a['tempat_lahir'] ? $a['tempat_lahir'].', '.date('d-m-Y', strtotime($a['tgl_lahir'])) : '-' ?></td>
                <td><?= $a['agama'] ?></td>
                <td><?= $a['pekerjaan'] ?></td>
                <td><?= $a['alamat'] ?></td>
                <td><?= $a['status_hubungan'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <p>Adapun persyaratan yang telah dilengkapi sebagai berikut :</p>
    
    <ul style="list-style-type: none; padding-left: 0;">
        <li>[<?= cek_box('Surat Keterangan DTSEN', $syarat_bersih) ?>] Surat Keterangan DTSEN</li>
        
        <li>[<?= cek_box('Surat Kontrol / Rujukan Faskes tingkat pertama', $syarat_bersih) ?>] Surat Kontrol / Rujukan Faskes tingkat pertama</li>
        
        <li>[<?= cek_box('Foto Copy Kartu KIS jika ada', $syarat_bersih) ?>] Foto Copy Kartu KIS jika ada</li>
        
        <li>[<?= cek_box('Foto Copy KK dan KTP sebanyak 1 lembar', $syarat_bersih) ?>] Foto Copy KK dan KTP sebanyak 1 lembar</li>
        
        <li>[<?= cek_box('Foto Copy Surat Keterangan di rawat', $syarat_bersih) ?>] Foto Copy Surat Keterangan di rawat (Resume Medis)</li>
    </ul>

    <p>Berdasarkan :</p>
    <ol>
        <li>INPRES RI No 4 Tahun 2025 tentang DTSEN tanggal 5 Februari 2025</li>
        <li>KEPMENSOS RI No 79/HUK/2025 tanggal 26 Mei 2025</li>
        <li>Surat Menteri Sosial RI No S-445/MS/D.I.01/6/2025 tanggal 3 Juni 2025</li>
        <li>PERMENSOS RI No 3 Tahun 2025 tanggal 10 Juni 2025</li>
    </ol>

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