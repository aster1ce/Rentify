<!DOCTYPE html>
<html>

<head>
    <title>Login - Rentify</title>
</head>

<body style="font-family: Arial; display: flex; justify-content: center; margin-top: 100px;">
    <div style="width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
        <h2 style="text-align: center;">RENTIFY LOGIN</h2>

        <p style="color: red; text-align: center;"><?= $this->session->flashdata('error'); ?></p>

        <form action="<?php echo base_url('index.php/auth/proses_login'); ?>" method="post">
            <label>Username</label><br>
            <input type="text" name="username" style="width: 100%; margin-bottom: 10px;" required><br>

            <label>Password</label><br>
            <input type="password" name="password" style="width: 100%; margin-bottom: 20px;" required><br>

            <button type="submit" style="width: 100%; padding: 10px; cursor: pointer;">Login</button>
        </form>
    </div>
</body>

</html>