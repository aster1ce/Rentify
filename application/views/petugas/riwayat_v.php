<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .content-wrapper {
        margin-left: 260px;
        padding: 40px;
        background-color: #f4f7f6;
        min-height: 100vh;
    }

    .card-history {
        border: none;
        border-radius: 15px;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .nav-pills .nav-link.active {
        background-color: #1e5631 !important;
    }

    .nav-pills .nav-link {
        color: #1e5631;
        font-weight: bold;
    }

    .badge-ongoing {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .badge-finished {
        background-color: #eeeeee;
        color: #616161;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <h2 class="fw-bold text-dark mb-4">📜 Riwayat Peminjaman</h2>

        <ul class="nav nav-pills mb-4">
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'berjalan') ? 'active' : '' ?>"
                    href="<?= base_url('petugas/riwayat/berjalan') ?>">Sedang Berjalan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'ditolak') ? 'active' : '' ?>"
                    href="<?= base_url('petugas/riwayat/ditolak') ?>">Ditolak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'selesai') ? 'active' : '' ?>"
                    href="<?= base_url('petugas/riwayat/selesai') ?>">Selesai</a>
            </li>
        </ul>

        <div class="card-history p-4">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ada_data = false;
                    foreach ($riwayat as $r):
                        // Filter Status Berdasarkan Database
                        $tampilkan = false;
                        if ($tab_aktif == 'berjalan' && $r->status == 'approved')
                            $tampilkan = true;
                        if ($tab_aktif == 'ditolak' && $r->status == 'rejected')
                            $tampilkan = true;
                        if ($tab_aktif == 'selesai' && $r->status == 'selesai')
                            $tampilkan = true;

                        if ($tampilkan):
                            $ada_data = true;
                            ?>
                            <tr>
                                <td><strong><?= $r->nama_lengkap ?></strong></td>
                                <td><?= $r->nama_alat ?> <br><small class="text-muted"><?= $r->jumlah_pinjam ?> unit</small>
                                </td>
                                <td><?= date('d M Y', strtotime($r->tgl_pinjam)) ?></td>
                                <td>
                                    <?php if ($r->status == 'approved'): ?>
                                        <span class="badge bg-success">Sedang Dipinjam</span>
                                    <?php elseif ($r->status == 'selesai'): ?>
                                        <span class="badge bg-secondary">Sudah Kembali</span>
                                    <?php elseif ($r->status == 'rejected'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php
                        endif;
                    endforeach;

                    if (!$ada_data): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data di tab ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>