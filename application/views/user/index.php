<div class="row">
    <div class="col-lg-8">
        <?= $this->session->flashdata('message'); ?>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4" style="max-width: 640px;">
    <div class="card-body p-4">
        <div class="d-flex flex-column flex-sm-row align-items-center gap-4">
            <img src="<?= base_url('assets/img/') . $user['image']; ?>" class="rounded-circle border shadow-xs" width="110" height="110" alt="Avatar">
            <div>
                <span class="badge bg-primary-subtle text-primary mb-2">
                    <?= ($user['role_id'] == 1) ? 'Administrator Sistem' : 'Member / Teknisi Jaringan'; ?>
                </span>
                <h4 class="fw-extrabold text-dark mb-1"><?= $user['name']; ?></h4>
                <p class="text-muted mb-2"><i class="fas fa-envelope me-2"></i><?= $user['email']; ?></p>
                <p class="text-muted small mb-3">
                    <i class="fas fa-calendar-check me-2"></i>Terdaftar sejak: <?= date('d F Y', $user['date_created']); ?>
                </p>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('user/edit'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit me-1"></i>Edit Profil</a>
                    <a href="<?= base_url('user/changepassword'); ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-key me-1"></i>Ubah Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
