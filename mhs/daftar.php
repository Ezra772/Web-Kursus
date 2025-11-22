<?php
require '../auth_mhs.php';

$course_id = (int) $_GET['course_id'];
$q_course  = mysqli_query($conn, "SELECT * FROM course WHERE id=$course_id");
$course    = mysqli_fetch_assoc($q_course);

// Ambil URL gambar atau default
$imgUrl = !empty($course['gambar_url']) ? $course['gambar_url'] : 'https://placehold.co/600x400?text=No+Image';

$mhs_id = $_SESSION['mahasiswa_id'];
$q_mhs  = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$mhs_id");
$mhs    = mysqli_fetch_assoc($q_mhs);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi - EduNext</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">EduNext</div>
        <div class="nav-links">
            <a href="index.php">Kembali</a>
        </div>
    </div>
</div>

<div class="full-height-center" style="align-items:flex-start; padding-top:40px;">
    <div class="card" style="width: 100%; max-width: 800px; padding:30px;">
        <h3 style="margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:10px;">Konfirmasi Pendaftaran</h3>

        <div style="display: flex; flex-wrap: wrap; gap: 30px;">
            
            <div style="flex: 1; min-width: 250px;">
                <span class="course-level" style="margin-bottom:8px; display:inline-block;"><?php echo htmlspecialchars($course['level']); ?></span>
                <h2 style="margin-bottom:8px; color:var(--primary);"><?php echo htmlspecialchars($course['nama_course']); ?></h2>
                <p style="color:var(--text-muted); font-size:15px; margin-bottom:20px;">
                    <?php echo nl2br(htmlspecialchars($course['deskripsi'])); ?>
                </p>

                <div style="background:#f8fafc; padding:16px; border-radius:8px; border:1px solid #e2e8f0; margin-bottom:20px;">
                    <p style="font-size:13px; color:#64748b; margin-bottom:4px;">Pendaftar:</p>
                    <p style="font-weight:600; font-size:15px; color:#334155; margin-bottom:4px;"><?php echo htmlspecialchars($mhs['nama']); ?></p>
                    <p style="font-size:14px; color:#64748b;">NIM: <?php echo htmlspecialchars($mhs['nim']); ?></p>
                </div>

                <form action="proses_daftar.php" method="POST">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <button class="btn btn-primary" style="padding:10px 24px;">Konfirmasi Daftar</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>

            <div style="width: 300px; flex-shrink: 0;">
                <div style="border-radius:10px; overflow:hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border:1px solid #e2e8f0;">
                    <img src="<?php echo htmlspecialchars($imgUrl); ?>" 
                         alt="Gambar Course" 
                         style="width:100%; height:200px; object-fit:cover; display:block;">
                    <div style="padding:16px; background:white; text-align:center;">
                        <span style="display:block; font-size:12px; color:#64748b;">Harga Kelas</span>
                        <strong style="font-size:20px; color:var(--primary);">
                            Rp <?php echo number_format($course['harga'],0,',','.'); ?>
                        </strong>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>