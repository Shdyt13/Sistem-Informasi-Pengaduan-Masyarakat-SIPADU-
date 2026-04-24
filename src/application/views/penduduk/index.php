<!-- 532E48647974 -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
        <a href="<?= base_url('penduduk/tambah'); ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Data
        </a>
    </div>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            Data Penduduk <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4 border-bottom-primary">
        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-users mr-1"></i> Daftar Warga Terdaftar
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr class="text-center font-weight-bold">
                            <th width="5%">No</th>
                            <th width="15%">NIK</th>
                            <th width="20%">Nama Lengkap</th>
                            
                            <th width="15%">TTL</th>
                            <th width="10%">Agama</th>
                            <th>Alamat</th>
                            <th width="12%">No. Tlp</th>
                            <th width="10%">Pekerjaan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($penduduk as $p) : ?>
                        <tr>
                            <td class="text-center align-middle font-weight-bold"><?= $no++; ?></td>
                            
                            <td class="text-center align-middle">
                                <span class="badge badge-light text-dark border px-2 py-1">
                                    <i class="far fa-id-card mr-1 text-primary"></i> <?= $p['nik']; ?>
                                </span>
                            </td>
                            
                            <td class="align-middle font-weight-bold text-primary">
                                <?= $p['nama']; ?>
                            </td>
                            
                            <td class="align-middle">
                                <?php 
                                    // Format Tanggal Lahir
                                    $tgl = !empty($p['tgl_lahir']) ? date('d-m-Y', strtotime($p['tgl_lahir'])) : '-';
                                    
                                    // Gabungkan Tempat dan Tanggal
                                    echo ($p['tempat_lahir'] ?? '-') . ', <br><small class="text-muted">' . $tgl . '</small>'; 
                                ?>
                            </td>
                            
                            <td class="align-middle text-center">
                                <?= $p['agama'] ?? '-'; ?>
                            </td>
                            <td class="align-middle small">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i> <?= $p['alamat']; ?>
                            </td>
                            
                            <td class="text-center align-middle small">
                                <?php if(!empty($p['no_telp'])) : ?>
                                    <i class="fas fa-phone fa-xs text-success mr-1"></i> <?= $p['no_telp']; ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                            
                            <td class="align-middle text-center small">
                                <span class="badge badge-info bg-info text-white p-2" style="border-radius: 10px;">
                                    <?= $p['pekerjaan']; ?>
                                </span>
                            </td>

                            <td class="text-center align-middle">
                                <?php if ($this->session->userdata('role') == 'admin') : ?>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('penduduk/ubah/') . $p['id']; ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="<?= base_url('penduduk/request_hapus/' . $p['id']); ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini? OTP akan dikirim ke Kepala Dinas.');">Hapus</a>
                                    </div>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Locked</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>