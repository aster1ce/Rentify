<style>
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
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

    input,
    select {
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
        width: 100%;
        margin-top: 10px;
    }
</style>

<div class="form-container">
    <h2>Edit Data Alat</h2>
    <form action="<?= base_url('alat/proses_edit_alat') ?>" method="post">
        <input type="hidden" name="id_alat" value="<?= $alat['id_alat'] ?>">

        <div class="form-group">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat" value="<?= $alat['nama_alat'] ?>" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>" <?= ($k['id_kategori'] == $alat['id_kategori']) ? 'selected' : '' ?>>
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $alat['stok'] ?>" required>
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>
        <a href="<?= base_url('alat/index/alat') ?>"
            style="display:block; text-align:center; margin-top:10px; color:#64748b; text-decoration:none;">Batal</a>
    </form>
</div>