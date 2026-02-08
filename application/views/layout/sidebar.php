<style>
    body { margin: 0; display: flex; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .sidebar { width: 250px; height: 100vh; background-color: #1e293b; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
    .sidebar h2 { text-align: center; color: #38bdf8; margin-bottom: 30px; font-weight: bold; }
    .sidebar a { padding: 15px 25px; text-decoration: none; color: #cbd5e1; display: block; transition: 0.3s; font-size: 14px; }
    .sidebar a:hover { background-color: #334155; color: white; border-left: 4px solid #38bdf8; }
    .sidebar .logout { color: #f87171; margin-top: 50px; }
    .sidebar .logout:hover { background-color: #450a0a; }
    .main-container { margin-left: 250px; padding: 40px; width: 100%; min-height: 100vh; background-color: #f8fafc; box-sizing: border-box; }
</style>

<div class="sidebar">
    <h2>RENTIFY</h2>
    
    <?php if ($this->session->userdata('role') == 'admin_staff') : ?>
        <a href="<?= base_url('admin/dashboard') ?>">📊 Dashboard Admin</a>
        <a href="<?= base_url('alat') ?>">📦 Kelola Alat</a>
        <a href="#">📑 Data Peminjaman</a>
        <a href="#">👥 Management User</a>
        
    <?php else : ?>
        <a href="<?= base_url('user/dashboard') ?>">🏠 Dashboard Siswa</a>
        <a href="#">🔍 Cari & Pinjam Alat</a>
        <a href="#">🕒 Riwayat Peminjaman</a>
        <a href="#">🔔 Notifikasi</a>
    <?php endif; ?>

    <a href="<?= base_url('auth/logout') ?>" class="logout">🚪 Keluar Aplikasi</a>
</div>

<div class="main-container">