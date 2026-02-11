<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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

    /* KALIBRASI POSISI: Hapus margin-left 260px agar sinkron dengan sidebar */
    .riwayat-petugas-container {
        padding: 30px;
        min-height: 100vh;
    }

    .page-title {
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -1px;
    }

    /* Tab Navigasi Modern */
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

    /* Card & Table Styling */
    .card-history {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
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

    /* Badge Custom */
    .badge-status {
        padding: 8px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
    }
</style>

<div class="riwayat-petugas-container">
    <div class="container-fluid p-0">
        <div class="mb-4">
            <h2 class="page-title mb-1">📜 Riwayat Peminjaman</h2>
            <p class="text-muted small">Pantau semua data peminjaman alat yang sudah divalidasi.</p>
        </div>

        <div class="mb-4">
            <div class="nav-custom-wrapper">
                <ul class="nav nav-pills border-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($tab_aktif == 'berjalan') ? 'active' : '' ?>"
                            href="<?= base_url('petugas/riwayat/berjalan') ?>">
                            <i class="bi bi-clock-history me-2"></i>Sedang Berjalan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($tab_aktif == 'ditolak') ? 'active' : '' ?>"
                            href="<?= base_url('petugas/riwayat/ditolak') ?>">
                            <i class="bi bi-x-circle me-2"></i>Ditolak
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($tab_aktif == 'selesai') ? 'active' : '' ?>"
                            href="<?= base_url('petugas/riwayat/selesai') ?>">
                            <i class="bi bi-check-all me-2"></i>Selesai
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card-history">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Peminjam</th>
                            <th>Alat & Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ada_data = false;
                        if (!empty($riwayat)):
                            foreach ($riwayat as $r):
                                // Filter Status Berdasarkan Database (Logic Asli)
                                $tampilkan = false;
                                if ($tab_aktif == 'berjalan' && $r->status == 'approved')
                                    $tampilkan = true;
                                if ($tab_aktif == 'ditolak' && $r->status == 'rejected')
                                    $tampilkan = true;
                                if ($tab_aktif == 'selesai' && $r->status == 'selesai')
                                    $tampilkan = true;

                                if ($tampilkan):
                                    $ada_data = true;
                                    ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="user-avatar"><?= strtoupper(substr($r->nama_lengkap, 0, 1)) ?></div>
                                                <div class="fw-bold"><?= $r->nama_lengkap ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold"><?= $r->nama_alat ?></div>
                                            <div class="text-muted small"><?= $r->jumlah_pinjam ?> unit dipinjam</div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar3 me-2 text-muted"></i>
                                                <?= date('d M Y', strtotime($r->tgl_pinjam)) ?>
                                            </div>
                                        </td>
                                        <td class="pe-4">
                                            <?php if ($r->status == 'approved'): ?>
                                                <span class="badge-status bg-success text-white">Sedang Dipinjam</span>
                                            <?php elseif ($r->status == 'selesai'): ?>
                                                <span class="badge-status bg-secondary text-white">Sudah Kembali</span>
                                            <?php elseif ($r->status == 'rejected'): ?>
                                                <span class="badge-status bg-danger text-white">Ditolak</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php
                                endif;
                            endforeach;
                        endif;

                        if (!$ada_data): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="opacity-25 mb-2">
                                        <i class="bi bi-folder-x" style="font-size: 3.5rem;"></i>
                                    </div>
                                    <p class="text-muted fw-bold">Belum ada data riwayat di kategori ini.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>