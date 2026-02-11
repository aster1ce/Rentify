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
        max-width: 600px;
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
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 18px;
        border: 2px solid #f1f5f9;
        font-weight: 600;
        color: var(--text-dark);
        transition: all 0.3s ease;
    }

    .form-control:focus {
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
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-update:hover {
        background: #153e23;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 86, 49, 0.2);
    }

    .btn-back-link {
        color: #64748b;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: 0.3s;
        margin-left: 20px;
    }

    .btn-back-link:hover {
        color: var(--green-elegant);
    }

    .input-group-text {
        background: #f8fafc;
        border: 2px solid #f1f5f9;
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: #94a3b8;
    }

    .has-icon .form-control {
        border-radius: 0 12px 12px 0;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="mb-4">
            <h2 class="form-title">Edit Kategori</h2>
            <p class="text-muted small">Perbarui nama kategori untuk mengorganisir alat dengan lebih baik.</p>
        </div>

        <form action="<?= base_url('alat/proses_edit_kategori') ?>" method="post">
            <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">

            <div class="mb-4">
                <label class="form-label">Nama Kategori</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                    <input type="text" name="nama_kategori" class="form-control" 
                           value="<?= $kategori['nama_kategori'] ?>" required>
                </div>
            </div>

            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn-update">
                    <i class="bi bi-save-fill"></i> Simpan Perubahan
                </button>
                <a href="<?= base_url('alat/index/kategori') ?>" class="btn-back-link">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>