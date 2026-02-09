<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="main-container">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">🕒 Riwayat Peminjaman Kamu</h3>
            <a href="<?= base_url('peminjam/katalog') ?>" class="btn btn-outline-primary btn-sm">Tambah Pinjaman</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Tgl Pinjam</th>
                                <th>Nama Alat</th>
                                <th class="text-center">Jumlah</th>
                                <th>Tgl Kembali</th>
                                <th class="text-center">Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayat)): ?>
                                <?php foreach ($riwayat as $r): ?>

                                    <tr class="align-middle">
                                        <td class="ps-4">
                                            <small class="text-muted d-block">Tanggal:</small>
                                            <?= date('d M Y', strtotime($r->tgl_pinjam)) ?>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark"><?= $r->nama_alat ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill bg-secondary"><?= $r->jumlah_pinjam ?> Unit</span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($r->tgl_kembali)) ?></td>
                                        <td class="text-center">
                                            <?php if ($r->status == 'pending'): ?>
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-clock"></i> Menunggu Validasi
                                                </span>
                                            <?php elseif ($r->status == 'disetujui'): ?>
                                                <span class="badge bg-success">Diterima</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Ditolak</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($r->status == 'pending'): ?>
                                                <a href="<?= base_url('peminjam/batal_pinjam/' . $r->id_pinjam) ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin mau batalin pengajuan ini?')">
                                                    🗑️ Batal
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">No Action</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Belum ada riwayat peminjaman nih... 🧐
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>