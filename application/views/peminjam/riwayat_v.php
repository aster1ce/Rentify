<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .main-container {
        margin-left: 260px;
        padding: 20px;
        background-color: #f4f7f6;
        min-height: 100vh;
    }

    .nav-pills .nav-link.active {
        background-color: #1e5631 !important;
    }

    .nav-pills .nav-link {
        color: #1e5631;
        font-weight: bold;
    }

    .card {
        border-radius: 15px;
    }
</style>

<div class="main-container">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark">🕒 Riwayat Peminjaman Kamu</h3>
            <a href="<?= base_url('peminjam/katalog') ?>" class="btn btn-outline-primary btn-sm">Tambah Pinjaman</a>
        </div>

        <ul class="nav nav-pills mb-4">
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'berlangsung') ? 'active' : '' ?>"
                    href="<?= base_url('peminjam/riwayat/berlangsung') ?>">Berlangsung</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'ditolak') ? 'active' : '' ?>"
                    href="<?= base_url('peminjam/riwayat/ditolak') ?>">Ditolak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'selesai') ? 'active' : '' ?>"
                    href="<?= base_url('peminjam/riwayat/selesai') ?>">Selesai</a>
            </li>
        </ul>

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
                                <th class="pe-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ada_data = false;
                            if (!empty($riwayat)):
                                foreach ($riwayat as $r):
                                    // PERBAIKAN: Tambahkan 'menunggu_validasi' agar lolos filter tab
                                    $tampilkan = false;
                                    if ($tab_aktif == 'berlangsung' && ($r->status == 'pending' || $r->status == 'approved' || $r->status == 'menunggu_validasi'))
                                        $tampilkan = true;
                                    if ($tab_aktif == 'ditolak' && $r->status == 'rejected')
                                        $tampilkan = true;
                                    if ($tab_aktif == 'selesai' && $r->status == 'selesai')
                                        $tampilkan = true;

                                    if ($tampilkan):
                                        $ada_data = true;
                                        ?>
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
                                            <td><?= ($r->tgl_kembali && $r->tgl_kembali != '0000-00-00') ? date('d M Y', strtotime($r->tgl_kembali)) : '-' ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($r->status == 'menunggu_validasi'): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock-history"></i> Pengembalian Diajukan
                                                    </span>
                                                <?php elseif ($r->status == 'approved'): ?>
                                                    <span class="badge bg-success">Sedang Dipinjam</span>
                                                <?php elseif ($r->status == 'rejected'): ?>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                <?php elseif ($r->status == 'selesai'): ?>
                                                    <span class="badge bg-secondary">Sudah Kembali</span>
                                                <?php elseif ($r->status == 'pending'): ?>
                                                    <span class="badge bg-warning text-dark">Peminjaman Diajukan</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="pe-4 text-center">
                                                <?php if ($r->status == 'pending'): ?>
                                                    <a href="<?= base_url('peminjam/batal_pinjam/' . $r->id_pinjam) ?>"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Yakin mau batalin pengajuan ini?')">
                                                        🗑️ Batal
                                                    </a>
                                                <?php elseif ($r->status == 'approved'): ?>
                                                    <a href="<?= base_url('peminjam/kembalikan/' . $r->id_pinjam) ?>"
                                                        class="btn btn-sm btn-primary rounded-pill px-3"
                                                        onclick="return confirm('Yakin ingin mengembalikan alat ini?')">
                                                        Kembalikan Alat
                                                    </a>
                                                <?php elseif ($r->status == 'menunggu_validasi'): ?>
                                                    <button class="btn btn-sm btn-light" disabled>Proses Pengembalian...</button>
                                                <?php else: ?>
                                                    <span class="text-muted small">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endif;
                                endforeach;
                            endif;

                            if (!$ada_data): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        Belum ada data di tab ini... 🧐
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