<div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2>Tambah Alat Baru</h2>
    <form action="<?= base_url('alat/proses_tambah') ?>" method="post">
        <label>Nama Alat</label><br>
        <input type="text" name="nama_alat" required style="width: 100%; padding: 10px; margin: 10px 0;"><br>

        <label>Kategori</label><br>
        <select name="id_kategori" required style="width: 100%; padding: 10px; margin: 10px 0;">
            <?php foreach($kategori as $k) : ?>
                <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Stok</label><br>
        <input type="number" name="stok" required style="width: 100%; padding: 10px; margin: 10px 0;"><br>

        <button type="submit" style="background: #10b981; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
            💾 Simpan Alat
        </button>
    </form>
</div>