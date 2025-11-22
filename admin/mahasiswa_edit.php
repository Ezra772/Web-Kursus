<?php
require '../auth_admin.php';
$id = (int) $_GET['id'];
$q  = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
$m  = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
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
        <h3 style="margin-bottom:12px;">Edit Mahasiswa</h3>
        <form action="mahasiswa_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $m['id']; ?>">

            <label>NIM</label>
            <input type="text" name="nim" value="<?php echo $m['nim']; ?>" required>

            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo $m['nama']; ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo $m['email']; ?>" required>

            <label>Jurusan</label>
            <input type="text" name="jurusan" value="<?php echo $m['jurusan']; ?>">

            <label>Angkatan</label>
            <input type="number" name="angkatan" value="<?php echo $m['angkatan']; ?>">

            <button class="btn btn-primary">Update</button>
            <a href="mahasiswa_index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
