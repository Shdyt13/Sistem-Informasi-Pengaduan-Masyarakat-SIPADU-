<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-print mr-1"></i> Filter Laporan
                    </h6>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- <img src="<?= base_url('assets/img/undraw_posting_photo.svg'); ?>" style="height: 100px; display: none;" alt="Ilustrasi" class="img-fluid mb-2 d-md-inline-block"> -->
                        <p class="small text-muted">Silakan pilih rentang tanggal data yang ingin dicetak.</p>
                    </div>

                    <form action="<?= base_url('laporan'); ?>" method="post" target="_blank">

                        <div class="form-group">
                            <label class="small text-secondary font-weight-bold text-uppercase">Dari Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-calendar-day text-gray-400"></i>
                                    </span>
                                </div>
                                <input type="date" name="tgl_awal" class="form-control bg-light border-0 small" required>
                            </div>
                            <?= form_error('tgl_awal', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label class="small text-secondary font-weight-bold text-uppercase">Sampai Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-calendar-check text-gray-400"></i>
                                    </span>
                                </div>
                                <input type="date" name="tgl_akhir" class="form-control bg-light border-0 small" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                            <?= form_error('tgl_akhir', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-primary btn-block shadow-sm">
                            <i class="fas fa-print fa-sm text-white-50 mr-2"></i> Cetak Laporan
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>