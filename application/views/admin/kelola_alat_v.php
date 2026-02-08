<style>
    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 10px;
    }

    .tab-item {
        padding: 10px 20px;
        text-decoration: none;
        color: #64748b;
        border-radius: 8px;
        font-weight: bold;
    }

    .tab-item.active {
        background: #38bdf8;
        color: white;
    }

    .header-table {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .btn-add {
        background: #10b981;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    th {
        background: #f8fafc;
        color: #1e293b;
    }
</style>

<div class="header-table">
    <h2>Kelola Data Rentify</h2>
    <a href="<?= base_url('alat/tambah_' . $tab_aktif) ?>" class="btn-add">
        ➕ Tambah <?= ucfirst($tab_aktif) ?>
    </a>
</div>

<div class="tabs">
    <a href="<?= base_url('alat/index/kategori') ?>"
        class="tab-item <?= $tab_aktif == 'kategori' ? 'active' : '' ?>">Kategori</a>
    <a href="<?= base_url('alat/index/alat') ?>" class="tab-item <?= $tab_aktif == 'alat' ? 'active' : '' ?>">Alat</a>
</div>

<table>
    <?php if ($tab_aktif == 'kategori'): ?>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($isi_tabel)): ?>
                <?php $no = 1; foreach ($isi_tabel as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td>
                            <a href="<?= site_url('alat/edit_kategori/'.$row['id_kategori']) ?>">Edit</a>
                            <a href="<?= base_url('alat/hapus_kategori/' . $row['id_kategori']) ?>"
                                onclick="return confirm('Yakin hapus?')" style="color: red;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align:center;">Data kategori masih kosong.</td></tr>
            <?php endif; ?>
        </tbody>
    <?php else: ?>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($isi_tabel)): ?>
                <?php $no = 1; foreach ($isi_tabel as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_alat']; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="<?= base_url('alat/edit_alat/' . $row['id_alat']) ?>" style="color: blue;">Edit</a> |
                            <a href="<?= base_url('alat/hapus_alat/' . $row['id_alat']) ?>"
                                onclick="return confirm('Yakin mau hapus?')" style="color: red;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center;">Data alat masih kosong.</td></tr>
            <?php endif; ?>
        </tbody>
    <?php endif; ?>
</table>

</div>