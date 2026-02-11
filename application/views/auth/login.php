<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rentify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --hijau-elegant: #1e5631;
            --hijau-hover: #153e23;
            --abu-tua: #2d3436;
            --abu-muda: #f8f9fa;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--abu-muda);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border: none;
            border-radius: 24px;
            /* Lebih membulat biar modern */
            background-color: #ffffff;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
        }

        /* Container Logo Baru */
        .login-logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90px;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .login-logo-img {
            width: 100px;
            /* Sedikit lebih besar untuk halaman login */
            height: auto;
            object-fit: contain;
            transform: scale(1.4);
            /* Mengatasi whitespace gambar */
        }

        .login-header p {
            color: #636e72;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: var(--abu-tua);
            font-size: 0.85rem;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #fcfcfc;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--hijau-elegant);
            box-shadow: 0 0 0 4px rgba(30, 86, 49, 0.08);
            background-color: #fff;
        }

        .btn-login {
            background-color: var(--hijau-elegant);
            color: white;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            background-color: var(--hijau-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(30, 86, 49, 0.2);
            color: white;
        }

        .error-msg {
            background-color: #fff5f5;
            color: #e74c3c;
            padding: 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 25px;
            border-left: 4px solid #e74c3c;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-logo-container">
            <img src="<?= base_url('assets/img/Rentify.png') ?>" alt="Rentify Logo" class="login-logo-img">
        </div>

        <div class="login-header text-center">
            <p>Silakan masuk untuk mengelola peminjaman</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="error-msg text-center">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo base_url('index.php/auth/proses_login'); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required
                    autocomplete="off">
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-login w-100 shadow-sm">Masuk Sekarang</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>