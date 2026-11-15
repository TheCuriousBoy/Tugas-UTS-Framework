<div class="row">
    <div class="col-lg-7">
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 fw-bold text-dark"><i class="fas fa-folder text-primary me-2"></i>Daftar Kategori Menu (Materi 6)</h6>
                    <small class="text-muted">Mengatur grup menu utama pada navigasi sidebar</small>
                </div>
                <button class="btn btn-primary btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#newMenuModal">
                    <i class="fas fa-plus me-1"></i> Tambah Menu Baru
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" width="12%">#</th>
                            <th>Nama Kategori Menu</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($menu as $m) : ?>
                        <tr>
                            <td class="ps-4"><?= $i++; ?></td>
                            <td><span class="fw-semibold text-dark"><?= $m['menu']; ?></span></td>
                            <td class="text-end pe-4">
                                <a href="<?= base_url('menu/editmenu/') . $m['id']; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <a href="<?= base_url('menu/deletemenu/') . $m['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus menu ini?');">
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

<!-- Modal Tambah Menu -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Menu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Menu</label>
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Masukkan nama kategori menu..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
