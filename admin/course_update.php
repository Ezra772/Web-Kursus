<?php
require '../auth_admin.php';

$id          = $_POST['id'];
$nama_course = $_POST['nama_course'];
$deskripsi   = $_POST['deskripsi'];
$level       = $_POST['level'];
$harga       = $_POST['harga'];

$q = mysqli_query($conn, "UPDATE course SET
        nama_course='$nama_course',
        deskripsi='$deskripsi',
        level='$level',
        harga='$harga'
      WHERE id=$id");

if ($q) {
    header('Location: course_index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
