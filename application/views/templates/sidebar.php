    <!-- ==================================================================== -->
    <!-- SIDEBAR DINAMIS BERDASARKAN ROLE & DATABASE (MATERI 6: MENU MANAGEMENT) -->
    <!-- ==================================================================== -->
    <aside id="sidebar-wrapper" class="sidebar-gradient text-white shadow-lg">
        <div class="sidebar-brand d-flex align-items-center justify-content-center py-4 px-3 border-bottom border-white border-opacity-10">
            <div class="brand-icon bg-white text-primary rounded-3 d-flex align-items-center justify-content-center me-2 shadow-sm" style="width:40px;height:40px;">
                <i class="fas fa-server fa-lg"></i>
            </div>
            <div class="text-start">
                <div class="fw-extrabold fs-5 lh-1 tracking-tight">Gudang-IT</div>
                <small class="text-white-50" style="font-size: 0.72rem;">CodeIgniter 3 &bull; Bootstrap 5</small>
            </div>
        </div>

        <div class="sidebar-nav px-3 py-3">
            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                           WHERE `user_access_menu`.`role_id` = $role_id
                        ORDER BY `user_access_menu`.`menu_id` ASC";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>

            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-heading text-uppercase fw-bold text-white-50 mt-3 mb-1 px-2" style="font-size: 0.70rem; letter-spacing: 0.08em;">
                    <?= $m['menu']; ?>
                </div>

                <?php
                $menuId = $m['id'];
                $querySubMenu = "SELECT *
                                   FROM `user_sub_menu` JOIN `user_menu`
                                     ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                  WHERE `user_sub_menu`.`menu_id` = $menuId
                                    AND `user_sub_menu`.`is_active` = 1";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>

                <?php foreach ($subMenu as $sm) : ?>
                    <?php $isActive = ($title == $sm['title']) ? 'active' : ''; ?>
                    <a href="<?= base_url($sm['url']); ?>" class="nav-link-sidebar d-flex align-items-center rounded-3 px-3 py-2 mb-1 text-decoration-none <?= $isActive; ?>">
                        <i class="<?= $sm['icon']; ?> me-3 text-center" style="width: 20px;"></i>
                        <span class="fw-medium" style="font-size: 0.88rem;"><?= $sm['title']; ?></span>
                    </a>
                <?php endforeach; ?>

                <hr class="border-white border-opacity-10 my-2">
            <?php endforeach; ?>

            <a href="<?= base_url('auth/logout'); ?>" class="nav-link-sidebar d-flex align-items-center rounded-3 px-3 py-2 mt-2 text-decoration-none text-warning" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt me-3 text-center" style="width: 20px;"></i>
                <span class="fw-semibold" style="font-size: 0.88rem;">Logout Sistem</span>
            </a>
        </div>
    </aside>
