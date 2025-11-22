<?php
require '../auth_mhs.php';

$courses = mysqli_query($conn, "SELECT * FROM course ORDER BY id DESC");

// fungsi kecil untuk cari gambar lokal berdasarkan nama course
function getCourseImagePath($nama_course) {
    $baseDir = "../uploads/"; // relatif dari folder mhs/
    // normalisasi nama: huruf kecil, non-alfanumerik jadi _
    $slug = strtolower($nama_course);
    $slug = preg_replace('/[^a-z0-9]+/i', '_', $slug);
    $slug = trim($slug, '_');

    $extensions = ['png', 'jpg', 'jpeg', 'webp', 'gif'];

    foreach ($extensions as $ext) {
        $path = $baseDir . $slug . "." . $ext;
        if (file_exists($path)) {
            return $path;
        }
    }

    // fallback default
    if (file_exists($baseDir . "default.png")) {
        return $baseDir . "default.png";
    }

    // kalau default pun tidak ada, kosongkan
    return null;
}
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
    <h2 style="margin-bottom:12px;">Course Tersedia</h2>
    <div class="grid">
        <?php while ($c = mysqli_fetch_assoc($courses)) : ?>
            <?php $imgPath = getCourseImagePath($c['nama_course']); ?>
            <div class="card">
                <?php if ($imgPath): ?>
                    <div style="margin-bottom:10px; text-align:center;">
                        <img src="<?php echo $imgPath; ?>"
                             alt="Gambar course"
                             style="max-width:100%; max-height:160px; object-fit:cover; border-radius:6px;">
                    </div>
                <?php endif; ?>

                <h3 style="margin-bottom:6px;"><?php echo htmlspecialchars($c['nama_course']); ?></h3>
                <p style="font-size:14px; margin-bottom:8px;">
                    <?php echo nl2br(htmlspecialchars($c['deskripsi'])); ?>
                </p>
                <p style="font-size:13px; margin-bottom:4px;"><strong>Level:</strong> <?php echo htmlspecialchars($c['level']); ?></p>
                <p style="font-size:13px; margin-bottom:8px;"><strong>Harga:</strong> Rp <?php echo number_format($c['harga'],0,',','.'); ?></p>
                <a href="daftar.php?course_id=<?php echo $c['id']; ?>" class="btn btn-primary">Daftar</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
