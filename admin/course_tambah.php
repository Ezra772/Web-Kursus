<?php
require '../auth_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Course - EduNext</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">EduNext Admin</div>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="mahasiswa_index.php">Data Mahasiswa</a>
            <a href="course_index.php" style="color:var(--primary);">Data Course</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h3 style="margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:10px;">Tambah Course Baru</h3>
        
        <form action="course_simpan.php" method="POST">
            <label>Nama Course</label>
            <input type="text" name="nama_course" placeholder="Contoh: Fullstack Web Developer" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi" placeholder="Jelaskan detail materi yang akan dipelajari..." style="height:100px;"></textarea>
            
            <label>URL Gambar (Link Foto)</label>
            <input type="url" name="gambar_url" placeholder="https://contoh.com/gambar.jpg" required>
            <p style="font-size:12px; color:#64748b; margin-top:-10px; margin-bottom:16px;">
                *Salin link gambar dari Google atau hosting gambar lain.
            </p>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div>
                    <label>Level</label>
                    <select name="level" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px;">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
                <div>
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" min="0" value="0">
                </div>
            </div>

            <div style="margin-top:20px;">
                <button class="btn btn-primary">Simpan Course</button>
                <a href="course_index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>