<?php
require '../auth_mhs.php';

$mhs_id = $_SESSION['mahasiswa_id'];

// Query hanya mengambil kursus yang statusnya 'Disetujui'
$query = "
    SELECT c.*, p.tanggal_daftar, p.status
    FROM pendaftaran p
    JOIN course c ON p.course_id = c.id
    WHERE p.mahasiswa_id = $mhs_id 
    AND p.status = 'Disetujui'
    ORDER BY p.tanggal_daftar DESC
";

$myCourses = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kursus Saya - EduNext</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">EduNext</div>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <!-- Menu Aktif -->
            <a href="kursus_saya.php" style="color:var(--primary); font-weight:600;">Kursus Saya</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="../logout.php" class="btn btn-secondary" style="margin-left:16px; padding:8px 16px;">Logout</a>
        </div>
    </div>
</div>

<div class="container" style="min-height: 80vh;">
    <div style="margin-bottom:24px; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
        <h2 style="font-weight:800; font-size:28px; color:var(--text-main);">Kursus Saya</h2>
        <p style="color:var(--text-muted);">Akses materi kursus yang telah Anda miliki.</p>
    </div>

    <div class="grid">
        <?php 
        if (mysqli_num_rows($myCourses) > 0) :
            while ($c = mysqli_fetch_assoc($myCourses)) : 
                $imgUrl = !empty($c['gambar_url']) ? $c['gambar_url'] : 'https://placehold.co/600x400?text=No+Image';
        ?>
            <div class="course-card">
                <div class="course-img-wrapper" style="height:160px;">
                    <img src="<?php echo htmlspecialchars($imgUrl); ?>" alt="Course" class="course-img">
                </div>
                <div class="course-body">
                    <span class="badge badge-success" style="font-size:11px; margin-bottom:8px; display:inline-block;">Aktif</span>
                    
                    <h3 class="course-title" style="font-size:16px;"><?php echo htmlspecialchars($c['nama_course']); ?></h3>
                    
                    <p style="font-size:13px; color:var(--text-muted); margin-bottom:16px;">
                        Bergabung sejak: <?php echo date('d M Y', strtotime($c['tanggal_daftar'])); ?>
                    </p>
                    
                    <!-- Tombol Aksi -->
                    <a href="#" class="btn btn-primary" style="width:100%; text-align:center;">Mulai Belajar</a>
                </div>
            </div>
        <?php 
            endwhile; 
        else :
        ?>
            <div style="grid-column: 1 / -1; text-align:center; padding:40px; background:#fff; border-radius:10px; border:1px solid #e2e8f0;">
                <img src="https://placehold.co/100x100?text=Empty" alt="Kosong" style="margin-bottom:16px; opacity:0.5; border-radius:50%;">
                <h3 style="color:var(--text-muted);">Belum ada kursus aktif.</h3>
                <p style="color:var(--text-muted); margin-bottom:20px;">Daftar kursus baru dan tunggu persetujuan admin.</p>
                <a href="index.php" class="btn btn-primary">Cari Kursus</a>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>