<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Data User</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit User</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('user/edit'); ?>" method="post">
                <input type="hidden" name="id" value="<?= $user_edit['id']; ?>">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $user_edit['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="petugas" <?= (strtolower($user_edit['role']) == 'petugas') ? 'selected' : ''; ?>>Petugas</option>
                        <option value="admin" <?= (strtolower($user_edit['role']) == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Password Baru <small class="text-danger">(Kosongkan jika tidak ingin mengganti password)</small></label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru...">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>