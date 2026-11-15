<div class="row">
    <div class="col-lg-12">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
        <?php endif; ?>
        <?= $this->session->flashdata('message'); ?>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 fw-bold text-dark"><i class="fas fa-folder-open text-primary me-2"></i>Daftar Submenu Navigasi (Materi 6)</h6>
                    <small class="text-muted">Mengelola item link submenu, URL controller, dan ikon FontAwesome</small>
                </div>
                <button class="btn btn-primary btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#newSubMenuModal">
                    <i class="fas fa-plus me-1"></i> Tambah Submenu Baru
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Judul Submenu</th>
                                <th>Kategori Menu</th>
                                <th>URL Endpoint</th>
                                <th>Icon</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($subMenu as $sm) : ?>
                            <tr>
                                <td class="ps-4"><?= $i++; ?></td>
                                <td class="fw-semibold"><?= $sm['title']; ?></td>
                                <td><span class="badge bg-primary-subtle text-primary"><?= $sm['menu']; ?></span></td>
                                <td><code><?= $sm['url']; ?></code></td>
                                <td><i class="<?= $sm['icon']; ?> text-secondary me-2"></i><small class="text-muted"><?= $sm['icon']; ?></small></td>
                                <td class="text-center">
                                    <?php if ($sm['is_active'] == 1) : ?>
                                        <span class="badge bg-success-subtle text-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary-subtle text-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('menu/editsubmenu/') . $sm['id']; ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('menu/deletesubmenu/') . $sm['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus submenu ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Submenu -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Submenu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Judul Submenu</label>
                        <input type="text" class="form-control" name="title" placeholder="Contoh: Data Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Pilih Kategori Menu</label>
                        <select name="menu_id" class="form-select" required>
                            <option value="">-- Pilih Menu --</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">URL Controller/Method</label>
                        <input type="text" class="form-control" name="url" placeholder="Contoh: inventaris/supplier" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Class Icon FontAwesome</label>
                        <input type="text" class="form-control" name="icon" placeholder="Contoh: fas fa-fw fa-box" value="fas fa-fw fa-folder" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Aktifkan Submenu Ini?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Submenu</button>
                </div>
            </form>
        </div>
    </div>
</div>
