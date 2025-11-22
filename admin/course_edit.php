<?php
require '../auth_admin.php';
$id = (int) $_GET['id'];
$q  = mysqli_query($conn, "SELECT * FROM course WHERE id=$id");
$c  = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
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
        <h3 style="margin-bottom:12px;">Edit Course</h3>
        <form action="course_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $c['id']; ?>">

            <label>Nama Course</label>
            <input type="text" name="nama_course" value="<?php echo $c['nama_course']; ?>" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi"><?php echo $c['deskripsi']; ?></textarea>

            <label>Level</label>
            <input type="text" name="level" value="<?php echo $c['level']; ?>">

            <label>Harga</label>
            <input type="number" name="harga" value="<?php echo $c['harga']; ?>">

            <button class="btn btn-primary">Update</button>
            <a href="course_index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
