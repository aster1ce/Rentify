<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --hijau-utama: #1e5631;
        --hijau-muda: #e9f5ee;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --sidebar-bg: #ffffff;
    }

    body {
        margin: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    /* Sidebar Container */
    .sidebar {
        width: 280px;
        height: 100vh;
        background-color: var(--sidebar-bg);
        position: fixed;
        top: 0;
        left: 0;
        padding: 20px 15px;
        z-index: 1000;
        border-right: 1px solid rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.02);
    }

    /* Brand Logo Section */
    .brand-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80px;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .brand-logo-img {
        width: 100px;
        height: auto;
        object-fit: contain;
        transform: scale(1.3);
        filter: drop-shadow(0 4px 4px rgba(0, 0, 0, 0.03));
    }

    /* Menu Container */
    .sidebar-menu {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px 5px;
    }

    .menu-label {
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 800;
        color: #adb5bd;
        letter-spacing: 1.2px;
        margin: 20px 0 10px 12px;
        display: block;
    }

    /* Item Navigasi - Force Style */
    .sidebar .nav-link {
        padding: 14px 18px !important;
        text-decoration: none !important;
        color: var(--text-muted) !important;
        display: flex !important;
        align-items: center !important;
        gap: 15px !important;
        border-radius: 14px !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        margin-bottom: 6px !important;
        border: 1px solid transparent !important;
    }

    .sidebar .nav-link i {
        font-size: 1.3rem !important;
        color: #94a3b8 !important;
        transition: color 0.2s ease;
    }

    /* Hover Effect */
    .sidebar .nav-link:hover {
        background-color: var(--hijau-muda) !important;
        color: var(--hijau-utama) !important;
        transform: translateX(5px);
    }

    .sidebar .nav-link:hover i {
        color: var(--hijau-utama) !important;
    }

    /* Active State */
    .sidebar .nav-link.active {
        background-color: var(--hijau-utama) !important;
        color: white !important;
        box-shadow: 0 10px 15px rgba(30, 86, 49, 0.2) !important;
    }

    .sidebar .nav-link.active i {
        color: white !important;
    }

    /* Footer & User Profile */
    .sidebar-footer {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }

    .user-profile {
        background: #f8fafc;
        padding: 12px 15px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        border: 1px solid #f1f5f9;
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        background: var(--hijau-utama);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .user-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .user-role {
        font-size: 11px;
        color: var(--text-muted);
    }

    /* Logout Button */
    .logout-btn {
        padding: 14px 18px !important;
        color: #ef4444 !important;
        text-decoration: none !important;
        display: flex !important;
        align-items: center !important;
        gap: 15px !important;
        border-radius: 14px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: 0.2s ease !important;
    }

    .logout-btn:hover {
        background-color: #fef2f2 !important;
    }

    /* Container Utama */
    .main-container {
        margin-left: 280px;
        padding: 40px;
        width: calc(100% - 280px);
        min-height: 100vh;
        box-sizing: border-box;
    }
</style>

<div class="sidebar">
    <div class="brand-section">
        <a href="<?= base_url() ?>">
            <img src="<?= base_url('assets/img/Rentify.png') ?>" alt="Logo" class="brand-logo-img">
        </a>
    </div>

    <div class="sidebar-menu">
        <?php
        $current = $this->uri->segment(2);
        $role = $this->session->userdata('role');
        ?>

        <?php if ($role == 'admin'): ?>
            <span class="menu-label">Menu Admin</span>
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($current == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="<?= base_url('alat') ?>" class="nav-link <?= ($this->uri->segment(1) == 'alat') ? 'active' : '' ?>">
                <i class="bi bi-archive-fill"></i> Kelola Alat
            </a>
            <a href="#" class="nav-link"><i class="bi bi-file-earmark-text-fill"></i> Data Peminjaman</a>
            <a href="#" class="nav-link"><i class="bi bi-people-fill"></i> Management User</a>

        <?php elseif ($role == 'petugas'): ?>
            <span class="menu-label">Menu Petugas</span>
            <a href="<?= base_url('petugas/dashboard') ?>"
                class="nav-link <?= ($current == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('petugas/validasi') ?>" class="nav-link <?= ($current == 'validasi') ? 'active' : '' ?>">
                <i class="bi bi-patch-check-fill"></i> Validasi
            </a>
            <a href="<?= base_url('petugas/denda') ?>" class="nav-link <?= ($current == 'denda') ? 'active' : '' ?>">
                <i class="bi bi-cash-stack"></i> Kelola Denda
            </a>
            <a href="<?= base_url('petugas/riwayat') ?>" class="nav-link <?= ($current == 'riwayat') ? 'active' : '' ?>">
                <i class="bi bi-clock-history"></i> Riwayat Peminjaman
            </a>

        <?php else: ?>
            <span class="menu-label">Menu Peminjam</span>
            <a href="<?= base_url('peminjam/dashboard') ?>"
                class="nav-link <?= ($current == 'dashboard' || $current == '') ? 'active' : '' ?>">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            <a href="<?= base_url('peminjam/katalog') ?>" class="nav-link <?= ($current == 'katalog') ? 'active' : '' ?>">
                <i class="bi bi-search-heart-fill"></i> Cari & Pinjam
            </a>
            <a href="<?= base_url('peminjam/riwayat') ?>" class="nav-link <?= ($current == 'riwayat') ? 'active' : '' ?>">
                <i class="bi bi-hourglass-split"></i> Riwayat Saya
            </a>
            <a href="<?= base_url('peminjam/denda') ?>" class="nav-link <?= ($current == 'denda') ? 'active' : '' ?>">
                <i class="bi bi-exclamation-triangle-fill"></i> Denda Saya
            </a>
        <?php endif; ?>
    </div>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="user-details">
                <span class="user-name"><?= $this->session->userdata('username') ?></span>
                <span class="user-role"><?= ucfirst($role) ?></span>
            </div>
        </div>

        <a href="<?= base_url('auth/logout') ?>" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Keluar Aplikasi
        </a>
    </div>
</div>

<div class="main-container">