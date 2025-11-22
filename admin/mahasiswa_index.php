<?php
require '../auth_admin.php';

$result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
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
            <h3>Data Mahasiswa</h3>
            <a href="mahasiswa_tambah.php" class="btn btn-primary">Tambah Mahasiswa</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>No</th><th>NIM</th><th>Nama</th><th>Email</th><th>Jurusan</th><th>Angkatan</th><th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; while ($m = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($m['nim']); ?></td>
                        <td><?php echo htmlspecialchars($m['nama']); ?></td>
                        <td><?php echo htmlspecialchars($m['email']); ?></td>
                        <td><?php echo htmlspecialchars($m['jurusan']); ?></td>
                        <td><?php echo htmlspecialchars($m['angkatan']); ?></td>
                        <td>
                            <a href="mahasiswa_edit.php?id=<?php echo $m['id']; ?>" class="btn btn-warning" style="font-size:12px;">Edit</a>
                            <a href="mahasiswa_hapus.php?id=<?php echo $m['id']; ?>"
                               class="btn btn-danger" style="font-size:12px;"
                               onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
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
