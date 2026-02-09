<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f7f6;
    }

    .content-wrapper {
        margin-left: 260px; /* Jarak agar tidak tertutup sidebar biru */
        padding: 40px;
    }

    /* Tema Green Elegant */
    .card-custom {
        border: none;
        border-radius: 15px;
        color: white;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .card-custom:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .bg-green-elegant {
        background: linear-gradient(45deg, #1e5631, #2d8a4e);
    }

    .bg-green-soft {
        background: linear-gradient(45deg, #4caf50, #81c784);
    }

    .bg-dark-elegant {
        background: linear-gradient(45deg, #2c3e50, #4ca1af);
    }

    .stat-icon {
        position: absolute;
        right: 20px;
        bottom: 20px;
        font-size: 3rem;
        opacity: 0.2;
    }

    .tips-box {
        border-left: 5px solid #1e5631;
        background-color: #fff;
        border-radius: 10px;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="mb-5">
            <h2 class="fw-bold text-dark">Dashboard Petugas</h2>
            <p class="text-muted">Manajemen peminjaman alat dengan gaya elegan.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-custom bg-green-elegant shadow h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase mb-2" style="letter-spacing: 1px;">Pengajuan Pending</h6>
                        <h1 class="display-4 fw-bold mb-0"><?= $total_pending ?></h1>
                        <div class="stat-icon">📥</div>
                        <a href="<?= base_url('petugas/validasi') ?>" class="btn btn-light btn-sm mt-4 fw-bold text-success rounded-pill px-4">
                            Cek Validasi
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom bg-green-soft shadow h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase mb-2" style="letter-spacing: 1px;">Koleksi Alat</h6>
                        <h1 class="display-4 fw-bold mb-0"><?= $total_alat ?></h1>
                        <div class="stat-icon">🛠️</div>
                        <p class="mt-4 small opacity-75">Tersedia dalam database</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom bg-dark-elegant shadow h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase mb-2" style="letter-spacing: 1px;">Sedang Dipinjam</h6>
                        <h1 class="display-4 fw-bold mb-0"><?= $total_pinjam ?></h1>
                        <div class="stat-icon">📦</div>
                        <p class="mt-4 small opacity-75">Barang di tangan user</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 p-4 tips-box shadow-sm">
            <h5 class="fw-bold text-success">Tips Petugas 💡</h5>
            <ul class="mb-0 mt-2 text-secondary">
                <li>Klik tombol <strong>Cek Validasi</strong> untuk menyetujui atau menolak pengajuan baru.</li>
                <li>Pastikan stok alat dicek kembali setelah barang dikembalikan oleh user.</li>
            </ul>
        </div>
    </div>
</div>