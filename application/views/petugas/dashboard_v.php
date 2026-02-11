<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
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

    /* KALIBRASI POSISI: Hapus margin-left 260px agar pas mengikuti pembungkus utama */
    .dashboard-container {
        padding: 30px;
    }

    .page-title {
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -1px;
    }

    /* Card Styling */
    .card-custom {
        border: none;
        border-radius: 24px;
        color: white;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        min-height: 200px;
    }

    .card-custom:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1) !important;
    }

    /* Gradient Themes */
    .bg-green-elegant {
        background: linear-gradient(135deg, #1e5631 0%, #2d8a4e 100%);
    }

    .bg-green-soft {
        background: linear-gradient(135deg, #4caf50 0%, #81c784 100%);
    }

    .bg-dark-elegant {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    }

    .stat-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 6rem;
        opacity: 0.15;
        transform: rotate(-15deg);
    }

    .card-label {
        text-transform: uppercase;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        opacity: 0.9;
    }

    .card-value {
        font-size: 3.5rem;
        font-weight: 800;
        margin: 10px 0;
    }

    /* Tips Box */
    .tips-box {
        border: none;
        background-color: #ffffff;
        border-radius: 20px;
        padding: 25px;
        border-left: 6px solid var(--green-elegant);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }

    .btn-action {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: white;
        backdrop-filter: blur(10px);
        border-radius: 12px;
        font-weight: 700;
        padding: 8px 20px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-action:hover {
        background: white;
        color: var(--green-elegant);
    }
</style>

<div class="dashboard-container">
    <div class="container-fluid p-0">
        <div class="mb-5">
            <h2 class="page-title mb-1">👋 Dashboard Petugas</h2>
            <p class="text-muted">Selamat datang kembali! Mari kelola peminjaman hari ini.</p>
        </div>

        <div class="row g-4">
            <div class="col-xl-4 col-md-6">
                <div class="card card-custom bg-green-elegant shadow-sm h-100">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <span class="card-label">Pengajuan Pending</span>
                            <h1 class="card-value"><?= $total_pending ?></h1>
                        </div>
                        <div class="stat-icon"><i class="bi bi-download"></i></div>
                        <div>
                            <a href="<?= base_url('petugas/validasi') ?>" class="btn-action">
                                <i class="bi bi-shield-check me-2"></i>Cek Validasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card card-custom bg-green-soft shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="card-label">Koleksi Alat</span>
                        <h1 class="card-value"><?= $total_alat ?></h1>
                        <div class="stat-icon"><i class="bi bi-tools"></i></div>
                        <p class="mb-0 small fw-bold opacity-75">Unit terdaftar di database</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card card-custom bg-dark-elegant shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="card-label">Sedang Dipinjam</span>
                        <h1 class="card-value"><?= $total_pinjam ?></h1>
                        <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
                        <p class="mb-0 small fw-bold opacity-75">Barang dalam penguasaan user</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <div class="tips-box">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-lightbulb-fill text-warning me-2"></i>Panduan Cepat Petugas
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex align-items-top">
                                <i class="bi bi-check2-circle text-success me-2 mt-1"></i>
                                <span>Gunakan menu <b>Validasi</b> untuk meninjau permintaan peminjaman yang
                                    masuk.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex align-items-top">
                                <i class="bi bi-check2-circle text-success me-2 mt-1"></i>
                                <span>Pastikan kondisi alat diperiksa saat status berubah menjadi <b>Selesai</b>.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>