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

    /* Container - Sama persis dengan Dashboard & Katalog */
    .dashboard-container {
        padding: 20px;
        max-width: 1200px;
        /* Jika pakai sidebar fixed 260px, aktifkan margin-left ini: */
        /* margin-left: 260px; */
    }

    /* Card Styling - Mengikuti gaya Glass Card Dashboard */
    .detail-card {
        background: #ffffff;
        border-radius: 25px;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }

    .img-wrapper {
        background: #fcfcfc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        border-right: 1px solid #f1f5f9;
    }

    .img-display {
        width: 100%;
        border-radius: 20px;
        object-fit: cover;
        aspect-ratio: 1/1;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    /* Typography & Buttons - Konsisten dengan tema Elegant Green */
    .fw-800 {
        font-weight: 800;
    }

    .text-abu {
        color: #64748b;
    }

    .btn-green-modern {
        background: var(--green-elegant);
        color: white;
        border-radius: 15px;
        padding: 15px 25px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }

    .btn-green-modern:hover {
        background: var(--green-hover);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(30, 86, 49, 0.2);
    }

    .form-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.85rem;
    }

    .input-custom {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .btn-back {
        color: var(--green-elegant);
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 8px 16px;
        border-radius: 10px;
        background: rgba(30, 86, 49, 0.05);
        transition: 0.2s;
    }

    .btn-back:hover {
        background: rgba(30, 86, 49, 0.1);
    }
</style>

<div class="dashboard-container">
    <a href="<?= base_url('peminjam/katalog') ?>" class="btn-back">
        <i class="bi bi-arrow-left-short fs-4 me-1"></i> Kembali ke Katalog
    </a>

    <div class="detail-card">
        <div class="row g-0">
            <div class="col-lg-5 img-wrapper">
                <img src="https://placehold.co/600x600/f1f5f9/1e5631?text=<?= urlencode($item->nama_alat) ?>"
                    class="img-display" alt="<?= $item->nama_alat ?>">
            </div>

            <div class="col-lg-7 p-4 p-lg-5">
                <div class="mb-4">
                    <span class="badge px-3 py-2 mb-3"
                        style="background: rgba(30, 86, 49, 0.1); color: var(--green-elegant); border-radius: 10px;">
                        <i class="bi bi-box-seam me-2"></i> Stok: <?= $item->stok ?> Unit Tersedia
                    </span>
                    <h1 class="fw-800 text-dark display-6 mb-3"><?= $item->nama_alat ?></h1>
                    <p class="text-abu fs-6 leading-relaxed">
                        <?= $item->deskripsi ?? 'Belum ada deskripsi untuk alat ini.' ?>
                    </p>
                </div>

                <hr class="my-4 opacity-25">

                <form action="<?= base_url('peminjam/ajukan_pinjam') ?>" method="post">
                    <input type="hidden" name="id_barang" value="<?= $item->id_alat ?>">

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" class="form-control input-custom" min="1"
                                max="<?= $item->stok ?>" oninput="validasiStok(this)"
                                onkeydown="return blockInvalidChars(event)" placeholder="Contoh: 1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rencana Kembali</label>
                            <input type="date" name="tgl_kembali" class="form-control input-custom" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-green-modern w-100 shadow-sm">
                            <i class="bi bi-calendar-plus me-2"></i> Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validasiStok(input) {
        let max = parseInt(input.getAttribute('max'));
        let val = parseInt(input.value);
        if (val > max) input.value = max;
        if (val < 1 && input.value !== "") input.value = 1;
    }

    function blockInvalidChars(event) {
        return ['e', 'E', '+', '-', '.', ','].includes(event.key) ? false : true;
    }
</script>