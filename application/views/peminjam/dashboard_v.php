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

    .dashboard-container {
        padding: 20px;
        max-width: 1200px;
    }

    .welcome-card {
        background: #ffffff;
        border-radius: 25px;
        padding: 35px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .glass-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 25px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
    }

    .icon-circle {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .activity-item {
        padding: 12px;
        border-radius: 16px;
        background: #fcfcfc;
        margin-bottom: 10px;
        border: 1px solid #f1f5f9;
    }

    .btn-green-modern {
        background: var(--green-elegant);
        color: white;
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        border: none;
    }

    .text-abu {
        color: #64748b;
    }

    .fw-800 {
        font-weight: 800;
    }
</style>

<div class="dashboard-container">
    <div class="welcome-card">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge px-3 py-2 mb-3"
                    style="background: rgba(30, 86, 49, 0.1); color: var(--green-elegant); border-radius: 10px;">
                    <i class="bi bi-stars me-2"></i> Peminjam Terverifikasi
                </span>
                <h1 class="fw-800 text-dark display-6">Halo, <?= $nama; ?>! 👋</h1>
                <p class="text-abu fs-5">Sudah siap produktif hari ini? Cek katalog alat terbaru yuk.</p>
                <div class="mt-4">
                    <a href="<?= base_url('peminjam/katalog') ?>" class="btn btn-green-modern">
                        <i class="bi bi-search me-2"></i> Jelajahi Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="glass-card">
                <div class="icon-circle" style="background: #eefdf3; color: #1e5631;">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <h6 class="text-abu fw-bold small">ALAT AKTIF</h6>
                <h3 class="fw-800 mb-1">03 <span class="fs-6 text-abu fw-normal">Unit</span></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card">
                <div class="icon-circle" style="background: #fff9eb; color: #f59e0b;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <h6 class="text-abu fw-bold small">MENUNGGU VALIDASI</h6>
                <h3 class="fw-800 mb-1">01 <span class="fs-6 text-abu fw-normal">Proses</span></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card">
                <div class="icon-circle" style="background: #fff1f2; color: #e11d48;">
                    <i class="bi bi-info-square-fill"></i>
                </div>
                <h6 class="text-abu fw-bold small">DENDA</h6>
                <h3 class="fw-800 mb-1">Rp 0</h3>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="glass-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-800 mb-0">Aktivitas Terakhir</h5>
                    <a href="<?= base_url('peminjam/riwayat') ?>" class="btn btn-sm btn-light rounded-pill">Lihat
                        Semua</a>
                </div>

                <?php if (empty($aktivitas)): ?>
                    <div class="text-center py-5">
                        <p class="text-muted small">Belum ada aktivitas terekam. 😊</p>
                    </div>
                <?php else:
                    foreach ($aktivitas as $a):
                        $icon = 'bi-clock-history';
                        $color = 'text-primary';
                        $msg = $a->status;
                        if ($a->status == 'pending') {
                            $icon = 'bi-hourglass-split';
                            $color = 'text-warning';
                            $msg = 'Menunggu persetujuan';
                        } elseif ($a->status == 'disetujui') {
                            $icon = 'bi-check-circle-fill';
                            $color = 'text-success';
                            $msg = 'Peminjaman disetujui';
                        } elseif ($a->status == 'menunggu_validasi') {
                            $icon = 'bi-arrow-return-left';
                            $color = 'text-info';
                            $msg = 'Mengajukan pengembalian';
                        } elseif ($a->status == 'selesai') {
                            $icon = 'bi-bag-check-fill';
                            $color = 'text-secondary';
                            $msg = 'Alat dikembalikan';
                        }
                        ?>
                        <div class="activity-item d-flex align-items-center gap-3">
                            <div class="rounded-circle p-2 <?= $color ?> bg-white shadow-sm"
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi <?= $icon ?>"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold small text-dark"><?= $msg ?></p>
                                <small class="text-abu"><?= $a->nama_alat ?> •
                                    <?= date('d M, H:i', strtotime($a->tgl_pinjam)) ?></small>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="glass-card h-100 shadow-lg" style="background: var(--green-elegant); color: white;">
                <h5 class="fw-800 mb-3"><i class="bi bi-lightbulb me-2"></i> Tahukah Kamu?</h5>
                <p class="opacity-75 mb-4">Mengembalikan alat tepat waktu akan meningkatkan skor peminjam kamu!</p>
                <div class="p-3" style="background: rgba(255,255,255,0.1); border-radius: 16px;">
                    <small class="d-block mb-1 opacity-75">Status Keanggotaan:</small>
                    <span class="fw-bold"><i class="bi bi-shield-fill-check me-1"></i> Peminjam Prioritas</span>
                </div>
            </div>
        </div>
    </div>
</div>