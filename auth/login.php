<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../students/index.php");
    exit;
}
$title = 'Login';
$content = '../contents/auth/login.php';
include '../layouts/main.php';
?>