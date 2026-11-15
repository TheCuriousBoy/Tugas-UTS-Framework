<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-user-edit text-primary me-2"></i>Form Edit Profil Pengguna</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('user/edit'); ?>" method="post">
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-form-label fw-semibold small">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control bg-light" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                            <small class="text-muted">Alamat email digunakan sebagai identitas login dan tidak dapat diubah.</small>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="name" class="col-sm-3 col-form-label fw-semibold small">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary px-4 fw-semibold">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
