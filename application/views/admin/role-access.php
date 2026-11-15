<div class="row">
    <div class="col-lg-7">
        <?= $this->session->flashdata('message'); ?>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 fw-bold text-dark">Pengaturan Hak Akses Menu</h6>
                    <small class="text-muted">Role terpilih: <span class="badge bg-primary"><?= $role['role']; ?></span></small>
                </div>
                <a href="<?= base_url('admin/role'); ?>" class="btn btn-light border btn-sm">&larr; Kembali</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" width="12%">#</th>
                            <th>Kategori Menu</th>
                            <th class="text-center pe-4">Akses Diizinkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($menu as $m) : ?>
                        <tr>
                            <td class="ps-4"><?= $i++; ?></td>
                            <td class="fw-semibold"><?= $m['menu']; ?></td>
                            <td class="text-center pe-4">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input form-check-access" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
