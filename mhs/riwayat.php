<?php
require '../auth_mhs.php';

$mhs_id = $_SESSION['mahasiswa_id'];

$q = mysqli_query($conn, "SELECT p.*, c.nama_course
                          FROM pendaftaran p
                          JOIN course c ON p.course_id = c.id
                          WHERE p.mahasiswa_id = $mhs_id
                          ORDER BY p.tanggal_daftar DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pendaftaran</title>
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
        <h3 style="margin-bottom:12px;">Riwayat Pendaftaran</h3>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>No</th><th>Course</th><th>Tanggal Daftar</th><th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; while ($p = mysqli_fetch_assoc($q)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($p['nama_course']); ?></td>
                        <td><?php echo $p['tanggal_daftar']; ?></td>
                        <td><?php echo htmlspecialchars($p['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
