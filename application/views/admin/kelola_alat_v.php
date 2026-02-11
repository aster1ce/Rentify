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

    /* KALIBRASI POSISI: Menyesuaikan pembungkus utama admin */
    .admin-container {
        padding: 30px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -1px;
        margin: 0;
    }

    /* Navigasi Tab Modern */
    .tabs-wrapper {
        background: #ffffff;
        padding: 6px;
        border-radius: 16px;
        display: inline-flex;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        margin-bottom: 25px;
    }

    .tab-item {
        padding: 10px 24px;
        text-decoration: none;
        color: #64748b;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.3s;
    }

    .tab-item.active {
        background: var(--green-elegant);
        color: white;
    }

    /* Tombol Tambah */
    .btn-add {
        background: var(--green-elegant);
        color: white;
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        background: #153e23;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 86, 49, 0.2);
    }

    /* Tabel Styling */
    .table-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }

    .table thead th {
        background-color: #fcfcfd;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody td {
        padding: 18px 20px;
        color: var(--text-dark);
        border-bottom: 1px solid #f8fafc;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    /* Action Buttons */
    .btn-edit {
        color: #0ea5e9;
        background: #f0f9ff;
        padding: 6px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-edit:hover {
        background: #0ea5e9;
        color: white;
    }

    .btn-delete {
        color: #ef4444;
        background: #fef2f2;
        padding: 6px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    .badge-stok {
        background: #f1f5f9;
        color: #475569;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
    }
</style>

<div class="admin-container">
    <div class="container-fluid p-0">
        
        <div class="page-header">
            <div>
                <h2 class="page-title">Kelola Data Inventory</h2>
                <p class="text-muted small mb-0">Atur kategori dan daftar alat yang tersedia.</p>
            </div>
            <a href="<?= base_url('alat/tambah_' . $tab_aktif) ?>" class="btn-add">
                <i class="bi bi-plus-lg"></i> Tambah <?= ucfirst($tab_aktif) ?>
            </a>
        </div>

        <div class="tabs-wrapper">
            <a href="<?= base_url('alat/index/kategori') ?>"
                class="tab-item <?= $tab_aktif == 'kategori' ? 'active' : '' ?>">
                <i class="bi bi-grid-fill me-2"></i>Kategori
            </a>
            <a href="<?= base_url('alat/index/alat') ?>" 
                class="tab-item <?= $tab_aktif == 'alat' ? 'active' : '' ?>">
                <i class="bi bi-tools me-2"></i>Daftar Alat
            </a>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table mb-0">
                    <?php if ($tab_aktif == 'kategori'): ?>
                        <thead>
                            <tr>
                                <th class="ps-4" width="100">No</th>
                                <th>Nama Kategori</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($isi_tabel)): ?>
                                <?php $no = 1; foreach ($isi_tabel as $row): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted"><?= $no++; ?></td>
                                        <td><span class="fw-bold"><?= $row['nama_kategori']; ?></span></td>
                                        <td class="text-end pe-4">
                                            <a href="<?= site_url('alat/edit_kategori/'.$row['id_kategori']) ?>" class="btn-edit me-2">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <a href="<?= base_url('alat/hapus_kategori/' . $row['id_kategori']) ?>"
                                                onclick="return confirm('Yakin hapus kategori ini?')" class="btn-delete">
                                                <i class="bi bi-trash3 me-1"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="text-center py-5 text-muted">Data kategori masih kosong.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    <?php else: ?>
                        <thead>
                            <tr>
                                <th class="ps-4" width="80">No</th>
                                <th>Informasi Alat</th>
                                <th>Kategori</th>
                                <th class="text-center">Stok</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($isi_tabel)): ?>
                                <?php $no = 1; foreach ($isi_tabel as $row): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted"><?= $no++; ?></td>
                                        <td>
                                            <span class="fw-bold d-block"><?= $row['nama_alat']; ?></span>
                                            <small class="text-muted">ID: #<?= $row['id_alat']; ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-3 py-2"><?= $row['nama_kategori']; ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-stok"><?= $row['stok']; ?> Unit</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="<?= base_url('alat/edit_alat/' . $row['id_alat']) ?>" class="btn-edit me-2">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <a href="<?= base_url('alat/hapus_alat/' . $row['id_alat']) ?>"
                                                onclick="return confirm('Yakin mau hapus alat ini?')" class="btn-delete">
                                                <i class="bi bi-trash3 me-1"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-5 text-muted">Data alat masih kosong.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>