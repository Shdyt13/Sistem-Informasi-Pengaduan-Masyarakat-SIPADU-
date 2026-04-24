<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPADU SOSIAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .login-card { max-width: 400px; margin: 100px auto; border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-header { background: #0d6efd; color: white; text-align: center; border-radius: 10px 10px 0 0 !important; padding: 20px; }
        .btn-primary { width: 100%; }
    </style>
</head>
<body>

    <div class="container">
        <div class="card login-card">
            <div class="card-header">
                <img src="<?= base_url('assets/img/dinsos.png') ?>" alt="Logo" width="50" class="mb-2">
                <h4>SIPADU SOSIAL</h4>
                <small>Dinas Sosial Kota Tanjungpinang</small>
            </div>
            <div class="card-body p-4">
                
                <?= $this->session->flashdata('message'); ?>
                
                <form action="<?= base_url('auth') ?>" method="post">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Masukkan Username" value="<?= set_value('username'); ?>" autofocus>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg mt-3">MASUK</button>    
                </form>
            <!-- 532E48647974 -->
            </div>
            <div class="card-footer text-center py-3 text-muted">
                &copy; 2026 DINSOS Tanjungpinang
            </div>
        </div>
    </div>

</body>
</html>