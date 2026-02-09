<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="main-container">
    <div class="container-fluid">
        <h2 class="mb-4 mt-3">📦 Katalog Alat Tersedia</h2>
        <hr>

        <div class="row">
            <?php if (!empty($alat)): ?>
                <?php foreach ($alat as $a): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="https://placehold.co/300x200?text=<?= urlencode($a->nama_alat) ?>" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <span class="badge bg-info mb-2"><?= $a->nama_kategori ?></span>
                                <h5 class="card-title fw-bold"><?= $a->nama_alat ?></h5>
                                <p class="card-text text-muted small">
                                    <?= substr($a->deskripsi ?? '', 0, 60) ?>        <?= strlen($a->deskripsi ?? '') > 60 ? '...' : '' ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-success fw-bold">Stok: <?= $a->stok ?></span>
                                    <a href="<?= base_url('peminjam/detail/' . $a->id_alat) ?>"
                                        class="btn btn-primary btn-sm">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center mt-5">
                    <h4 class="text-muted">Yah, belum ada alat yang bisa dipinjam... 😅</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>