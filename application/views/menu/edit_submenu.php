<div class="row">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-dark">Edit Data Submenu</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('menu/editsubmenu/' . $sub['id']); ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Judul Submenu</label>
                        <input type="text" class="form-control" name="title" value="<?= $sub['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori Menu</label>
                        <select name="menu_id" class="form-select" required>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>" <?= ($m['id'] == $sub['menu_id']) ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">URL Endpoint</label>
                        <input type="text" class="form-control" name="url" value="<?= $sub['url']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Icon FontAwesome</label>
                        <input type="text" class="form-control" name="icon" value="<?= $sub['icon']; ?>" required>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" <?= ($sub['is_active'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="is_active">Submenu Aktif</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-light border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
