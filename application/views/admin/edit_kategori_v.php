<style>
    .form-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        max-width: 500px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #1e293b;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    .btn-save {
        background: #38bdf8;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-back {
        background: #64748b;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
    }
</style>

<div class="header-table">
    <h2>Edit Kategori</h2>
    <a href="<?= base_url('alat/index/kategori') ?>" class="btn-back">⬅ Kembali</a>
</div>

<div class="form-container">
    <h2>Edit Kategori</h2>
    <form action="<?= base_url('alat/proses_edit_kategori') ?>" method="post">
        <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">
        <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>">
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>