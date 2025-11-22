<?php
require '../auth_admin.php';

$nama_course = $_POST['nama_course'];
$deskripsi   = $_POST['deskripsi'];
$level       = $_POST['level'];
$harga       = $_POST['harga'];

$q = mysqli_query($conn, "INSERT INTO course (nama_course, deskripsi, level, harga)
                          VALUES ('$nama_course', '$deskripsi', '$level', '$harga')");

if ($q) {
    header('Location: course_index.php');
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
