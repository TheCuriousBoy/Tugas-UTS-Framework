<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-info-circle text-primary me-2"></i>Detail Spesifikasi Perangkat</h6>
                <a href="<?= base_url('inventaris'); ?>" class="btn btn-light border btn-sm">&larr; Kembali</a>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="badge bg-light text-dark border font-monospace mb-2"><?= $item['kode_barang']; ?></span>
                        <h4 class="fw-extrabold text-dark mb-1"><?= $item['nama_barang']; ?></h4>
                        <span class="badge bg-primary-subtle text-primary"><?= $item['kategori']; ?></span>
                    </div>
                    <span class="badge <?= ($item['kondisi'] == 'Baik') ? 'bg-success' : (($item['kondisi'] == 'Perlu Perbaikan') ? 'bg-warning text-dark' : 'bg-danger'); ?> px-3 py-2">
                        <?= $item['kondisi']; ?>
                    </span>
                </div>
                <hr>
                <dl class="row mb-0">
                    <dt class="col-sm-4 text-muted">Lokasi Penempatan</dt>
                    <dd class="col-sm-8 fw-semibold"><?= $item['lokasi']; ?></dd>

                    <dt class="col-sm-4 text-muted">Jumlah Terpasang</dt>
                    <dd class="col-sm-8 fw-bold"><?= $item['jumlah']; ?> Unit</dd>

                    <dt class="col-sm-4 text-muted">Spesifikasi Teknis</dt>
                    <dd class="col-sm-8"><?= $item['spesifikasi']; ?></dd>

                    <dt class="col-sm-4 text-muted">Terakhir Diperbarui</dt>
                    <dd class="col-sm-8 text-muted small"><?= $item['updated_at']; ?></dd>
                </dl>
            </div>
            <div class="card-footer bg-white border-top py-3">
                <a href="<?= base_url('inventaris/edit/') . $item['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit me-1"></i> Edit Perangkat</a>
            </div>
        </div>
    </div>
</div>
