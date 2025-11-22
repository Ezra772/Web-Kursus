<?php
require 'config.php';

$error = "";

// hanya jalan kalau tombol login ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ambil data form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // cek user
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);

        // password plain text untuk tugas
        if ($password === $user['password']) {
            $_SESSION['user_id']      = $user['id'];
            $_SESSION['username']     = $user['username'];
            $_SESSION['role']         = $user['role'];
            $_SESSION['mahasiswa_id'] = $user['mahasiswa_id'];

            if ($user['role'] === 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: mhs/index.php');
            }
            exit;

        } else {
            $error = "Password salah.";
        }

    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Pendaftaran Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="full-height-center">
    <div class="card" style="width: 100%; max-width: 360px;">
        <h2 style="text-align:center; margin-bottom:16px;">Login</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button class="btn btn-primary" style="width:100%; margin-top:4px;">Masuk</button>
        </form>

        <p style="text-align:center; margin-top:10px; font-size:13px;">
            Belum punya akun?
            <a href="register.php">Daftar sebagai mahasiswa</a>
        </p>

        <p style="text-align:center; margin-top:6px; font-size:12px; color:#6b7280;">
            © <?php echo date('Y'); ?> Pendaftaran Course
        </p>

    </div>
</div>
</body>
</html>
