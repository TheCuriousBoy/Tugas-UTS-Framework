<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">
                    <!-- Kolom Kiri: Info Studi Kasus & Akun Demo -->
                    <div class="col-lg-6 bg-primary text-white p-5 d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);">
                        <div>
                            <div class="d-inline-flex align-items-center bg-white bg-opacity-10 rounded-pill px-3 py-1 mb-4 small">
                                <i class="fas fa-layer-group me-2"></i> Tugas UTS Sistem Informasi
                            </div>
                            <h2 class="fw-extrabold mb-3">Biyan Fakhri 20250200042</h2>
                            <p class="text-white-50 mb-4">
                                Sistem Informasi Manajemen Inventaris Perangkat Jaringan &amp; Infrastruktur IT berbasis <strong>CodeIgniter 3 MVC</strong>, <strong>Bootstrap 5</strong>, &amp; <strong>MySQL</strong>.
                            </p>

                            <div class="bg-black bg-opacity-25 rounded-3 p-3 mb-3 border border-white border-opacity-10">
                                <div class="fw-bold small text-uppercase mb-2 text-warning">
                                    <i class="fas fa-key me-1"></i> Akun Demo Siap Pakai (Klik untuk Isi Otomatis):
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-sm btn-light text-start d-flex justify-content-between align-items-center" onclick="fillDemo('admin@siframework.ac.id', '123456')">
                                        <span><i class="fas fa-user-shield text-primary me-2"></i><strong>Admin:</strong> admin@siframework.ac.id</span>
                                        <span class="badge bg-primary">Pass: 123456</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light text-start d-flex justify-content-between align-items-center" onclick="fillDemo('teknisi@siframework.ac.id', '123456')">
                                        <span><i class="fas fa-user-cog text-success me-2"></i><strong>Teknisi:</strong> teknisi@siframework.ac.id</span>
                                        <span class="badge bg-success">Pass: 123456</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="small text-white-50">
                            <div class="fw-semibold text-white mb-1">Cakupan 7 Materi Kuliah:</div>
                            1. Framework &bull; 2. Git &amp; GitHub &bull; 3. Bootstrap &bull; 4. CodeIgniter &bull; 5. Sistem Login &bull; 6. Menu Management &bull; 7. CRUD
                        </div>
                    </div>

                    <div class="col-lg-6 p-5 bg-white">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3" style="width: 56px; height: 56px;">
                                <i class="fas fa-lock fa-lg"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-1">Selamat Datang Kembali!</h4>
                            <p class="text-muted small">Silakan masuk menggunakan akun yang terdaftar</p>
                        </div>

                        <?= $this->session->flashdata('message'); ?>

                        <form method="post" action="<?= base_url('auth'); ?>">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?= set_value('email'); ?>">
                                </div>
                                <?= form_error('email', '<small class="text-danger ps-1">', '</small>'); ?>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-semibold text-secondary">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-key text-muted"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password...">
                                </div>
                                <?= form_error('password', '<small class="text-danger ps-1">', '</small>'); ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Dashboard
                            </button>
                        </form>

                        <hr class="my-4">
                        <div class="text-center">
                            <span class="small text-muted">Belum memiliki akun?</span>
                            <a class="small fw-bold text-decoration-none ms-1" href="<?= base_url('auth/registration'); ?>">Daftar Akun Baru &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function fillDemo(email, pass) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = pass;
}
</script>
