<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --green-elegant: #1e5631;
        --soft-bg: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--soft-bg);
    }

    .katalog-container {
        padding: 30px;
    }

    .section-title {
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -1px;
    }

    /* Alat Card Styling */
    .alat-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .alat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .img-wrapper {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .alat-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .alat-card:hover .alat-img {
        transform: scale(1.1);
    }

    .badge-kategori {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        color: var(--green-elegant);
        font-weight: 700;
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 10px;
        text-transform: uppercase;
    }

    .stok-info {
        font-size: 13px;
        font-weight: 700;
    }

    .btn-detail {
        background: var(--green-elegant);
        color: white;
        border-radius: 12px;
        font-weight: 600;
        padding: 10px 20px;
        transition: 0.3s;
        border: none;
        width: 100%;
    }

    .btn-detail:hover:not(:disabled) {
        background: #153e23;
        color: white;
        box-shadow: 0 8px 15px rgba(30, 86, 49, 0.2);
    }

    .btn-detail:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .out-of-stock-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
</style>

<div class="katalog-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title mb-1">📦 Katalog Alat</h2>
            <p class="text-muted">Pilih alat terbaik untuk menunjang produktivitasmu.</p>
        </div>
        <div class="search-box">
        </div>
    </div>

    <div class="row g-4">
        <?php if (!empty($alat)): ?>
            <?php foreach ($alat as $a): ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="alat-card h-100">
                        <div class="img-wrapper">
                            <span class="badge-kategori shadow-sm">
                                <i class="bi bi-tag-fill me-1"></i> <?= $a->nama_kategori ?>
                            </span>

                            <?php if ($a->stok <= 0): ?>
                                <div class="out-of-stock-overlay">
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Habis Terjual</span>
                                </div>
                            <?php endif; ?>

                            <img src="https://placehold.co/400x300?text=<?= urlencode($a->nama_alat) ?>" class="alat-img"
                                alt="<?= $a->nama_alat ?>">
                        </div>

                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-2"><?= $a->nama_alat ?></h5>
                            <p class="text-muted small mb-4">
                                <?= substr($a->deskripsi ?? 'Tidak ada deskripsi alat.', 0, 70) ?>...
                            </p>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="stok-info <?= ($a->stok > 0) ? 'text-success' : 'text-danger' ?>">
                                    <i class="bi <?= ($a->stok > 0) ? 'bi-check2-circle' : 'bi-x-circle' ?> me-1"></i>
                                    Stok: <?= $a->stok ?> Unit
                                </div>
                            </div>

                            <a href="<?= ($a->stok > 0) ? base_url('peminjam/detail/' . $a->id_alat) : 'javascript:void(0)' ?>"
                                class="btn btn-detail <?= ($a->stok <= 0) ? 'disabled' : '' ?>" <?php if ($a->stok <= 0)
                                            echo 'aria-disabled="true" style="pointer-events: none;"'; ?>>
                                <i class="bi bi-cart-plus me-2"></i> <?= ($a->stok > 0) ? 'Pinjam Sekarang' : 'Stok Kosong' ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <img src="https://illustrations.popsy.co/white/shrugging-man.svg" style="width: 200px;" alt="empty">
                <h4 class="text-muted mt-4">Yah, belum ada alat yang tersedia...</h4>
            </div>
        <?php endif; ?>
    </div>
</div>