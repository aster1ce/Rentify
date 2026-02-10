<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --hijau-utama: #1e5631;
        --hijau-muda: #e9f5ee;
        --text-abu: #64748b;
        --text-gelap: #334155;
    }

    body {
        margin: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .sidebar {
        width: 280px;
        height: 100vh;
        background: #ffffff;
        position: fixed;
        padding: 15px 20px;
        /* Padding dikecilkan biar gak terlalu turun */
        display: flex;
        flex-direction: column;
        border-right: 1px solid rgba(0, 0, 0, 0.05);
        z-index: 1000;
    }

    /* Logo Area - Jarak dirapatkan */
    .brand-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80px;
        /* Tinggi dibatasi */
        margin-top: 5px;
        margin-bottom: 5px;
        overflow: hidden;
    }

    .brand-logo-img {
        width: 140px;
        /* Ukuran pas */
        height: auto;
        object-fit: contain;
        /* Jika file gambar punya whitespace, scale ini akan menariknya keluar */
        transform: scale(1.3);
        transition: transform 0.3s ease;
    }

    /* Menu Styling */
    .menu-label {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        margin: 15px 0 10px 15px;
        /* Jarak antar label menu rapat */
        letter-spacing: 1px;
    }

    .nav-list {
        display: flex;
        flex-direction: column;
        gap: 5px;
        /* Jarak antar item menu rapat */
    }

    .nav-item {
        text-decoration: none !important;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        color: var(--text-abu);
        font-weight: 600;
        font-size: 15px;
        border-radius: 14px;
        transition: all 0.2s ease;
    }

    /* Active State */
    .nav-item.active {
        background-color: var(--hijau-utama);
        color: white !important;
        box-shadow: 0 4px 12px rgba(30, 86, 49, 0.15);
    }

    .nav-item:hover:not(.active) {
        background-color: var(--hijau-muda);
        color: var(--hijau-utama);
    }

    /* User Card Bottom */
    .user-card {
        margin-top: auto;
        padding: 12px;
        background: #f8fafc;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #f1f5f9;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--hijau-utama);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .logout-btn {
        margin-top: 10px;
        color: #ef4444;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none !important;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        border-radius: 14px;
    }

    .logout-btn:hover {
        background: #fef2f2;
    }

    .main-container {
        margin-left: 280px;
        padding: 30px;
        width: calc(100% - 280px);
    }
</style>

<div class="sidebar">
    <div class="brand-section">
        <a href="<?= base_url() ?>">
            <img src="<?= base_url('assets/img/Rentify.png') ?>" alt="Logo" class="brand-logo-img">
        </a>
    </div>

    <div class="nav-list">
        <?php
        $current_page = $this->uri->segment(2);
        $role_page = $this->uri->segment(1);
        ?>

        <?php if ($this->session->userdata('role') == 'admin'): ?>
            <div class="menu-label">Master Admin</div>
            <a href="<?= base_url('admin/dashboard') ?>"
                class="nav-item <?= ($current_page == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-grid"></i> Dashboard
            </a>
            <a href="<?= base_url('alat') ?>" class="nav-item <?= ($role_page == 'alat') ? 'active' : '' ?>">
                <i class="bi bi-box"></i> Kelola Alat
            </a>

        <?php elseif ($this->session->userdata('role') == 'petugas'): ?>
            <div class="menu-label">Petugas Area</div>
            <a href="<?= base_url('petugas/dashboard') ?>"
                class="nav-item <?= ($current_page == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('petugas/validasi') ?>"
                class="nav-item <?= ($current_page == 'validasi') ? 'active' : '' ?>">
                <i class="bi bi-shield-check"></i> Validasi
            </a>

        <?php else: ?>
            <div class="menu-label">Menu Peminjam</div>
            <a href="<?= base_url('peminjam/dashboard') ?>"
                class="nav-item <?= ($current_page == 'dashboard' || $current_page == '') ? 'active' : '' ?>">
                <i class="bi bi-house-door"></i> Beranda
            </a>
            <a href="<?= base_url('peminjam/katalog') ?>"
                class="nav-item <?= ($current_page == 'katalog' || $current_page == 'detail_alat') ? 'active' : '' ?>">
                <i class="bi bi-bag"></i> Pinjam Alat
            </a>
            <a href="<?= base_url('peminjam/riwayat') ?>"
                class="nav-item <?= ($current_page == 'riwayat') ? 'active' : '' ?>">
                <i class="bi bi-clock-history"></i> Riwayat
            </a>
            <a href="<?= base_url('peminjam/denda') ?>" class="nav-item <?= ($current_page == 'denda') ? 'active' : '' ?>">
                <i class="bi bi-exclamation-circle"></i> Denda Saya
            </a>
        <?php endif; ?>
    </div>

    <div class="user-card">
        <div class="user-avatar"><i class="bi bi-person"></i></div>
        <div class="user-info">
            <span><?= $this->session->userdata('username') ?></span>
            <small><?= ucfirst($this->session->userdata('role')) ?></small>
        </div>
    </div>

    <a href="<?= base_url('auth/logout') ?>" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i> Keluar
    </a>
</div>

<div class="main-container">