<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <div>
        <h6 class="mb-0 fw-bold">Rekapitulasi Laporan Inventaris Perangkat Jaringan &amp; IT</h6>
        <small class="text-muted">Siap dicetak atau disimpan sebagai PDF melalui dialog Print browser</small>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-primary btn-sm fw-semibold">
            <i class="fas fa-print me-1"></i> Cetak Laporan / Simpan PDF
        </button>
        <a href="<?= base_url('inventaris'); ?>" class="btn btn-light border btn-sm">&larr; Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="text-center border-bottom pb-3 mb-4">
        <h4 class="fw-extrabold mb-1">LAPORAN INVENTARIS INFRASTRUKTUR JARINGAN &amp; IT</h4>
        <div class="text-muted small">Sistem Informasi Manajemen Inventaris (SI-NETINV) &mdash; Tanggal Cetak: <?= date('d F Y H:i'); ?> WIB</div>
    </div>

    <table class="table table-bordered align-middle small">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Perangkat</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Kondisi</th>
                <th>Spesifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($items as $item) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td class="font-monospace"><?= $item['kode_barang']; ?></td>
                <td class="fw-semibold"><?= $item['nama_barang']; ?></td>
                <td><?= $item['kategori']; ?></td>
                <td><?= $item['lokasi']; ?></td>
                <td class="text-center"><?= $item['jumlah']; ?></td>
                <td class="text-center"><?= $item['kondisi']; ?></td>
                <td><?= $item['spesifikasi']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row mt-4 pt-2 small">
        <div class="col-6">
            <strong>Ringkasan Total:</strong> <?= $stats['total_jenis']; ?> Jenis Perangkat (<?= $stats['total_unit']; ?> Unit Terpasang)
        </div>
        <div class="col-6 text-end">
            Dicetak oleh: <strong><?= $user['name']; ?></strong>
        </div>
    </div>
</div>
