<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengaduan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2, .header h3, .header p { margin: 2px 0; }
        hr { border: 1px solid #000; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; text-align: center; }
        .footer { margin-top: 50px; text-align: right; margin-right: 50px; }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>PEMERINTAH KOTA TANJUNGPINANG</h2>
        <h3>DINAS SOSIAL KOTA TANJUNGPINANG</h3>
        <p>Jl. Merdeka No. 45, Telp (0771) 123456</p>
        <hr>
        <h3>LAPORAN PENGADUAN MASYARAKAT</h3>
        <p>Periode: <?= date('d M Y', strtotime($tgl_awal)); ?> s/d <?= date('d M Y', strtotime($tgl_akhir)); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Tanggal</th>
                <th width="15%">NIK</th> <th width="18%">Nama Pelapor</th>
                <th width="10%">Kategori</th>
                <th width="20%">Isi Aduan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1; 
            if(empty($laporan)) : ?>
                <tr>
                    <td colspan="8" style="text-align:center;">Tidak ada data pada periode ini.</td>
                </tr>
            <?php else : 
                foreach ($laporan as $row) : ?>
                <tr>
                    <td style="text-align:center;"><?= $no++; ?></td>
                    <td style="text-align:center;"><?= date('d/m/Y', strtotime($row['tgl_pengaduan'])); ?></td>
                    
                    <td style="text-align:center;"><?= $row['nik']; ?></td>
                    
                    <td><?= strtoupper($row['nama_pelapor']); ?></td>

                    <td style="text-align:center;"><?= $row['kategori']; ?></td>
                    
                    <td><?= $row['isi_laporan']; ?></td>
                    
                    <td style="text-align:center;">
                        <?= ($row['status'] == '0') ? 'Pending' : $row['status']; ?>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Tanjungpinang, <?= date('d F Y'); ?></p>
        <p>Mengetahui,</p>
        <p>Kepala Dinas Sosial</p>
        <br><br><br>
        <p><strong>Dra. ENDANG SUSILAWATI</strong></p>
        <p>NIP. 19800101 200012 1 001</p>
    </div>

</body>
</html>