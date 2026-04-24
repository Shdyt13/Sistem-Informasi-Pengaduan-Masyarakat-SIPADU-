<!--532E48647974 -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Verifikasi Penghapusan Data</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4 border-bottom-danger">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Masukkan Kode OTP</h6>
                </div>
                <div class="card-body">
                    
                    <?php if ($this->session->flashdata('info')) : ?>
                        <div class="alert alert-info">
                            <?= $this->session->flashdata('info'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('penduduk/verifikasi_hapus'); ?>" method="post">
                        
                        <input type="hidden" name="target_data" value="<?= $id_penduduk; ?>">
                        
                        <div class="form-group">
                            <label>Kode OTP (6 Digit)</label>
                            <input type="text" name="otp" class="form-control form-control-user" required maxlength="6" pattern="\d{6}" placeholder="Contoh: 123456" autofocus autocomplete="off">
                            <small class="text-muted">Cek WhatsApp Kepala Dinas untuk mendapatkan kode.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-danger">Verifikasi & Hapus</button>
                        <a href="<?= base_url('penduduk'); ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>