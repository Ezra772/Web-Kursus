<?php
require '../auth_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = (int) $_POST['id'];
    $aksi = $_POST['aksi'];

    if ($aksi === 'setuju') {
        $statusBaru = 'Disetujui';
    } elseif ($aksi === 'tolak') {
        $statusBaru = 'Ditolak';
    } else {
        // aksi tidak dikenal
        header('Location: index.php');
        exit;
    }

    $q = mysqli_query($conn, "UPDATE pendaftaran 
                              SET status = '$statusBaru' 
                              WHERE id = $id");

    // bisa tambahkan pengecekan error kalau mau
}

header('Location: index.php');
exit;
