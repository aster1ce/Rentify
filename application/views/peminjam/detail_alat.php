<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        overflow-x: hidden;
    }


    .main-container {
        margin-left: 260px;
        padding: 20px;
        width: calc(100% - 260px);

    }

    /* Biar card detail gak terlalu lebar */
    .detail-card {
        max-width: 1000px;
        margin: 0 auto;
    }
</style>

<div class="main-container">
    <div class="container-fluid">
        <div class="card shadow detail-card border-0">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="https://placehold.co/500x500?text=<?= urlencode($item->nama_alat) ?>"
                        class="img-fluid rounded-start w-100">
                </div>
                <div class="col-md-7">
                    <div class="card-body p-4">
                        <h2 class="fw-bold"><?= $item->nama_alat ?></h2>
                        <span class="badge bg-info mb-3">Tersedia: <?= $item->stok ?> Unit</span>
                        <p class="text-muted"><?= $item->deskripsi ?? 'Alat ini belum ada deskripsinya.' ?></p>
                        <hr>

                        <form action="<?= base_url('peminjam/ajukan_pinjam') ?>" method="post">
                            <input type="hidden" name="id_alat" value="<?= $item->id_alat ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Pinjam (Tersedia: <?= $item->stok ?>)</label>
                                    <input type="number" id="jumlah_input" name="jumlah" class="form-control" min="1"
                                        max="<?= $item->stok ?>" oninput="validasiStok(this)"
                                        onkeydown="return blockInvalidChars(event)" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tgl Kembali</label>
                                    <input type="date" name="tgl_kembali" class="form-control" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100 btn-lg shadow-sm">🚀 Ajukan
                                Peminjaman</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function validasiStok(input) {
    let max = parseInt(input.getAttribute('max'));
    let val = parseInt(input.value);
    
    // Jika inputan manual melebihi stok, paksa balik ke angka stok
    if (val > max) {
        input.value = max;
    }
    // Jika inputan nol atau negatif, paksa jadi 1
    if (val < 1) {
        input.value = 1;
    }
}

function blockInvalidChars(event) {
    // Blokir huruf 'e', '+', '-', dan titik/koma (biar gak desimal)
    return ['e', 'E', '+', '-', '.', ','].includes(event.key) ? false : true;
}
</script>