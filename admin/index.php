<?php
require '../auth_admin.php';

// Hitung statistik sederhana dari database
$countMhs = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM mahasiswa"));
$countCourse = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM course"));
$countPendaftaran = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pendaftaran"));

// Query untuk mengambil data pendaftaran (join dengan tabel mahasiswa & course)
// Mengurutkan: "Menunggu Konfirmasi" paling atas, lalu berdasarkan tanggal terbaru
$sql = "
    SELECT 
        p.id,
        p.tanggal_daftar,
        p.status,
        m.nim,
        m.nama AS nama_mahasiswa,
        c.nama_course
    FROM pendaftaran p
    JOIN mahasiswa m ON p.mahasiswa_id = m.id
    JOIN course c ON p.course_id = c.id
    ORDER BY 
        CASE WHEN p.status = 'Menunggu Konfirmasi' THEN 0 ELSE 1 END,
        p.tanggal_daftar DESC
";
$pendaftaran = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - EduNext</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="navbar">
    <div class="navbar-inner">
        <a href="index.php" class="navbar-brand">EduNext Admin</a>
        
        <div class="nav-links">
            <a href="index.php" style="font-weight:700;">Dashboard</a>
            
            <a href="course_index.php">Kelola Kursus</a>
            <a href="mahasiswa_index.php">Kelola User</a>
            
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<div class="container">
    <h2 style="margin-bottom:20px;">Statistik Sistem</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-number"><?php echo $countMhs; ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Kursus</div>
            <div class="stat-number"><?php echo $countCourse; ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Pendaftaran</div>
            <div class="stat-number"><?php echo $countPendaftaran; ?></div>
        </div>
    </div>

    <div class="card">
        <div style="margin-bottom:20px;">
            <h3>Verifikasi Pendaftaran Terbaru</h3>
            <p style="color:var(--text-muted); font-size:14px;">Pantau dan kelola pendaftaran mahasiswa yang masuk.</p>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Kursus</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($pendaftaran) === 0): ?>
                    <tr><td colspan="6" style="text-align:center; padding:20px;">Belum ada pendaftaran baru.</td></tr>
                <?php else:
                    while ($p = mysqli_fetch_assoc($pendaftaran)) :
                        $status = $p['status'];
                        // Tentukan warna badge berdasarkan status
                        $badgeClass = 'badge-pending';
                        if($status == 'Disetujui') $badgeClass = 'badge-success';
                        if($status == 'Ditolak') $badgeClass = 'badge-danger';
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($p['nama_mahasiswa']); ?></strong><br>
                            <span style="font-size:12px; color:#888;"><?php echo htmlspecialchars($p['nim']); ?></span>
                        </td>
                        <td><?php echo htmlspecialchars($p['nama_course']); ?></td>
                        <td><?php echo date('d M Y', strtotime($p['tanggal_daftar'])); ?></td>
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span></td>
                        <td>
                            <?php if ($status === 'Menunggu Konfirmasi'): ?>
                                <form action="pendaftaran_update.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                    <input type="hidden" name="aksi" value="setuju">
                                    <button class="btn btn-primary" style="padding:6px 12px; font-size:12px;">Terima</button>
                                </form>
                                <form action="pendaftaran_update.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                    <input type="hidden" name="aksi" value="tolak">
                                    <button class="btn btn-danger" style="padding:6px 12px; font-size:12px;" onclick="return confirm('Tolak pendaftaran ini?');">Tolak</button>
                                </form>
                            <?php else: ?>
                                <span style="color:#aaa; font-size:13px;">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>