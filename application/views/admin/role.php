<div class="row">
    <div class="col-lg-7">
        <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-user-shield text-primary me-2"></i>Daftar Role Pengguna (Materi 5 &amp; 6)</h6>
                <button class="btn btn-primary btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#newRoleModal">
                    <i class="fas fa-plus me-1"></i> Tambah Role Baru
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" width="10%">#</th>
                            <th>Nama Role</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($role as $r) : ?>
                        <tr>
                            <td class="ps-4"><?= $i++; ?></td>
                            <td class="fw-semibold"><?= $r['role']; ?></td>
                            <td class="text-end pe-4">
                                <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="btn btn-warning btn-sm text-dark fw-semibold">
                                    <i class="fas fa-key me-1"></i> Hak Akses
                                </a>
                                <?php if ($r['id'] != 1) : ?>
                                <a href="<?= base_url('admin/deleterole/') . $r['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus role ini?');">
                                    <i class="fas fa-trash"></i>
                                </a>
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

<div class="modal fade" id="newRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Role Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Role</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="Contoh: Supervisor IT" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
