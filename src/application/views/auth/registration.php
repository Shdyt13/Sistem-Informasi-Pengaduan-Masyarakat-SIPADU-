<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen User (Tambah Akun)</h1>

    <div class="row">
        <div class="col-lg-6">
            
            <?php if ($this->session->flashdata('flash')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('flash'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Registrasi Pegawai</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('auth/registration'); ?>" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?= set_value('nama'); ?>" placeholder="Misal: Budi Santoso">
                            <small class="text-danger"><?= form_error('nama'); ?></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Username untuk login">
                            <small class="text-danger"><?= form_error('username'); ?></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password akun">
                            <small class="text-danger"><?= form_error('password'); ?></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hak Akses (Role)</label>
                            <select name="role" class="form-select">
                                <option value="">-- Pilih Akses --</option>
                                <option value="admin">Administrator (Full Akses)</option>
                                <option value="user">Staf / Petugas (Terbatas)</option>
                            </select>
                            <small class="text-danger"><?= form_error('role'); ?></small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Tambah User
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>