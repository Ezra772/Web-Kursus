<?php
require '../auth_admin.php';
$id = (int) $_GET['id'];

$q = mysqli_query($conn, "DELETE FROM course WHERE id=$id");

if ($q) {
    header('Location: course_index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
