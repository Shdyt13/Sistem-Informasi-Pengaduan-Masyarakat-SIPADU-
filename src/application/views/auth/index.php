<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen User</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna Sistem</h6>
            <a href="<?= base_url('auth/registration'); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah User Baru
            </a>
        </div>
        <div class="card-body">
            
            <?php if ($this->session->flashdata('flash')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data User berhasil <strong><?= $this->session->flashdata('flash'); ?></strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($users as $u) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['username']; ?></td>
                            <td>
                                <?php if($u['role'] == 'admin'): ?>
                                    <span class="badge bg-danger">Administrator</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Staf / User</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('auth/edit_user/') . $u['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <?php if($u['username'] != $this->session->userdata('username')) : ?>
                                    <a href="<?= base_url('auth/hapus_user/') . $u['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?');">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Akun Anda</button>
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