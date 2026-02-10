<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .content-wrapper {
        margin-left: 260px;
        padding: 40px;
        background-color: #f4f7f6;
        min-height: 100vh;
    }

    .card-table {
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

    .btn-green {
        background-color: #1e5631;
        color: white;
    }

    .btn-green:hover {
        background-color: #153e23;
        color: white;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <h2 class="fw-bold text-dark mb-4">🛡️ Validasi Pengajuan</h2>

        <ul class="nav nav-pills mb-4">
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'peminjaman') ? 'active' : '' ?>"
                    href="<?= base_url('petugas/validasi/peminjaman') ?>">Peminjaman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($tab_aktif == 'pengembalian') ? 'active' : '' ?>"
                    href="<?= base_url('petugas/validasi/pengembalian') ?>">Pengembalian</a>
            </li>
        </ul>

        <div class="card-table p-4">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th class="text-center">Status/Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ada_data = false;
                    if (!empty($transaksi)):
                        foreach ($transaksi as $t):

                            // 1. TAB PEMINJAMAN: Hanya tampilkan pengajuan baru (pending)
                            if ($tab_aktif == 'peminjaman' && $t->status == 'pending'):
                                $ada_data = true;
                                ?>
                                <tr>
                                    <td><strong><?= $t->nama_lengkap ?></strong></td>
                                    <td><?= $t->nama_alat ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('petugas/setujui/' . $t->id_pinjam) ?>"
                                            class="btn btn-sm btn-success rounded-pill px-3">Setujui</a>
                                        <a href="<?= base_url('petugas/tolak/' . $t->id_pinjam) ?>"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-3">Tolak</a>
                                    </td>
                                </tr>

                            <?php
                                // 2. TAB PENGEMBALIAN: Ubah filternya ke 'menunggu_validasi'
                            elseif ($tab_aktif == 'pengembalian' && $t->status == 'menunggu_validasi'):
                                $ada_data = true;
                                ?>
                                <tr>
                                    <td><strong><?= $t->nama_lengkap ?></strong></td>
                                    <td><?= $t->nama_alat ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark me-2">Perlu Dicek</span>
                                        <a href="<?= base_url('petugas/kembali/' . $t->id_pinjam) ?>"
                                            class="btn btn-sm btn-primary rounded-pill px-3"
                                            onclick="return confirm('Sudah cek kondisi alat? Stok akan bertambah otomatis.')">
                                            Konfirmasi Pengembalian
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endif;
                        endforeach;
                    endif;

                    if (!$ada_data): ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">Tidak ada data untuk divalidasi di tab ini.
                                ☕</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>