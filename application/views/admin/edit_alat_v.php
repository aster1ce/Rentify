<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
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
    }

    .form-container {
        padding: 30px;
    }

    .form-card {
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        border: none;
        max-width: 700px;
        margin: 0 auto;
    }

    .form-title {
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -1px;
        margin-bottom: 5px;
    }

    .form-label {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        margin-bottom: 8px;
        margin-top: 15px;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 12px 18px;
        border: 2px solid #f1f5f9;
        font-weight: 600;
        color: var(--text-dark);
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--green-elegant);
        box-shadow: none;
        background-color: #fff;
    }

    .btn-update {
        background: var(--green-elegant);
        color: white;
        padding: 14px 24px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        width: 100%;
        margin-top: 30px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-update:hover {
        background: #153e23;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 86, 49, 0.2);
    }

    .btn-cancel {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #94a3b8;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-cancel:hover {
        color: #ef4444;
    }

    .input-group-text {
        background: #f8fafc;
        border: 2px solid #f1f5f9;
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: #94a3b8;
    }

    .has-icon .form-control,
    .has-icon .form-select {
        border-radius: 0 12px 12px 0;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="mb-4">
            <h2 class="form-title">Edit Data Alat</h2>
            <p class="text-muted small">ID Alat: <span
                    class="badge bg-light text-dark border">#<?= $alat['id_alat'] ?></span></p>
        </div>

        <form action="<?= base_url('alat/proses_edit_alat') ?>" method="post">
            <input type="hidden" name="id_alat" value="<?= $alat['id_alat'] ?>">

            <div class="mb-3">
                <label class="form-label">Nama Alat</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                    <input type="text" name="nama_alat" class="form-control" value="<?= $alat['nama_alat'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="bi bi-grid-fill"></i></span>
                    <select name="id_kategori" class="form-select" required>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori'] ?>" <?= ($k['id_kategori'] == $alat['id_kategori']) ? 'selected' : '' ?>>
                                <?= $k['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok Saat Ini</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="bi bi-box-seam-fill"></i></span>
                    <input type="number" name="stok" class="form-control" value="<?= $alat['stok'] ?>" min="0" required>
                </div>
            </div>

            <button type="submit" class="btn-update">
                <i class="bi bi-save2-fill"></i> Simpan Perubahan
            </button>

            <a href="<?= base_url('alat/index/alat') ?>" class="btn-cancel">
                Batal & Kembali
            </a>
        </form>
    </div>
</div>