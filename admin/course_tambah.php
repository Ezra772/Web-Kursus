<?php
require '../auth_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Course</title>
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
        <h3 style="margin-bottom:12px;">Tambah Course</h3>
        <form action="course_simpan.php" method="POST">
            <label>Nama Course</label>
            <input type="text" name="nama_course" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi"></textarea>

            <label>Level</label>
            <input type="text" name="level" placeholder="Beginner / Intermediate / Advanced">

            <label>Harga</label>
            <input type="number" name="harga" min="0" value="0">

            <p style="font-size:12px; color:#6b7280; margin:6px 0 12px;">
                Gambar akan diambil otomatis dari folder <code>uploads/</code> berdasarkan nama course.
                Contoh: Nama course <strong>Pemrograman Web Dasar</strong> → file <strong>pemrograman_web_dasar.png</strong>.
            </p>

            <button class="btn btn-primary">Simpan</button>
            <a href="course_index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
