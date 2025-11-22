<?php
require '../auth_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">Admin Course</div>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="mahasiswa_index.php">Data Mahasiswa</a>
            <a href="course_index.php">Data Course</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container" style="margin-top:16px;">
    <div class="card">
        <h3 style="margin-bottom:12px;">Tambah Mahasiswa</h3>
        <form action="mahasiswa_simpan.php" method="POST">
            <label>NIM</label>
            <input type="text" name="nim" required>

            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Jurusan</label>
            <input type="text" name="jurusan">

            <label>Angkatan</label>
            <input type="number" name="angkatan" min="2000" max="2100">

            <button class="btn btn-primary">Simpan</button>
            <a href="mahasiswa_index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
