<?php
require '../auth_admin.php';

$id       = $_POST['id'];
$nim      = $_POST['nim'];
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$jurusan  = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];

$q = mysqli_query($conn, "UPDATE mahasiswa SET
        nim='$nim',
        nama='$nama',
        email='$email',
        jurusan='$jurusan',
        angkatan='$angkatan'
      WHERE id=$id");

if ($q) {
    header('Location: mahasiswa_index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
