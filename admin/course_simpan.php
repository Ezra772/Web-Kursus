<?php
require '../auth_admin.php';

$nama_course = mysqli_real_escape_string($conn, $_POST['nama_course']);
$deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$level       = mysqli_real_escape_string($conn, $_POST['level']);
$harga       = (int) $_POST['harga'];
$gambar_url  = mysqli_real_escape_string($conn, $_POST['gambar_url']); // Ambil data URL

$q = mysqli_query($conn, "INSERT INTO course (nama_course, deskripsi, level, harga, gambar_url)
                          VALUES ('$nama_course', '$deskripsi', '$level', '$harga', '$gambar_url')");

if ($q) {
    header('Location: course_index.php');
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>