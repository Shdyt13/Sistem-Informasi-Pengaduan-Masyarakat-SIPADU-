<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            Form Ubah Data Penduduk
        </div>
        <div class="card-body">
            
            <?php if(validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $penduduk['id']; ?>">

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $penduduk['nik']; ?>">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $penduduk['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $penduduk['alamat']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $penduduk['no_telp']; ?>">
                </div>
                <div class="mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $penduduk['pekerjaan']; ?>">
                </div>
                
                <button type="submit" name="ubah" class="btn btn-primary float-end">Ubah Data</button>
                <a href="<?= base_url('penduduk') ?>" class="btn btn-secondary float-end me-2">Kembali</a>
            </form>
        </div>
    </div>
</div> 
<!-- 532E48647974 -->