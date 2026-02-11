<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --primary-green: #1e5631;
        --accent-blue: #4338ca;
        --bg-light: #f8fafc;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-light);
    }

    .validasi-container {
        padding: 2rem;
    }

    /* Header & Tabs */
    .page-header {
        margin-bottom: 2rem;
    }

    .nav-pill-custom {
        background: white;
        padding: 5px;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        display: inline-flex;
    }

    .nav-pill-custom .nav-link {
        border-radius: 10px;
        color: #64748b;
        font-weight: 600;
        padding: 10px 20px;
    }

    .nav-pill-custom .nav-link.active {
        background: var(--primary-green) !important;
    }

    /* Table Card */
    .main-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .table thead th {
        background: #fafafa;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.25rem;
        color: #94a3b8;
    }

    .table tbody td {
        padding: 1.25rem;
        border-color: #f1f5f9;
    }

    /* Utility */
    .avatar-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-weight: 700;
    }

    .btn-rounded {
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 16px;
    }
</style>

<div class="validasi-container">
    <div class="page-header">
        <h2 class="fw-bold mb-1">🛡️ Validasi Pengajuan</h2>
        <p class="text-muted">Manajemen persetujuan peminjaman dan pengembalian alat.</p>
    </div>

    <div class="mb-4">
        <div class="nav-pill-custom">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link <?= ($tab_aktif == 'peminjaman') ? 'active' : '' ?>"
                        href="<?= base_url('petugas/validasi/peminjaman') ?>">
                        <i class="bi bi-box-seam me-2"></i>Peminjaman Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($tab_aktif == 'pengembalian') ? 'active' : '' ?>"
                        href="<?= base_url('petugas/validasi/pengembalian') ?>">
                        <i class="bi bi-arrow-left-right me-2"></i>Menunggu Kembali
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Peminjam</th>
                        <th>Alat & Jumlah</th>
                        <th>Jadwal Pinjam</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ada_data = false;
                    if (!empty($transaksi)):
                        foreach ($transaksi as $t):
                            // Logika filter tab
                            $is_peminjaman = ($tab_aktif == 'peminjaman' && $t->status == 'pending');
                            $is_pengembalian = ($tab_aktif == 'pengembalian' && $t->status == 'menunggu_validasi');

                            if ($is_peminjaman || $is_pengembalian):
                                $ada_data = true; ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="avatar-icon <?= $is_peminjaman ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' ?>">
                                                <?= strtoupper(substr($t->nama_lengkap, 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= $t->nama_lengkap ?></div>
                                                <small class="text-muted">#<?= $t->id_pinjam ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?= $t->nama_alat ?></div>
                                        <span class="badge bg-light text-dark border-0 fw-normal"><?= $t->jumlah_pinjam ?>
                                            Unit</span>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold text-dark"><?= date('d M Y', strtotime($t->tgl_pinjam)) ?>
                                        </div>
                                        <small class="text-muted">s/d <?= date('d M Y', strtotime($t->tgl_kembali)) ?></small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <?php if ($is_peminjaman): ?>
                                            <a href="<?= base_url('petugas/setujui/' . $t->id_pinjam) ?>"
                                                class="btn btn-success btn-rounded btn-sm">Setujui</a>
                                            <a href="<?= base_url('petugas/tolak/' . $t->id_pinjam) ?>"
                                                class="btn btn-outline-danger btn-rounded btn-sm"
                                                onclick="return confirm('Tolak?')">Tolak</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('petugas/kembali/' . $t->id_pinjam) ?>"
                                                class="btn btn-primary btn-rounded btn-sm"
                                                onclick="return confirm('Alat sudah kembali?')">Konfirmasi Kembali</a>
                                        <?php endif; ?>

                                        <a href="<?= base_url('petugas/detail_validasi/' . $t->id_pinjam) ?>"
                                            class="btn btn-light btn-rounded btn-sm ms-1">
                                            <i class="bi bi-chevron-right"></i>
                                    </td>
                                    </td>
                                </tr>
                            <?php endif;
                        endforeach;
                    endif;

                    if (!$ada_data): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-clipboard-x display-4 text-muted opacity-25"></i>
                                <p class="text-muted mt-3 fw-bold">Tidak ada antrian validasi saat ini.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>