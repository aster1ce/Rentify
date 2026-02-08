<div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2 style="color: #1e293b;">Tambah Kategori Baru</h2>
    <hr style="margin-bottom: 20px; border: 0.5px solid #e2e8f0;">

    <form action="<?= base_url('alat/proses_tambah_kategori') ?>" method="post">
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; color: #64748b;">Nama Kategori</label><br>
            <input type="text" name="nama_kategori" required placeholder="Contoh: Kamera, Lensa, Tripod" 
                   style="width: 100%; padding: 12px; margin-top: 8px; border: 1px solid #cbd5e1; border-radius: 8px;">
        </div>

        <div style="margin-top: 25px;">
            <button type="submit" style="background: #10b981; color: white; padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                💾 Simpan Kategori
            </button>
            <a href="<?= base_url('alat/index/kategori') ?>" style="margin-left: 15px; color: #94a3b8; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>