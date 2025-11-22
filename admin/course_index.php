<?php
require '../auth_admin.php';

$result = mysqli_query($conn, "SELECT * FROM course ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Course</title>
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
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <h3>Data Course</h3>
            <a href="course_tambah.php" class="btn btn-primary">Tambah Course</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>No</th><th>Nama Course</th><th>Level</th><th>Harga</th><th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; while ($c = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($c['nama_course']); ?></td>
                        <td><?php echo htmlspecialchars($c['level']); ?></td>
                        <td>Rp <?php echo number_format($c['harga'],0,',','.'); ?></td>
                        <td>
                            <a href="course_edit.php?id=<?php echo $c['id']; ?>" class="btn btn-warning" style="font-size:12px;">Edit</a>
                            <a href="course_hapus.php?id=<?php echo $c['id']; ?>" class="btn btn-danger" style="font-size:12px;"
                               onclick="return confirm('Hapus course ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
