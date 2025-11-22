<?php
require '../auth_admin.php';

$nim      = $_POST['nim'];
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$jurusan  = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];

$q = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan)
                          VALUES ('$nim','$nama','$email','$jurusan','$angkatan')");

if ($q) {
    header('Location: mahasiswa_index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
