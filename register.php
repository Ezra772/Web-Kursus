<?php
require 'config.php';

$error = "";
$success = "";

// proses kalau form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim      = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $jurusan  = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $angkatan = mysqli_real_escape_string($conn, $_POST['angkatan']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // validasi sederhana
    if ($password !== $confirm) {
        $error = "Konfirmasi password tidak sama.";
    } else {
        // cek username sudah dipakai atau belum
        $cekUser = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
        if (mysqli_num_rows($cekUser) > 0) {
            $error = "Username sudah digunakan, silakan pilih yang lain.";
        } else {
            // cek NIM sudah ada di tabel mahasiswa atau belum
            $cekNim = mysqli_query($conn, "SELECT id FROM mahasiswa WHERE nim = '$nim'");
            if (mysqli_num_rows($cekNim) > 0) {
                $error = "NIM sudah terdaftar. Silakan login atau hubungi admin.";
            } else {
                // 1) Insert ke mahasiswa
                $qMhs = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan)
                                             VALUES ('$nim', '$nama', '$email', '$jurusan', '$angkatan')");
                if ($qMhs) {
                    $mahasiswa_id = mysqli_insert_id($conn);

                    // 2) Insert ke users dengan role mahasiswa
                    // (untuk tugas, password disimpan plain text)
                    $role = 'mahasiswa';
                    $qUser = mysqli_query($conn, "INSERT INTO users (username, password, role, mahasiswa_id)
                                                  VALUES ('$username', '$password', '$role', $mahasiswa_id)");

                    if ($qUser) {
                        $success = "Pendaftaran berhasil. Silakan login dengan akun yang baru dibuat.";
                    } else {
                        $error = "Gagal membuat akun login: " . mysqli_error($conn);
                    }
                } else {
                    $error = "Gagal menyimpan data mahasiswa: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Pendaftaran Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="full-height-center">
    <div class="card" style="width: 100%; max-width: 420px;">
        <h2 style="text-align:center; margin-bottom:16px;">Daftar Akun Mahasiswa</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert" style="background:#dcfce7; color:#166534;"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>NIM</label>
            <input type="text" name="nim" required>

            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Jurusan</label>
            <input type="text" name="jurusan">

            <label>Angkatan</label>
            <input type="number" name="angkatan" min="2000" max="2100">

            <hr style="margin:10px 0; border:none; border-top:1px solid #e5e7eb;">

            <label>Username (untuk login)</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="confirm_password" required>

            <button class="btn btn-primary" style="width:100%; margin-top:4px;">Daftar</button>
        </form>

        <p style="text-align:center; margin-top:10px; font-size:13px;">
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </p>
    </div>
</div>
</body>
</html>
