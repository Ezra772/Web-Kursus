<?php
require '../auth_mhs.php';

$course_id    = (int) $_POST['course_id'];
$mahasiswa_id = $_SESSION['mahasiswa_id'];
$tanggal      = date('Y-m-d');

$q = mysqli_query($conn, "INSERT INTO pendaftaran (mahasiswa_id, course_id, tanggal_daftar)
                          VALUES ($mahasiswa_id, $course_id, '$tanggal')");

if ($q) {
    header('Location: riwayat.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
