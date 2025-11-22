<?php
require 'config.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);
        if ($password === $user['password']) {
            $_SESSION['user_id']      = $user['id'];
            $_SESSION['username']     = $user['username'];
            $_SESSION['role']         = $user['role'];
            $_SESSION['mahasiswa_id'] = $user['mahasiswa_id'];

            if ($user['role'] === 'admin') header('Location: admin/index.php');
            else header('Location: mhs/index.php');
            exit;
        } else { $error = "Password salah."; }
    } else { $error = "Username tidak ditemukan."; }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - EduNext</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="full-height-center">
    <div class="card" style="width: 100%; max-width: 400px; padding: 40px;">
        <div style="text-align:center; margin-bottom:24px;">
            <h1 style="color:var(--primary); font-weight:800; margin-bottom:8px;">EduNext</h1>
            <p style="color:var(--text-muted);">Masuk untuk melanjutkan belajar</p>
        </div>

        <?php if ($error): ?>
            <div class="badge badge-danger" style="display:block; text-align:center; margin-bottom:16px; padding:10px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button class="btn btn-primary" style="width:100%; padding:12px; margin-top:8px;">Masuk Sekarang</button>
        </form>

        <p style="text-align:center; margin-top:20px; font-size:14px;">
            Belum punya akun?
            <a href="register.php" style="color:var(--primary); font-weight:600; text-decoration:none;">Daftar di sini</a>
        </p>
    </div>
</div>
</body>
</html>