<div class="col-md-3 col-lg-2 sidebar p-0 pt-3 collapse d-md-block" id="sidebarMenu">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white text-uppercase">
        <span>Menu Utama</span>
    </h6>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>" href="<?= base_url('dashboard') ?>">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= ($this->uri->segment(1) == 'penduduk') ? 'active' : ''; ?>" href="<?= base_url('penduduk') ?>">
                <i class="fas fa-users me-2"></i> Data Penduduk
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= ($this->uri->segment(1) == 'pengaduan') ? 'active' : ''; ?>" href="<?= base_url('pengaduan'); ?>">
                <i class="fas fa-file-alt me-2"></i> Data Pengaduan
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= ($this->uri->segment(1) == 'laporan') ? 'active' : ''; ?>" href="<?= base_url('laporan') ?>">
                <i class="fas fa-print me-2"></i> Laporan
            </a>
        </li>

        <?php if ($this->session->userdata('role') == 'admin') : ?>
            <hr class="sidebar-divider bg-light"> 
            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-white text-uppercase">
                Admin Only
            </h6>

            <li class="nav-item">
                <a class="nav-link text-white <?= ($this->uri->segment(1) == 'user') ? 'active' : ''; ?>" href="<?= base_url('user'); ?>">
                    <i class="fas fa-users me-2"></i> Manajemen User
                </a>
            </li>
        <?php endif; ?>
        
        <li class="nav-item">
            <a class="nav-link text-danger" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</div>
<!-- 532E48647974 -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">