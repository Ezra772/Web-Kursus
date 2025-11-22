<?php
require 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // redirect ke login di root, bukan ke /admin/login.php
    header('Location: /pendaftaran_course/login.php');
    exit;
}
