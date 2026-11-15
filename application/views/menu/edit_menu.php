<div class="row">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-dark">Edit Kategori Menu</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('menu/editmenu/' . $menu_item['id']); ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Menu</label>
                        <input type="text" class="form-control" name="menu" value="<?= $menu_item['menu']; ?>" required>
                        <?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="<?= base_url('menu'); ?>" class="btn btn-light border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
