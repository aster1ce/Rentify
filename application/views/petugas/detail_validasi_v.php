<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .detail-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background: white;
    }

    .label-custom {
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .value-custom {
        color: #1e293b;
        font-weight: 600;
        font-size: 1.1rem;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-800 mb-0">Detail Pengajuan</h2>
                    <p class="text-muted small">ID Transaksi: #<?= $d->id_pinjam ?></p>
                </div>
                <a href="<?= base_url($back_url) ?>" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="detail-card p-5">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="mb-4">
                            <label class="label-custom">Nama Peminjam</label>
                            <div class="value-custom"><?= $d->nama_lengkap ?></div>
                            <small class="text-muted"><?= $d->username ?></small>
                        </div>
                        <div class="mb-4">
                            <label class="label-custom">Status Saat Ini</label>
                            <div>
                                <span
                                    class="badge bg-<?= ($d->status == 'pending') ? 'warning' : 'primary' ?> px-3 py-2">
                                    <?= strtoupper($d->status) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4 text-md-end">
                        <div class="mb-4">
                            <label class="label-custom">Alat yang Dipinjam</label>
                            <div class="value-custom text-success"><?= $d->nama_alat ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="label-custom">Jumlah Unit</label>
                            <div class="value-custom"><?= $d->jumlah_pinjam ?> Unit</div>
                            <small class="text-info">Tersedia di gudang: <?= $d->stok_gudang ?> unit</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-50">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="label-custom">Tanggal Pinjam</label>
                        <div class="value-custom"><?= date('d F Y', strtotime($d->tgl_pinjam)) ?></div>
                    </div>
                    <div class="col-md-6 mb-3 text-md-end">
                        <label class="label-custom">Estimasi Pengembalian</label>
                        <div class="value-custom text-danger"><?= date('d F Y', strtotime($d->tgl_kembali)) ?></div>
                    </div>
                </div>

                <div class="mt-5 p-4 bg-light rounded-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-1">Konfirmasi Tindakan</h6>
                        <p class="small text-muted mb-0">Pastikan alat fisik sudah diperiksa/tersedia.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <?php if ($d->status == 'pending'): ?>
                            <a href="<?= base_url('petugas/setujui/' . $d->id_pinjam) ?>"
                                class="btn btn-success px-4 rounded-3 fw-bold">SETUJUI</a>
                            <a href="<?= base_url('petugas/tolak/' . $d->id_pinjam) ?>"
                                class="btn btn-outline-danger px-4 rounded-3"
                                onclick="return confirm('Tolak pengajuan ini?')">TOLAK</a>
                        <?php elseif ($d->status == 'approved' || $d->status == 'menunggu_validasi'): ?>
                            <a href="<?= base_url('petugas/kembali/' . $d->id_pinjam) ?>"
                                class="btn btn-primary px-4 rounded-3 fw-bold">KONFIRMASI KEMBALI</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>