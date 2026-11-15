  <div id="page-content-wrapper" class="w-100 d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-xs px-4 py-3 sticky-top no-print">
            <div class="d-flex align-items-center">
                <button class="btn btn-light border me-3" id="sidebarToggle" title="Toggle Menu">
                    <i class="fas fa-bars text-secondary"></i>
                </button>
                <div>
                    <h5 class="mb-0 fw-bold text-dark"><?= $title; ?></h5>
                    <small class="text-muted">Sistem Informasi Semester 3 &bull; Pemrograman Framework</small>
                </div>
            </div>

            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="badge <?= ($user['role_id'] == 1) ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-success-subtle text-success border border-success-subtle'; ?> px-3 py-2 rounded-pill d-none d-md-inline-block">
                    <i class="fas <?= ($user['role_id'] == 1) ? 'fa-user-shield' : 'fa-user-cog'; ?> me-1"></i>
                    <?= ($user['role_id'] == 1) ? 'Administrator' : 'Member / Teknisi'; ?>
                </span>

                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="<?= base_url('assets/img/' . $user['image']); ?>" alt="Profile" class="rounded-circle border me-2" width="38" height="38">
                        <div class="d-none d-sm-block text-start me-1">
                            <div class="fw-semibold lh-1" style="font-size:0.88rem;"><?= $user['name']; ?></div>
                            <small class="text-muted" style="font-size:0.75rem;"><?= $user['email']; ?></small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item py-2" href="<?= base_url('user'); ?>"><i class="fas fa-user fa-sm fa-fw me-2 text-muted"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item py-2" href="<?= base_url('user/edit'); ?>"><i class="fas fa-user-edit fa-sm fa-fw me-2 text-muted"></i>Edit Profil</a></li>
                        <li><a class="dropdown-item py-2" href="<?= base_url('user/changepassword'); ?>"><i class="fas fa-key fa-sm fa-fw me-2 text-muted"></i>Ubah Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger fw-semibold" href="<?= base_url('auth/logout'); ?>" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid px-4 py-4 flex-grow-1">
