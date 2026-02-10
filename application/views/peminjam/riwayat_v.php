<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --green-elegant: #1e5631;
        --green-hover: #153e23;
        --soft-bg: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--soft-bg);
    }

    /* Container - SAMA PERSIS DENGAN DASHBOARD KAMU */
    .dashboard-container {
        padding: 20px;
        max-width: 1200px;
    }

    /* Typography & Header */
    .fw-800 {
        font-weight: 800;
    }

    .text-abu {
        color: #64748b;
    }

    /* Tab Styling Gaya Modern */
    .nav-pills {
        background: rgba(0, 0, 0, 0.03);
        padding: 5px;
        border-radius: 14px;
        display: inline-flex;
        margin-bottom: 25px;
    }

    .nav-pills .nav-link {
        color: #64748b;
        font-weight: 700;
        border-radius: 10px;
        font-size: 0.9rem;
        padding: 8px 20px;
        transition: 0.3s;
    }

    .nav-pills .nav-link.active {
        background-color: var(--green-elegant) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(30, 86, 49, 0.15);
    }

    /* Table Card - Gaya Glass Card Dashboard */
    .table-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }

    .table thead th {
        background: #fcfcfc;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #94a3b8;
        padding: 15px 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Status Badges */
    .s-badge {
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.7rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .s-pending {
        background: #fffbeb;
        color: #b45309;
    }

    .s-approved {
        background: #f0fdf4;
        color: #15803d;
    }

    .s-rejected {
        background: #fef2f2;
        color: #b91c1c;
    }

    .s-selesai {
        background: #f1f5f9;
        color: #475569;
    }

    /* Buttons */
    .btn-green-modern {
        background: var(--green-elegant);
        color: white;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-green-modern:hover {
        background: var(--green-hover);
        color: white;
    }

    .btn-action-outline {
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        border: 1px solid #e2e8f0;
        color: #64748b;
        background: white;
    }
</style>

<div class="dashboard-container">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-800 text-dark mb-1">Riwayat Pinjam</h2>
            <p class="text-abu mb-0 small">Kelola dan pantau alat yang sedang kamu pinjam.</p>
        </div>
        <a href="<?= base_url('peminjam/katalog') ?>" class="btn-green-modern btn-sm shadow-sm text-decoration-none">
            <i class="bi bi-plus-lg me-1"></i> Pinjam Alat
        </a>
    </div>

    <ul class="nav nav-pills">
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

    <div class="table-card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Nama Alat</th>
                        <th class="text-center">Jumlah</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
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
                                $ada_data = true;
                                ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $r->nama_alat ?></div>
                                        <small class="text-abu">ID #<?= $r->id_pinjam ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border-0 px-2 py-1"><?= $r->jumlah_pinjam ?>
                                            Unit</span>
                                    </td>
                                    <td>
                                        <div class="small fw-600">
                                            <?= ($r->tgl_kembali && $r->tgl_kembali != '0000-00-00') ? date('d M Y', strtotime($r->tgl_kembali)) : '-' ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($r->status == 'menunggu_validasi'): ?>
                                            <span class="s-badge s-pending"><i class="bi bi-arrow-repeat"></i> Validasi</span>
                                        <?php elseif ($r->status == 'approved'): ?>
                                            <span class="s-badge s-approved"><i class="bi bi-check-circle-fill"></i> Aktif</span>
                                        <?php elseif ($r->status == 'rejected'): ?>
                                            <span class="s-badge s-rejected">Ditolak</span>
                                        <?php elseif ($r->status == 'selesai'): ?>
                                            <span class="s-badge s-selesai">Selesai</span>
                                        <?php elseif ($r->status == 'pending'): ?>
                                            <span class="s-badge s-pending">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($r->status == 'pending'): ?>
                                            <a href="<?= base_url('peminjam/batal_pinjam/' . $r->id_pinjam) ?>"
                                                class="btn btn-action-outline btn-sm text-danger"
                                                onclick="return confirm('Batal?')">Batal</a>
                                        <?php elseif ($r->status == 'approved'): ?>
                                            <a href="<?= base_url('peminjam/kembalikan/' . $r->id_pinjam) ?>"
                                                class="btn-green-modern btn-sm text-decoration-none py-1">Kembalikan</a>
                                        <?php else: ?>
                                            <span class="text-abu small">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; endforeach; endif; ?>

                    <?php if (!$ada_data): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-abu small">Belum ada data aktivitas di sini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>