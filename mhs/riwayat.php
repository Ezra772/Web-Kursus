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
    <title>Riwayat Pendaftaran - EduNext</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">EduNext</div>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="kursus_saya.php">Kursus Saya</a>
            <a href="riwayat.php" style="color:var(--primary); font-weight:600;">Riwayat</a>
            <a href="../logout.php" class="btn btn-secondary" style="margin-left:16px; padding:8px 16px;">Logout</a>
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
                <?php 
                $no=1; 
                if(mysqli_num_rows($q) > 0):
                    while ($p = mysqli_fetch_assoc($q)) : 
                        $status = $p['status'];
                        $badgeClass = 'badge-pending';
                        if($status == 'Disetujui') $badgeClass = 'badge-success';
                        if($status == 'Ditolak') $badgeClass = 'badge-danger';
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($p['nama_course']); ?></td>
                        <td><?php echo date('d M Y', strtotime($p['tanggal_daftar'])); ?></td>
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($status); ?></span></td>
                    </tr>
                <?php 
                    endwhile;
                else:
                ?>
                    <tr><td colspan="4" style="text-align:center;">Belum ada riwayat pendaftaran.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>