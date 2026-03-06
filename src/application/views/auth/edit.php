<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $user_edit['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?= $user_edit['nama']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $user_edit['username']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengganti password">
                            <small class="text-muted">Isi hanya jika ingin mereset password user ini.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hak Akses (Role)</label>
                            <select name="role" class="form-select">
                                <option value="admin" <?= ($user_edit['role'] == 'admin') ? 'selected' : ''; ?>>Administrator</option>
                                <option value="user" <?= ($user_edit['role'] == 'user') ? 'selected' : ''; ?>>Staf / User</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="<?= base_url('auth/manage_users'); ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>