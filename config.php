<?php
// config.php
session_start();

$host = "localhost";
$user = "root";      // sesuaikan
$pass = "";          // sesuaikan
$db   = "db_course";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
