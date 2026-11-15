
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-xs rounded-4 bg-white p-3">
            <div class="text-muted small">Total Jenis Perangkat</div>
            <div class="fs-4 fw-extrabold text-primary"><?= $stats['total_jenis']; ?> Jenis</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-xs rounded-4 bg-white p-3">
            <div class="text-muted small">Total Unit Terpasang</div>
            <div class="fs-4 fw-extrabold text-dark"><?= $stats['total_unit']; ?> Unit</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-xs rounded-4 bg-white p-3">
            <div class="text-muted small">Kondisi Baik</div>
            <div class="fs-4 fw-extrabold text-success"><?= $stats['baik']; ?> Unit</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-xs rounded-4 bg-white p-3">
            <div class="text-muted small">Perlu Perbaikan / Rusak</div>
            <div class="fs-4 fw-extrabold text-warning"><?= $stats['perbaikan'] + $stats['rusak']; ?> Unit</div>
        </div>
    </div>
</div>

<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= validation_errors(); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?= $this->session->flashdata('message'); ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3">
        <div class="row g-2 align-items-center justify-content-between">
            <div class="col-md-5">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-network-wired text-primary me-2"></i>Manajemen Inventaris Perangkat Jaringan &amp; IT (CRUD)</h6>
            </div>
            <div class="col-md-7 d-flex flex-wrap justify-content-md-end gap-2">
                <form action="<?= base_url('inventaris'); ?>" method="get" class="d-flex gap-2">
                    <select name="kategori" class="form-select form-select-sm" style="width:auto;" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <?php
                        $kategori_list = ['Router & Firewall', 'CCTV & Keamanan', 'Wireless & Radio', 'Fiber Optic & Kabel', 'Switch & Distribution', 'Alat Ukur & Teknisi'];
                        foreach ($kategori_list as $kat) :
                        ?>
                            <option value="<?= $kat; ?>" <?= ($kategori_aktif == $kat) ? 'selected' : ''; ?>><?= $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group input-group-sm" style="width: 210px;">
                        <input type="text" name="q" class="form-control" placeholder="Cari perangkat/lokasi..." value="<?= $keyword; ?>">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <button class="btn btn-primary btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addInventarisModal">
                    <i class="fas fa-plus me-1"></i> Tambah Perangkat
                </button>
                <a href="<?= base_url('inventaris/laporan'); ?>" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-print me-1"></i> Laporan
                </a>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Kode Barang</th>
                        <th>Nama Perangkat IT</th>
                        <th>Kategori</th>
                        <th>Lokasi Penempatan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Kondisi</th>
                        <th class="text-end pe-4">Aksi CRUD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($items)) : ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Data perangkat tidak ditemukan.</td>
                    </tr>
                    <?php endif; ?>

                    <?php $i = 1; foreach ($items as $item) : ?>
                    <tr>
                        <td class="ps-4"><?= $i++; ?></td>
                        <td><span class="badge bg-light text-dark border font-monospace"><?= $item['kode_barang']; ?></span></td>
                        <td>
                            <div class="fw-bold text-dark"><?= $item['nama_barang']; ?></div>
                            <small class="text-muted text-truncate d-inline-block" style="max-width: 260px;"><?= $item['spesifikasi']; ?></small>
                        </td>
                        <td><span class="badge bg-primary-subtle text-primary"><?= $item['kategori']; ?></span></td>
                        <td><small><i class="fas fa-map-marker-alt text-danger me-1"></i><?= $item['lokasi']; ?></small></td>
                        <td class="text-center fw-bold"><?= $item['jumlah']; ?> Unit</td>
                        <td class="text-center">
                            <?php if ($item['kondisi'] == 'Baik') : ?>
                                <span class="badge bg-success-subtle text-success"><i class="fas fa-check-circle me-1"></i>Baik</span>
                            <?php elseif ($item['kondisi'] == 'Perlu Perbaikan') : ?>
                                <span class="badge bg-warning-subtle text-warning"><i class="fas fa-tools me-1"></i>Perlu Perbaikan</span>
                            <?php else : ?>
                                <span class="badge bg-danger-subtle text-danger"><i class="fas fa-times-circle me-1"></i>Rusak</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= base_url('inventaris/detail/') . $item['id']; ?>" class="btn btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('inventaris/edit/') . $item['id']; ?>" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('inventaris/delete/') . $item['id']; ?>" class="btn btn-outline-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus perangkat <?= $item['nama_barang']; ?>?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addInventarisModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle text-primary me-2"></i>Tambah Perangkat Inventaris Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('inventaris'); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Kode Barang</label>
                            <input type="text" class="form-control font-monospace" name="kode_barang" value="INV-IT-00<?= $stats['total_jenis'] + 1; ?>" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-semibold">Nama Perangkat Jaringan / IT</label>
                            <input type="text" class="form-control" name="nama_barang" placeholder="Contoh: Access Point Ubiquiti UniFi U6-LR" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Kategori Perangkat</label>
                            <select name="kategori" class="form-select" required>
                                <option value="Router & Firewall">Router &amp; Firewall</option>
                                <option value="CCTV & Keamanan">CCTV &amp; Keamanan</option>
                                <option value="Wireless & Radio">Wireless &amp; Radio</option>
                                <option value="Fiber Optic & Kabel">Fiber Optic &amp; Kabel</option>
                                <option value="Switch & Distribution">Switch &amp; Distribution</option>
                                <option value="Alat Ukur & Teknisi">Alat Ukur &amp; Teknisi</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Lokasi Penempatan</label>
                            <input type="text" class="form-control" name="lokasi" placeholder="Contoh: Ruang Server Gedung Utama" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Jumlah Unit</label>
                            <input type="number" class="form-control" name="jumlah" value="1" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Kondisi Perangkat</label>
                            <select name="kondisi" class="form-select" required>
                                <option value="Baik">Baik</option>
                                <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Spesifikasi Teknis &amp; Keterangan</label>
                            <textarea class="form-control" name="spesifikasi" rows="3" placeholder="Tuliskan detail spesifikasi perangkat, IP Address, VLAN, atau catatan pemeliharaan..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
