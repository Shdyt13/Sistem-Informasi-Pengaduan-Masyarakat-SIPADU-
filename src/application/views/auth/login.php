<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Pengaduan Masyarakat</h1>
                                </div>

                                <?php if ($this->session->flashdata('flash')) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= $this->session->flashdata('flash'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-user"
                                            id="username" name="username"
                                            placeholder="Masukkan Username..." value="<?= set_value('username'); ?>">
                                        <small class="text-danger"><?= form_error('username'); ?></small>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Password">
                                        <small class="text-danger"><?= form_error('password'); ?></small>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block w-100">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <small>Silakan login untuk mengakses sistem.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>