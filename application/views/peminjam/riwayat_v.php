<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">

<style>
    :root {
        --hijau-utama: #1e5631;
        --soft-bg: #f8fafc;
        --text-dark: #1e293b;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--soft-bg);
    }

    /* KALIBRASI: Kita hapus margin-left 280px. 
       Kita pakai padding 30px saja, sama seperti .katalog-container 
    */
    .riwayat-container {
        padding: 30px;
    }

    .page-title {
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -1px;
    }

    /* Tab Navigasi Modern ala Katalog */
    .nav-custom-wrapper {
        background: #ffffff;
        padding: 6px;
        border-radius: 16px;
        display: inline-flex;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    }

    .nav-custom-wrapper .nav-link {
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 10px 24px;
        border-radius: 12px;
        transition: all 0.3s;
        border: none;
    }

    .nav-custom-wrapper .nav-link.active {
        background-color: var(--hijau-utama) !important;
        color: #ffffff !important;
    }

    /* Table & Card Styling */
    .card-custom {
        border-radius: 24px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        background: #ffffff;
        overflow: hidden;
    }

    .table thead th {
        background-color: #fcfcfd;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody td {
        padding: 20px;
        color: var(--text-dark);
        border-bottom: 1px solid #f8fafc;
        font-size: 0.9rem;
    }

    /* Badge & Button */
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 11px;
    }

    .btn-add {
        background-color: var(--hijau-utama);
        color: white;
        border-radius: 14px;
        padding: 12px 24px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }

    .btn-add:hover {
        background-color: #153e23;
        color: white;
        box-shadow: 0 8px 15px rgba(30, 86, 49, 0.2);
    }
</style>

<div class="riwayat-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">🕒 Riwayat Peminjaman</h2>
            <p class="text-muted mb-0">Kelola daftar alat yang sedang atau pernah kamu pinjam.</p>
        </div>
        <a href="<?= base_url('peminjam/katalog') ?>" class="btn btn-add">
            <i class="bi bi-plus-lg me-1"></i> Pinjam Alat
        </a>
    </div>

    <div class="mb-4">
        <div class="nav-custom-wrapper">
            <ul class="nav nav-pills border-0">
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
        </div>
    </div>

    <div class="card card-custom">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Detail Pinjam</th>
                        <th>Alat</th>
                        <th class="text-center">Jumlah</th>
                        <th>Estimasi Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ada_data = false;
                    if (!empty($riwayat)):
                        foreach ($riwayat as $r):
                            $tampilkan = false;
                            if ($tab_aktif == 'berlangsung' && ($r->status == 'pending' || $r->status == 'approved' || $r->status == 'menunggu_validasi'))
                                $tampilkan = true;
                            if ($tab_aktif == 'ditolak' && $r->status == 'rejected')
                                $tampilkan = true;
                            if ($tab_aktif == 'selesai' && $r->status == 'selesai')
                                $tampilkan = true;

                            if ($tampilkan):
                                $ada_data = true; ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold"><?= date('d/m/Y', strtotime($r->tgl_pinjam)) ?></div>
                                        <small class="text-muted">#ID-<?= $r->id_pinjam ?></small>
                                    </td>
                                    <td><span class="fw-bold"><?= $r->nama_alat ?></span></td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-3 py-2" style="border-radius: 8px;">
                                            <?= $r->jumlah_pinjam ?> Unit
                                        </span>
                                    </td>
                                    <td>
                                        <?= ($r->tgl_kembali && $r->tgl_kembali != '0000-00-00') ? date('d/m/Y', strtotime($r->tgl_kembali)) : '<span class="text-muted small">--/--/--</span>' ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($r->status == 'approved'): ?>
                                            <span class="badge-status bg-success text-white">Dipinjam</span>
                                        <?php elseif ($r->status == 'pending'): ?>
                                            <span class="badge-status bg-info text-white">Peminjaman Diajukan</span>
                                        <?php elseif ($r->status == 'menunggu_validasi'): ?>
                                            <span class="badge-status bg-warning text-dark">Pengembalian Diajukan</span>
                                        <?php elseif ($r->status == 'rejected'): ?>
                                            <span class="badge-status bg-danger text-white">Ditolak</span>
                                        <?php else: ?>
                                            <span class="badge-status bg-secondary text-white">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <?php if ($r->status == 'pending'): ?>
                                            <a href="<?= base_url('peminjam/batal_pinjam/' . $r->id_pinjam) ?>"
                                                class="btn btn-sm btn-outline-danger px-3 fw-bold" style="border-radius: 8px;"
                                                onclick="return confirm('Batalkan?')">Batal</a>
                                        <?php elseif ($r->status == 'approved'): ?>
                                            <a href="<?= base_url('peminjam/kembalikan/' . $r->id_pinjam) ?>"
                                                class="btn btn-sm btn-primary px-3 fw-bold"
                                                style="background: var(--hijau-utama); border:none; border-radius: 8px;"
                                                onclick="return confirm('Kembalikan?')">Kembalikan</a>
                                        <?php else: ?>
                                            <i class="bi bi-check-circle-fill text-muted"></i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif;
                        endforeach;
                    endif;

                    if (!$ada_data): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="text-muted mt-3 fw-bold">Belum ada riwayat di kategori ini.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>