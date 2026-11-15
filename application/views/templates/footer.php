        </main>

        <!-- FOOTER -->
        <footer class="bg-white border-top py-3 px-4 mt-auto no-print">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center text-muted small">
                <div>
                    Copyright &copy; <?= date('Y'); ?> <strong>Biyan Fakhri Ramadhan</strong> &mdash; Tugas UTS
                </div>
                <div class="mt-1 mt-sm-0">
                    Dibangun dengan <span class="badge bg-light text-dark border">CodeIgniter 3</span> &amp; <span class="badge bg-light text-dark border">Bootstrap 5.3</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fas fa-sign-out-alt text-danger me-2"></i>Konfirmasi Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-secondary">
                Apakah Anda yakin ingin mengakhiri sesi saat ini dan keluar dari aplikasi?
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
                <a class="btn btn-danger px-4" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt me-1"></i>Ya, Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const sidebarToggle = document.getElementById('sidebarToggle');
if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function() {
        document.getElementById('wrapper').classList.toggle('toggled');
    });
}

const accessChecks = document.querySelectorAll('.form-check-access');
accessChecks.forEach(function(chk) {
    chk.addEventListener('change', function() {
        const menuId = this.getAttribute('data-menu');
        const roleId = this.getAttribute('data-role');

        const formData = new URLSearchParams();
        formData.append('menuId', menuId);
        formData.append('roleId', roleId);

        fetch("<?= base_url('admin/changeaccess'); ?>", {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: formData.toString()
        }).then(function() {
            window.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
        });
    });
});
</script>
</body>
</html>
