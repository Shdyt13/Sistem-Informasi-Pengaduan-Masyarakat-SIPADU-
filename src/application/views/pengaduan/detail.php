<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan</h1>
        <a href="<?= base_url('pengaduan'); ?>" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
        </a>
    </div>

    <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <strong><i class="fas fa-check-circle mr-2"></i>Berhasil!</strong> <?= $this->session->flashdata('flash'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash_error')) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong><i class="fas fa-exclamation-triangle mr-2"></i>Gagal!</strong> <?= $this->session->flashdata('flash_error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 border-bottom-primary">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-file-alt me-2"></i>Data Laporan Masyarakat
                    </h6>
                </div>
                <div class="card-body">
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="text-xs font-weight-bold text-uppercase text-secondary mb-1">NIK Pelapor</label>
                            <div class="h5 mb-0 font-weight-bold text-gray-900 d-flex align-items-center">
                                <i class="fas fa-id-card text-gray-400 me-2" style="font-size: 1.2rem;"></i>
                                <?= !empty($p['nik']) ? $p['nik'] : '-' ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-xs font-weight-bold text-uppercase text-secondary mb-1">Nama Pelapor</label>
                            <div class="h5 mb-0 font-weight-bold text-gray-900 d-flex align-items-center">
                                <i class="fas fa-user text-gray-400 me-2" style="font-size: 1.2rem;"></i>
                                <?= !empty($p['nama_pelapor']) ? $p['nama_pelapor'] : '-' ?>
                            </div>
                        </div>
                    </div>

                    <hr class="sidebar-divider dashed">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="text-xs font-weight-bold text-uppercase text-secondary mb-1">Tanggal Masuk</label>
                            <div class="h6 mb-0 text-gray-800 d-flex align-items-center">
                                <i class="far fa-calendar-alt text-gray-400 me-2" style="font-size: 1.2rem;"></i>
                                <?= date('d F Y', strtotime($p['tgl_pengaduan'])) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-xs font-weight-bold text-uppercase text-secondary mb-2">Kategori Layanan</label>
                            <div>
                                <span class="d-inline-block px-3 py-2 rounded shadow-sm text-white" style="background-color: #4e73df; font-size: 0.9rem;">
                                    <i class="fas fa-tag mr-2"></i>
                                    <?php 
                                        // Cek jika datanya ada
                                        echo !empty($p['kategori']) ? $p['kategori'] : 'Umum';
                                        echo !empty($p['sub_kategori']) ? ' - '.$p['sub_kategori'] : '';
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <label class="text-xs font-weight-bold text-uppercase text-secondary mb-2">
                            <i class="fas fa-align-left me-2"></i>Isi / Kronologi Laporan
                        </label>
                        <div class="p-3 bg-gray-100 rounded text-justify text-gray-900 border-left-primary" style="border-left: 4px solid #4e73df;">
                            <?= !empty($p['isi_laporan']) ? nl2br($p['isi_laporan']) : '-' ?>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="text-xs font-weight-bold text-uppercase text-secondary mb-2">
                            <i class="fas fa-paperclip me-2"></i>Dokumen Persyaratan
                        </label>
                        <?php if(!empty($p['syarat_terlampir'])): ?>
                            <div class="d-flex flex-wrap mt-1">
                                <?php 
                                $syarat = explode(',', $p['syarat_terlampir']);
                                foreach($syarat as $s): 
                                    if(trim($s) == "") continue;
                                ?>
                                    <div class="btn btn-light btn-sm border shadow-sm mr-2 mb-2 text-left" style="cursor: default;">
                                        <i class="fas fa-check-circle text-success mr-1"></i> 
                                        <span class="text-dark font-weight-bold"><?= trim($s) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted font-italic small ml-4">- Tidak ada persyaratan terlampir -</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">
                        <i class="fas fa-users me-2"></i>Daftar Anggota Keluarga Terkait
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th>Nama Anggota</th>
                                    <th>NIK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($anggota)): ?>
                                    <tr><td colspan="3" class="text-center text-muted font-italic py-3">Tidak ada data anggota tambahan</td></tr>
                                <?php else: ?>
                                    <?php $no=1; foreach($anggota as $agt): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="font-weight-bold text-dark"><?= $agt['nama'] ?></td>
                                        <td><?= $agt['nik'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-tasks me-2"></i>Tindak Lanjut</h6>
                </div>
                <div class="card-body">
                    
                    <?php 
                        $width = '10%'; 
                        $bar_color = 'bg-secondary';
                        
                        if($p['status'] == 'Pending') { 
                            $width = '20%'; $bar_color = 'bg-warning';
                        } elseif($p['status'] == 'Proses') { 
                            $width = '60%'; $bar_color = 'bg-info';
                        } elseif($p['status'] == 'Selesai') { 
                            $width = '100%'; $bar_color = 'bg-success';
                        }
                    ?>
                    
                    <div class="text-center mb-3">
                        <span class="font-weight-bold text-uppercase small text-gray-600">Status Saat Ini:</span>
                        <h4 class="font-weight-bold mt-1 text-dark"><?= $p['status'] ?></h4>
                    </div>

                    <div class="progress mb-4 shadow-sm" style="height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bar_color ?>" role="progressbar" style="width: <?= $width ?>" aria-valuenow="<?= intval($width) ?>" aria-valuemin="0" aria-valuemax="100">
                            <span class="small font-weight-bold text-white shadow-sm ml-2"><?= $width ?></span>
                        </div>
                    </div>

                    <hr>

                    <?= form_open('pengaduan/ubah_status'); ?>
                        <input type="hidden" name="id_pengaduan" value="<?= $p['id'] ?>">
                        <div class="form-group">
                            <label class="font-weight-bold small text-gray-700">Update Status Laporan:</label>
                            <div class="input-group">
                                <select name="status" class="form-control bg-light border-0 small shadow-sm">
                                    <option value="Pending" <?= $p['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Proses" <?= $p['status'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Selesai" <?= $p['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm shadow-sm" type="submit">
                                        <i class="fas fa-save mr-1"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-cog me-2"></i>Aksi Data</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">Tindakan ini akan mempengaruhi data secara permanen.</p>
                    
                    <a href="<?= base_url('pengaduan/edit/' . $p['id']) ?>" class="btn btn-warning btn-block btn-icon-split mb-2 shadow-sm align-items-center">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text w-100 text-left">Edit Data Pengaduan</span>
                    </a>

                    <a href="<?= base_url('pengaduan/hapus/' . $p['id']) ?>" class="btn btn-danger btn-block btn-icon-split shadow-sm align-items-center" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen? Data Anggota keluarga terkait juga akan dihapus.');">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text w-100 text-left">Hapus Pengaduan</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- 532E48647974 -->