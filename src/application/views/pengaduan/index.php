<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pengaduan Masuk</h1>

        <a href="<?= base_url('pengaduan/tambah'); ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm mr-1"></i> Tambah Pengaduan
        </a>
    </div>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-1"></i>
            <?= $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list-alt mr-1"></i> Data Pengaduan Masyarakat
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr class="text-center font-weight-bold">
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th width="20%">Identitas Pelapor</th>
                            <th width="15%">Kategori</th>
                            <th width="10%">No. Telp / WA</th>
                            <th>Isi Laporan</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($pengaduan as $p) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $no++; ?></td>

                            <td class="text-center align-middle small">
                                <?= date('d M Y', strtotime($p['tgl_pengaduan'])); ?>
                            </td>

                            <td class="align-middle">
                                <div class="font-weight-bold text-primary">
                                    <?= strtoupper($p['nama_pelapor']); ?>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-id-card mr-1"></i> <?= $p['nik']; ?>
                                </small>
                            </td>

                            <td class="text-center align-middle">
                                <?php
                                    $bgClass = 'bg-secondary';
                                    $icon = 'fa-tag';
                                    if ($p['kategori'] == 'DTSEN') { $bgClass = 'bg-info'; $icon = 'fa-database'; }
                                    elseif ($p['kategori'] == 'PBI-JK') { $bgClass = 'bg-success'; $icon = 'fa-heartbeat'; }
                                    elseif ($p['kategori'] == 'JAMKESDA') { $bgClass = 'bg-primary'; $icon = 'fa-medkit'; }
                                ?>
                                <span class="badge <?= $bgClass; ?> text-white px-3 py-2 shadow-sm" style="border-radius: 20px; font-size: 0.85rem;">
                                    <i class="fas <?= $icon; ?> mr-1"></i> <?= $p['kategori']; ?>
                                </span>
                            </td>

                            <td class="text-center align-middle">
                                <?php 
                                    // Ambil No HP (Pastikan controller sudah join tabel penduduk)
                                    $hp = isset($p['no_telp']) ? $p['no_telp'] : '';
                                    
                                    if(!empty($hp)):
                                        // Format 08xx -> 628xx
                                        $hp_wa = $hp;
                                        if(substr($hp, 0, 1) == '0'){
                                            $hp_wa = '62' . substr($hp, 1);
                                        }

                                        // Siapkan Variabel Nama
                                        $nama_pelapor = strtoupper($p['nama_pelapor']);
                                        $pesan = "";

                                        // 1. Pesan untuk PBI-JK
                                        if($p['kategori'] == 'PBI-JK') {
                                            $pesan = "Halo Sahabat Sosial.\n\n"
                                                . "Proses Re-Aktivasi PBI-JK/APBN an:\n"
                                                . "- *$nama_pelapor*\n\n"
                                                . "telah selesai dilaksanakan dan statusnya sudah diAKTFIKAN kembali.\n"
                                                . "Layanan PBI-JK ini sudah bisa langsung digunakan.\n\n"
                                                . "terimakasih.\n\n"
                                                . "-F.O SPPP Dinas Sosial Kota Tanjungpinang";
                                        }
                                        // 2. Pesan untuk DTSEN
                                        elseif($p['kategori'] == 'DTSEN') {
                                            $pesan = "Halo Sahabat Sosial.\n\n"
                                                . "Surat Keterangan DTSEN an:\n"
                                                . "- *$nama_pelapor*\n\n"
                                                . "Sudah bisa diambil, silahkan tunjukan pesan ini saat pengambilan.\n"
                                                . "Terimakasih\n\n"
                                                . "-F.O SPPP Dinas Sosial Kota Tanjungpinang";
                                        }
                                        // 3. Pesan untuk JAMKESDA
                                        elseif($p['kategori'] == 'JAMKESDA') {
                                            $pesan = "Halo Sahabat Sosial.\n\n"
                                                . "Surat Rekomendasi Jamkesda an:\n"
                                                . "- *$nama_pelapor*\n\n"
                                                . "Sudah bisa diambil, silahkan tunjukan pesan ini saat pengambilan.\n"
                                                . "Terimakasih\n\n"
                                                . "-F.O SPPP Dinas Sosial Kota Tanjungpinang";
                                        }
                                        // 4. Default
                                        else {
                                            $pesan = "Halo Sahabat Sosial.\n\nLaporan atas nama *$nama_pelapor* sedang kami proses.\nTerimakasih.";
                                        }
                                        
                                        // Buat Link WA
                                        $link_wa = "https://wa.me/" . $hp_wa . "?text=" . urlencode($pesan);
                                ?>
                                    <a href="<?= $link_wa ?>" target="_blank" class="btn btn-success btn-sm btn-circle shadow-sm" title="Hubungi WA">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <div class="small mt-1 text-muted"><?= $hp ?></div>
                                <?php else: ?>
                                    <span class="small text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <td class="align-middle small">
                                <?= strlen($p['isi_laporan']) > 60 ? substr($p['isi_laporan'], 0, 60) . '...' : $p['isi_laporan']; ?>
                            </td>

                            <td class="text-center align-middle">
                                <?php $status = $p['status']; ?>
                                <?php if ($status == '0' || $status == 'Pending') : ?>
                                    <span class="badge badge-secondary bg-secondary text-white px-3 py-2 shadow-sm" style="border-radius: 20px;">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                <?php elseif ($status == 'Proses') : ?>
                                    <span class="badge badge-warning bg-warning text-dark px-3 py-2 shadow-sm" style="border-radius: 20px;">
                                        <i class="fas fa-sync-alt fa-spin mr-1"></i> Proses
                                    </span>
                                <?php elseif ($status == 'Selesai') : ?>
                                    <span class="badge badge-success bg-success text-white px-3 py-2 shadow-sm" style="border-radius: 20px;">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                    </span>
                                <?php else : ?>
                                    <span class="badge badge-light border"><?= $status; ?></span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center align-middle">
                                <a href="<?= base_url('pengaduan/detail/') . $p['id']; ?>" class="btn btn-primary btn-sm btn-circle shadow-sm mr-1" title="Lihat Detail">
                                    <i class="fas fa-search"></i>
                                </a>

                                <a href="<?= base_url('pengaduan/cetak_surat/') . $p['id']; ?>" target="_blank" class="btn btn-warning btn-sm btn-circle shadow-sm" title="Cetak Surat">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>