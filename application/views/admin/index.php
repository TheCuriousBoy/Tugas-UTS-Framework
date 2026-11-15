<!-- Banner Sambutan -->
<div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white overflow-hidden" style="background: linear-gradient(120deg, #1e3a8a 0%, #2563eb 100%);">
    <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
            <span class="badge bg-warning text-dark fw-bold mb-2">SISTEM INFORMASI SEMESTER 3</span>
            <h4 class="fw-extrabold mb-1">Selamat Datang, <?= $user['name']; ?>!</h4>
            <p class="text-white-50 mb-0 small">
                Semoga harimu selalu diiringi keberkahan.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="<?= base_url('inventaris'); ?>" class="btn btn-light fw-bold text-primary shadow-sm">
                <i class="fas fa-network-wired me-1"></i> Kelola CRUD Inventaris
            </a>
            <a href="<?= base_url('materi'); ?>" class="btn btn-outline-light fw-semibold">
                <i class="fas fa-book-open me-1"></i> Lihat 7 Materi
            </a>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-primary">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Unit Perangkat IT</div>
                    <div class="h3 mb-0 fw-extrabold text-dark"><?= $stats['total_unit']; ?> <small class="fs-6 fw-normal text-muted">Unit</small></div>
                    <small class="text-muted"><?= $stats['total_jenis']; ?> jenis perangkat terdaftar</small>
                </div>
                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                    <i class="fas fa-server fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-success">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-xs fw-bold text-success text-uppercase mb-1">Kondisi Baik / Aktif</div>
                    <div class="h3 mb-0 fw-extrabold text-dark"><?= $stats['baik']; ?> <small class="fs-6 fw-normal text-muted">Unit</small></div>
                    <small class="text-success"><i class="fas fa-check-circle me-1"></i>Siap operasional</small>
                </div>
                <div class="bg-success-subtle text-success rounded-3 p-3">
                    <i class="fas fa-check-double fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-warning">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">Menu &amp; Submenu Dinamis</div>
                    <div class="h3 mb-0 fw-extrabold text-dark"><?= $total_menu; ?> / <?= $total_submenu; ?></div>
                    <small class="text-muted">Menu / Submenu aktif</small>
                </div>
                <div class="bg-warning-subtle text-warning rounded-3 p-3">
                    <i class="fas fa-folder-tree fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-info">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-xs fw-bold text-info text-uppercase mb-1">Pengguna Terdaftar</div>
                    <div class="h3 mb-0 fw-extrabold text-dark"><?= $total_user; ?> <small class="fs-6 fw-normal text-muted">Akun</small></div>
                    <small class="text-muted">Multi-Role Access Control</small>
                </div>
                <div class="bg-info-subtle text-info rounded-3 p-3">
                    <i class="fas fa-users-cog fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-network-wired text-primary me-2"></i>Data Inventaris Perangkat Terbaru (Materi 7: CRUD)</h6>
                <a href="<?= base_url('inventaris'); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua &rarr;</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Kode</th>
                                <th>Nama Perangkat</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center pe-3">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_items as $item) : ?>
                            <tr>
                                <td class="ps-3"><span class="badge bg-light text-dark border font-monospace"><?= $item['kode_barang']; ?></span></td>
                                <td class="fw-semibold"><?= $item['nama_barang']; ?></td>
                                <td><small class="text-muted"><?= $item['kategori']; ?></small></td>
                                <td><small><i class="fas fa-map-marker-alt text-danger me-1"></i><?= $item['lokasi']; ?></small></td>
                                <td class="text-center fw-bold"><?= $item['jumlah']; ?></td>
                                <td class="text-center pe-3">
                                    <?php if ($item['kondisi'] == 'Baik') : ?>
                                        <span class="badge bg-success-subtle text-success">Baik</span>
                                    <?php elseif ($item['kondisi'] == 'Perlu Perbaikan') : ?>
                                        <span class="badge bg-warning-subtle text-warning">Perlu Perbaikan</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger-subtle text-danger">Rusak</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-check-circle text-success me-2"></i>Status Implementasi 7 Materi</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 1:</strong> Pengenalan Framework (MVC)</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 2:</strong> Git &amp; GitHub (`.gitignore` &amp; Docs)</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 3:</strong> Bootstrap 5 Dashboard UI</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 4:</strong> CodeIgniter 3 Architecture</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 5:</strong> Sistem Login &amp; Multi-Role</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 6:</strong> Menu &amp; Submenu Management</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span><strong>Materi 7:</strong> CRUD Inventaris Jaringan IT</span>
                        <span class="badge bg-success rounded-pill">Selesai</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
