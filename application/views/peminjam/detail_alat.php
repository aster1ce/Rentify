<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --green-elegant: #1e5631;
        --soft-bg: #f8fafc;
        --text-dark: #1e293b;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--soft-bg);
        overflow-x: hidden;
    }

    /* KALIBRASI POSISI: Mengikuti standar Katalog & Riwayat sebelumnya */
    .detail-container {
        padding: 30px;
        min-height: 100vh;
    }

    /* Card Styling */
    .detail-card {
        max-width: 1100px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 30px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .img-section {
        background-color: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .img-section img {
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.5s ease;
    }

    .img-section img:hover {
        transform: scale(1.02);
    }

    .content-section {
        padding: 40px !important;
    }

    .badge-stok {
        background: #e9f5ee;
        color: var(--green-elegant);
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        display: inline-block;
    }

    .alat-title {
        font-weight: 800;
        font-size: 2.2rem;
        color: var(--text-dark);
        letter-spacing: -1px;
        margin-top: 15px;
    }

    .deskripsi-text {
        color: #64748b;
        line-height: 1.8;
        font-size: 1rem;
    }

    /* Form Styling */
    .form-label {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 14px;
        padding: 12px 18px;
        border: 2px solid #f1f5f9;
        font-weight: 600;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: var(--green-elegant);
        box-shadow: none;
        background-color: #fff;
    }

    .btn-submit {
        background: var(--green-elegant);
        border: none;
        border-radius: 16px;
        padding: 16px;
        font-weight: 700;
        font-size: 1.1rem;
        color: white;
        transition: all 0.3s;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: #153e23;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(30, 86, 49, 0.2);
    }

    .btn-back {
        color: #64748b;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: var(--green-elegant);
    }
</style>

<div class="detail-container">
    <a href="<?= base_url('peminjam/katalog') ?>" class="btn-back">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Katalog
    </a>

    <div class="card detail-card border-0">
        <div class="row g-0">
            <div class="col-lg-5 img-section">
                <img src="https://placehold.co/600x600/f1f5f9/1e5631?text=<?= urlencode($item->nama_alat) ?>"
                    class="img-fluid w-100 h-100 object-fit-cover shadow-sm">
            </div>

            <div class="col-lg-7 content-section">
                <div class="card-body p-0">
                    <span class="badge-stok">
                        <i class="bi bi-box-seam me-2"></i>Tersedia: <?= $item->stok ?> Unit
                    </span>
                    
                    <h1 class="alat-title"><?= $item->nama_alat ?></h1>
                    
                    <div class="mt-4 mb-4">
                        <h6 class="fw-bold text-dark">Deskripsi Alat:</h6>
                        <p class="deskripsi-text">
                            <?= $item->deskripsi ?? 'Alat ini belum memiliki deskripsi detail. Silakan hubungi admin untuk informasi lebih lanjut.' ?>
                        </p>
                    </div>

                    <hr class="my-4" style="border-top: 2px dashed #f1f5f9;">

                    <form action="<?= base_url('peminjam/ajukan_pinjam') ?>" method="post">
                        <input type="hidden" name="id_alat" value="<?= $item->id_alat ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Jumlah Pinjam</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light" style="border-radius: 14px 0 0 14px;">
                                        <i class="bi bi-plus-slash-minus"></i>
                                    </span>
                                    <input type="number" id="jumlah_input"
                                        name="jumlah" class="form-control" min="1" 
                                        max="<?= $item->stok ?>" oninput="validasiStok(this)" 
                                        onkeydown="return blockInvalidChars(event)" 
                                        placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Tanggal Pengembalian</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light" style="border-radius: 14px 0 0 14px;">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="date" name="tgl_kembali" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-submit w-100 shadow-sm">
                            <i class="bi bi-send-check me-2"></i> Ajukan Peminjaman Sekarang
                        </button>
                    </form>
                    
                    <p class="text-center text-muted small mt-4">
                        <i class="bi bi-info-circle me-1"></i> Pengajuan akan divalidasi oleh admin sebelum disetujui.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validasiStok(input) {
        let max = parseInt(input.getAttribute('max'));
        let val = parseInt(input.value);

        if (val > max) {
            input.value = max;
        }
        if (val < 1) {
            input.value = 1;
        }
    }

    function blockInvalidChars(event) {
        return ['e', 'E', '+', '-', '.', ','].includes(event.key) ? false : true;
    }
</script>