<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Bukti Laporan</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 12pt; margin: 40px; }
        .header { text-align: center; border-bottom: 3px double black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h3, .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table td { padding: 5px; vertical-align: top; }
        .ttd { margin-top: 50px; text-align: right; margin-right: 50px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h3>PEMERINTAH KOTA TANJUNGPINANG</h3>
        <h2>DINAS SOSIAL</h2>
        <p>Jl. D.I. Panjaitan No. KM. 10, Kota Tanjungpinang</p>
    </div>

    <center>
        <h3><u>BUKTI TANDA TERIMA LAPORAN</u></h3>
        <p>Nomor: <?= date('Ymd') ?>/PENG/<?= $p['id'] ?></p>
    </center>

    <p>Telah terima laporan dari masyarakat dengan rincian:</p>
    
    <table>
        <tr><td width="25%"><strong>Tanggal</strong></td><td>: <?= date('d F Y', strtotime($p['tgl_pengaduan'])) ?></td></tr>
        <tr><td><strong>NIK</strong></td><td>: <?= $p['nik'] ?></td></tr>
        <tr><td><strong>Nama</strong></td><td>: <?= strtoupper($p['nama_pelapor'] ? $p['nama_pelapor'] : $p['nama_penduduk']) ?></td></tr>
        <tr><td><strong>No. HP</strong></td><td>: <?= $p['no_telp'] ?></td></tr>
        <tr><td><strong>Kategori</strong></td><td>: <?= $p['kategori'] ?> <?= !empty($p['sub_kategori']) ? '('.$p['sub_kategori'].')' : '' ?></td></tr>
        <tr><td><strong>Isi Laporan</strong></td><td>: <?= nl2br($p['isi_laporan']) ?></td></tr>
        <tr><td><strong>Status</strong></td><td>: <strong><?= strtoupper($p['status']) ?></strong></td></tr>
    </table>

    <?php if(!empty($anggota)): ?>
    <br><p><strong>Anggota Keluarga Terkait:</strong></p>
    <table border="1">
        <thead>
            <tr style="background-color: #eee;"><th>No</th><th>Nama</th><th>NIK</th></tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($anggota as $agt): ?>
            <tr><td align="center"><?= $no++ ?></td><td><?= $agt['nama'] ?></td><td><?= $agt['nik'] ?></td></tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <div class="ttd">
        <p>Tanjungpinang, <?= date('d F Y') ?></p>
        <p>Petugas Penerima,</p>
        <br><br><br>
        <p><strong>( Admin Dinas Sosial )</strong></p>
    </div>
<!-- 532E48647974 -->
</body>
</html>