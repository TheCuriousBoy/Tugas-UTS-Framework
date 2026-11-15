<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3" style="width: 56px; height: 56px;">
                        <i class="fas fa-user-plus fa-lg"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Registrasi Akun Baru</h4>
                </div>

                <form method="post" action="<?= base_url('auth/registration'); ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap Anda..." value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger ps-1">', '</small>'); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Alamat Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="nama@email.com" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger ps-1">', '</small>'); ?>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label small fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Minimal 6 karakter">
                            <?= form_error('password1', '<small class="text-danger ps-1">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label small fw-semibold">Ulangi Password</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Ketik ulang password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Daftarkan Akun
                    </button>
                </form>

                <hr class="my-4">
                <div class="text-center">
                    <span class="small text-muted">Sudah punya akun?</span>
                    <a class="small fw-bold text-decoration-none ms-1" href="<?= base_url('auth'); ?>">Login di sini &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>
