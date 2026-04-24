<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            
            <?php if ($this->session->flashdata('flash')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Akun Saya</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/profile'); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" value="<?= $user['role']; ?>" readonly disabled>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $user['username']; ?>" required>
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Password Baru <small class="text-muted">(Kosongkan jika tidak ingin mengganti)</small></label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password baru...">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>