<?php
require '../auth_admin.php';

// ambil data pendaftaran join mahasiswa + course
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
    <title>Dashboard Admin</title>
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

    <!-- Kartu sambutan -->
    <div class="card">
        <h2 style="margin-bottom:8px;">Halo, Admin <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <p>Kelola data mahasiswa, course, dan verifikasi pendaftaran dari mahasiswa.</p>
    </div>

    <!-- Tabel pendaftaran -->
    <div class="card">
        <h3 style="margin-bottom:12px;">Verifikasi Pendaftaran Course</h3>
        <p style="font-size:13px; color:#6b7280; margin-bottom:10px;">
            Pendaftaran dengan status <strong>Menunggu Konfirmasi</strong> muncul di urutan paling atas.
        </p>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Course</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($pendaftaran) === 0): ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:12px;">
                            Belum ada pendaftaran course.
                        </td>
                    </tr>
                <?php
                else:
                    while ($p = mysqli_fetch_assoc($pendaftaran)) :
                        $status = $p['status'];
                        $isPending = ($status === 'Menunggu Konfirmasi');
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($p['nim']); ?></td>
                        <td><?php echo htmlspecialchars($p['nama_mahasiswa']); ?></td>
                        <td><?php echo htmlspecialchars($p['nama_course']); ?></td>
                        <td><?php echo htmlspecialchars($p['tanggal_daftar']); ?></td>
                        <td><?php echo htmlspecialchars($status); ?></td>
                        <td>
                            <?php if ($isPending): ?>
                                <!-- Approve -->
                                <form action="pendaftaran_update.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                    <input type="hidden" name="aksi" value="setuju">
                                    <button class="btn btn-primary" style="font-size:12px;">
                                        Setujui
                                    </button>
                                </form>

                                <!-- Tolak -->
                                <form action="pendaftaran_update.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                    <input type="hidden" name="aksi" value="tolak">
                                    <button class="btn btn-danger" style="font-size:12px;"
                                            onclick="return confirm('Tolak pendaftaran ini?');">
                                        Tolak
                                    </button>
                                </form>
                            <?php else: ?>
                                <span style="font-size:12px; color:#6b7280;">Tidak ada aksi</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                    endwhile;
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
