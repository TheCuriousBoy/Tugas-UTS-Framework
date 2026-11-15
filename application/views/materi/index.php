<div class="row g-4">
    <div class="col-12">
        <div class="alert alert-primary border-0 shadow-xs rounded-4 d-flex align-items-center p-4 mb-0">
            <i class="fas fa-graduation-cap fa-2x me-3"></i>
            <div>
                <h6 class="fw-bold mb-1">Dokumentasi Implementasi 7 Materi Kuliah Untuk Tugas UTS</h6>
                <p class="mb-0 small">Halaman ini merangkum bagaimana setiap materi perkuliahan diterapkan secara nyata di dalam kode sumber aplikasi ini.</p>
            </div>
        </div>
    </div>

    <?php
    $materi_list = [
        [
            'no' => 'Materi 1',
            'judul' => 'Pengenalan Framework & Konsep MVC',
            'icon' => 'fas fa-sitemap',
            'warna' => 'primary',
            'poin' => 'Framework adalah kerangka kerja terstruktur yang mempercepat pengembangan aplikasi web secara aman dan modular menggunakan arsitektur MVC (Model-View-Controller).',
            'file' => 'application/models/, application/views/, application/controllers/'
        ],
        [
            'no' => 'Materi 2',
            'judul' => 'Git dan GitHub (Version Control System)',
            'icon' => 'fab fa-github',
            'warna' => 'dark',
            'poin' => 'Pengelolaan versi kode sumber menggunakan Git (git init, git add, git commit, git push) serta file .gitignore agar file sampah/cache tidak ikut ter-upload ke repositori GitHub.',
            'file' => '.gitignore, README.md'
        ],
        [
            'no' => 'Materi 3',
            'judul' => 'Bootstrap 5 Responsive UI & Template',
            'icon' => 'fab fa-bootstrap',
            'warna' => 'info',
            'poin' => 'Penerapan sistem Grid responsif, Card komponen, Tabel interaktif, Modal dialog, Badge status, dan Alert flashdata menggunakan Bootstrap 5.3 & FontAwesome.',
            'file' => 'application/views/templates/, assets/css/style.css'
        ],
        [
            'no' => 'Materi 4',
            'judul' => 'CodeIgniter 3 Framework Configuration',
            'icon' => 'fas fa-fire',
            'warna' => 'danger',
            'poin' => 'Konfigurasi base_url otomatis, koneksi database MySQL/MariaDB via phpMyAdmin, autoload libraries (database, session, form_validation), dan clean URL .htaccess.',
            'file' => 'application/config/config.php, database.php, autoload.php, routes.php'
        ],
        [
            'no' => 'Materi 5',
            'judul' => 'Sistem Login, Registrasi & Hak Akses Role',
            'icon' => 'fas fa-user-lock',
            'warna' => 'success',
            'poin' => 'Autentikasi multi-role (Administrator & Member/Teknisi), enkripsi password menggunakan password_hash() & password_verify(), serta proteksi akses URL via helper is_logged_in().',
            'file' => 'application/controllers/Auth.php, application/helpers/wpu_helper.php'
        ],
        [
            'no' => 'Materi 6',
            'judul' => 'Menu Management & Submenu Dinamis',
            'icon' => 'fas fa-bars',
            'warna' => 'warning',
            'poin' => 'Navigasi sidebar yang di-generate otomatis dari relasi tabel user_menu, user_sub_menu, dan user_access_menu sesuai role pengguna yang sedang login.',
            'file' => 'application/controllers/Menu.php, application/models/Menu_model.php'
        ],
        [
            'no' => 'Materi 7',
            'judul' => 'CRUD (Create, Read, Update, Delete)',
            'icon' => 'fas fa-database',
            'warna' => 'primary',
            'poin' => 'Operasi tambah perangkat, tampil tabel & filter pencarian, edit data perangkat, hapus data dengan konfirmasi, serta cetak laporan pada tabel inventaris_it.',
            'file' => 'application/controllers/Inventaris.php, application/models/Inventaris_model.php'
        ],
    ];
    foreach ($materi_list as $m) :
    ?>
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="badge bg-<?= $m['warna']; ?>-subtle text-<?= $m['warna']; ?> px-3 py-2 rounded-pill fw-bold"><?= $m['no']; ?></span>
                        <i class="<?= $m['icon']; ?> fa-lg text-<?= $m['warna']; ?>"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2"><?= $m['judul']; ?></h6>
                    <p class="text-muted small mb-3"><?= $m['poin']; ?></p>
                </div>
                <div class="bg-light rounded-3 p-2 small font-monospace text-secondary border">
                    <i class="fas fa-file-code me-1 text-primary"></i> <?= $m['file']; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
