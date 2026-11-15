<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-edit text-primary me-2"></i>Update Data Perangkat Inventaris</h6>
                <a href="<?= base_url('inventaris'); ?>" class="btn btn-light border btn-sm">&larr; Kembali</a>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('inventaris/edit/' . $item['id']); ?>" method="post">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Kode Barang</label>
                            <input type="text" class="form-control font-monospace bg-light" name="kode_barang" value="<?= $item['kode_barang']; ?>" readonly>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-semibold">Nama Perangkat Jaringan / IT</label>
                            <input type="text" class="form-control" name="nama_barang" value="<?= $item['nama_barang']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Kategori Perangkat</label>
                            <select name="kategori" class="form-select" required>
                                <?php
                                $kategori_list = ['Router & Firewall', 'CCTV & Keamanan', 'Wireless & Radio', 'Fiber Optic & Kabel', 'Switch & Distribution', 'Alat Ukur & Teknisi'];
                                foreach ($kategori_list as $kat) :
                                ?>
                                    <option value="<?= $kat; ?>" <?= ($item['kategori'] == $kat) ? 'selected' : ''; ?>><?= $kat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Lokasi Penempatan</label>
                            <input type="text" class="form-control" name="lokasi" value="<?= $item['lokasi']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Jumlah Unit</label>
                            <input type="number" class="form-control" name="jumlah" value="<?= $item['jumlah']; ?>" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Kondisi Perangkat</label>
                            <select name="kondisi" class="form-select" required>
                                <option value="Baik" <?= ($item['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                <option value="Perlu Perbaikan" <?= ($item['kondisi'] == 'Perlu Perbaikan') ? 'selected' : ''; ?>>Perlu Perbaikan</option>
                                <option value="Rusak" <?= ($item['kondisi'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Spesifikasi Teknis</label>
                            <textarea class="form-control" name="spesifikasi" rows="3"><?= $item['spesifikasi']; ?></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <button type="submit" class="btn btn-primary px-4 fw-semibold"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                            <a href="<?= base_url('inventaris'); ?>" class="btn btn-light border ms-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
