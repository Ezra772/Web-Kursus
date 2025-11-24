<?php
require '../auth_mhs.php';
$courses = mysqli_query($conn, "SELECT * FROM course ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>EduNext - Belajar Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">EduNext</div>
        <div class="nav-links">
            <a href="index.php" style="color:var(--primary); font-weight:600;">Beranda</a>
            <a href="kursus_saya.php">Kursus Saya</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="../logout.php" class="btn btn-secondary" style="margin-left:16px; padding:8px 16px;">Logout</a>
        </div>
    </div>
</div>

<div class="hero-section">
    <h1 class="hero-title">Wujudkan Karir Digital <span style="color:var(--primary);">Impianmu</span></h1>
    <p class="hero-subtitle">Belajar dari para expert dengan kurikulum terkini. Siap untuk masa depan digital.</p>
</div>

<div class="container">
    <div style="margin-bottom:24px; text-align:center;">
        <h2 style="font-weight:800; font-size:28px;">Kursus Populer</h2>
        <p style="color:var(--text-muted);">Pilih jalur karirmu dan mulai belajar hari ini</p>
    </div>

    <div class="grid">
        <?php while ($c = mysqli_fetch_assoc($courses)) : ?>
            <?php 
                $imgUrl = !empty($c['gambar_url']) ? $c['gambar_url'] : 'https://placehold.co/600x400?text=No+Image';
            ?>
            <div class="course-card">
                <div class="course-img-wrapper">
                    <img src="<?php echo htmlspecialchars($imgUrl); ?>" alt="Course" class="course-img">
                </div>
                <div class="course-body">
                    <span class="course-level"><?php echo htmlspecialchars($c['level']); ?></span>
                    <h3 class="course-title"><?php echo htmlspecialchars($c['nama_course']); ?></h3>
                    
                    <p style="font-size:14px; color:var(--text-muted); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 42px;">
                        <?php echo htmlspecialchars($c['deskripsi']); ?>
                    </p>
                    
                    <div class="course-price">Rp <?php echo number_format($c['harga'],0,',','.'); ?></div>
                    
                    <div style="margin-top:16px;">
                        <a href="daftar.php?course_id=<?php echo $c['id']; ?>" class="btn btn-primary" style="width:100%;">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>