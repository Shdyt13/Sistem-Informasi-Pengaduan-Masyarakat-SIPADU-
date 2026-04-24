<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Rekomendasi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11pt; }
        .kop { text-align: right; margin-bottom: 20px; }
        .box-opsi { float: right; border: 1px solid black; padding: 5px; width: 200px; font-size: 10pt;}
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; }
        .no-border { border: none !important; }
        /* Style untuk Checkbox yang dicentang */
        .checked { font-family: DejaVu Sans, sans-serif; font-weight: bold; }
    </style>
</head>
<body onload="window.print()">

    <?php
    // 1. FORMAT TANGGAL INDONESIA
    $bulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', 
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', 
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    $tgl_db = date('d', strtotime($row['tgl_pengaduan']));
    $bln_db = $bulan[date('m', strtotime($row['tgl_pengaduan']))];
    $thn_db = date('Y', strtotime($row['tgl_pengaduan']));
    $tanggal_lengkap = $tgl_db . ' ' . $bln_db . ' ' . $thn_db;

    // 2. PREPARE DATA CHECKBOX
    // Ambil string syarat dari database dan pecah jadi array
    $syarat_array = explode(',', $row['syarat_terlampir']); 
    
    // Hilangkan spasi berlebih agar pencocokan akurat
    $syarat_bersih = array_map('trim', $syarat_array);

    // Fungsi kecil untuk cek checklist (X atau spasi)
    function cek_box($teks_dicari, $array_data) {
        if (in_array($teks_dicari, $array_data)) {
            return '<b>X</b>'; // Tanda X Tebal
        } else {
            return '&nbsp;&nbsp;'; // Spasi kosong
        }
    }

    // Fungsi cek kategori (Pindah Segmen, dll)
    function cek_kategori($val, $db_val) {
        return ($val == $db_val) ? '<b>X</b>' : '&nbsp;&nbsp;';
    }
    ?>

    <div class="kop">
        Tanjungpinang, <?= $tanggal_lengkap ?><br>
        Kepada Yth.<br>
        Kepala Dinas Sosial Kota Tanjungpinang<br>
        Kepala Bidang Perlindungan dan<br>
        Jaminan Sosial Kota Tanjungpinang<br>
        Di - Tanjungpinang
    </div>

    <div style="position: absolute; top: 120px; right: 0; line-height: 1.5;">
        [<?= cek_kategori('Reaktivasi', $row['sub_kategori']) ?>] Reaktivasi<br>
        [<?= cek_kategori('Peserta Baru', $row['sub_kategori']) ?>] Peserta Baru<br>
        [<?= cek_kategori('Pindah Segmen', $row['sub_kategori']) ?>] Pindah Segmen<br>
        [<?= cek_kategori('Urgent', $row['sub_kategori']) ?>] Urgent
    </div>

    <p>Saya yang bertandatangan dibawah ini :</p>
    <table style="border:none; width: 70%;">
        <tr><td class="no-border" width="100">Nama</td><td class="no-border">: <?= $row['nama_pelapor'] ?></td></tr>
        
        <tr><td class="no-border">NO.HP</td><td class="no-border">: <?= isset($row['hp_pelapor']) ? $row['hp_pelapor'] : '-' ?></td></tr>
        <tr><td class="no-border">Alamat</td><td class="no-border">: <?= isset($row['alamat_pelapor']) ? $row['alamat_pelapor'] : '-' ?></td></tr>
    </table>

    <p>Dengan ini mengajukan permohonan untuk pembuatan <b><?= $row['kategori'] ?></b></p>

    <table>
        <thead>
            <tr>
                <th>NO</th><th>NAMA</th><th>TEMPAT/ TANGGAL LAHIR</th><th>AGAMA</th><th>PEKERJAAN</th><th>ALAMAT</th><th>KET</th>
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
                <td><?= $row['isi_laporan'] ?></td>
            </tr>
            <?php $no=2; foreach($anggota as $a): ?>
            <tr>
                <td align="center"><?= $no++ ?></td>
                <td><?= $a['nama'] ?></td>
                <td><?= $a['tempat_lahir'] ? $a['tempat_lahir'].', '.date('d-m-Y', strtotime($a['tgl_lahir'])) : '' ?></td>
                <td><?= $a['agama'] ?></td>
                <td><?= $a['pekerjaan'] ?></td>
                <td><?= $a['alamat'] ?></td>
                <td><?= $row['isi_laporan'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <p>Adapun persyaratan yang telah dilengkapi sebagai berikut :</p>
    
    <ul style="list-style-type: none; padding-left: 0;">
        <li>[<?= cek_box('Surat Keterangan DTSEN', $syarat_bersih) ?>] DTSEN</li>
        
        <li>[<?= cek_box('NON DTSEN', $syarat_bersih) ?>] NON DTSEN</li>
        
        <li>[<?= cek_box('Foto Copy KK dan KTP sebanyak 1 lembar', $syarat_bersih) ?>] Foto Copy KK dan KTP sebanyak 1 lembar</li>
        
        <li>[<?= cek_box('Foto Copy Surat Keterangan di rawat dari Rumah Sakit', $syarat_bersih) ?>] Foto Copy Surat Keterangan di rawat dari Rumah Sakit / Rujukan sebanyak 1 lembar (jika ada)</li>
        
        <li>[<?= cek_box('Foto Copy Surat Keterangan Tidak Mampu (SKTM)', $syarat_bersih) ?>] Foto Copy Surat Keterangan Tidak Mampu dari Kelurahan kemudian diketahui Kecamatan sebanyak 1 lembar.</li>
    </ul>

    <p>Demikian Permohonan ini saya buat dengan sebenar-benarnya.</p>
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