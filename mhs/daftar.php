<?php
require '../auth_mhs.php';

$course_id = (int) $_GET['course_id'];
$q_course  = mysqli_query($conn, "SELECT * FROM course WHERE id=$course_id");
$course    = mysqli_fetch_assoc($q_course);

$mhs_id = $_SESSION['mahasiswa_id'];
$q_mhs  = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$mhs_id");
$mhs    = mysqli_fetch_assoc($q_mhs);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="navbar green">
    <div class="navbar-inner">
        <div class="navbar-brand">Mahasiswa</div>
        <div class="nav-links">
            <a href="index.php">Course</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container" style="margin-top:16px;">
    <div class="card">
        <h3 style="margin-bottom:10px;">Konfirmasi Pendaftaran</h3>

        <h4 style="margin-bottom:6px;"><?php echo htmlspecialchars($course['nama_course']); ?></h4>
        <p style="font-size:14px; margin-bottom:10px;"><?php echo nl2br(htmlspecialchars($course['deskripsi'])); ?></p>
        <p style="font-size:13px;"><strong>Nama:</strong> <?php echo htmlspecialchars($mhs['nama']); ?></p>
        <p style="font-size:13px; margin-bottom:12px;"><strong>NIM:</strong> <?php echo htmlspecialchars($mhs['nim']); ?></p>

        <form action="proses_daftar.php" method="POST">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <button class="btn btn-primary">Konfirmasi Daftar</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
</body>
</html>
