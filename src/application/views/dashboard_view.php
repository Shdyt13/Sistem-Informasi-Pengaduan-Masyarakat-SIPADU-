<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Total Pengaduan</h5>
                <p class="card-text display-4 fw-bold"><?= $total_aduan; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Selesai Diproses</h5>
                <p class="card-text display-4 fw-bold"><?= $total_selesai; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Pending</h5>
                <p class="card-text display-4 fw-bold"><?= $total_pending; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- 532E48647974 -->
<div class="alert alert-info">
    Selamat Datang, <strong><?= $this->session->userdata('username'); ?></strong>! Anda login sebagai role: <strong><?= $this->session->userdata('role'); ?></strong>
</div>