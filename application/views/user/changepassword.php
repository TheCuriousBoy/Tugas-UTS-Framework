<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-key text-primary me-2"></i>Form Ubah Password</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('user/changepassword'); ?>" method="post">
                    <div class="mb-3">
                        <label for="current_password" class="form-label small fw-semibold">Password Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="new_password1" class="form-label small fw-semibold">Password Baru</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                        <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-4">
                        <label for="new_password2" class="form-label small fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                        <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                        <i class="fas fa-check me-1"></i> Perbarui Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
