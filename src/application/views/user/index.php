<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Akun</h1>
    </div>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <?= $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash_error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-left-danger" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <?= $this->session->flashdata('flash_error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-plus mr-1"></i> Tambah User Baru
                    </h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user'); ?>" method="post">
                        <div class="row">
                            
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-uppercase">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-0"><i class="fas fa-user text-gray-400"></i></span>
                                        </div>
                                        <input type="text" name="username" class="form-control bg-light border-0 small" placeholder="Username User Baru" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-uppercase">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-gray-400"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control bg-light border-0 small" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-uppercase">Role / Level</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-0"><i class="fas fa-user-tag text-gray-400"></i></span>
                                        </div>
                                        <select name="role" class="form-control bg-light border-0 small">
                                            <option value="petugas">Petugas</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="fas fa-save mr-1"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-users-cog mr-1"></i> Daftar Pengguna Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                            <thead class="bg-light text-dark">
                                <tr class="text-center font-weight-bold">
                                    <th width="5%">No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($users_list as $u) : ?>
                                <tr>
                                    <td class="text-center align-middle font-weight-bold"><?= $no++; ?></td>
                                    
                                    <td class="align-middle">
                                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                                        <?= $u['username']; ?>
                                    </td>
                                    
                                    <td class="text-center align-middle">
                                        <?php if($u['role'] == 'admin'): ?>
                                            <span class="badge badge-primary bg-primary text-white px-3 py-2 shadow-sm" style="border-radius: 20px;">
                                                <i class="fas fa-user-shield mr-1"></i> Admin
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary bg-secondary text-white px-3 py-2 shadow-sm" style="border-radius: 20px;">
                                                <i class="fas fa-user-tie mr-1"></i> Petugas
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="text-center align-middle">
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('user/form_edit/' . $u['id']); ?>" class="btn btn-warning btn-sm" title="Edit Password/Role">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <?php if($u['username'] != $this->session->userdata('username')) : ?>
                                                <a href="<?= base_url('user/hapus/') . $u['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?');" title="Hapus User">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" disabled title="Tidak bisa menghapus akun sendiri">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>