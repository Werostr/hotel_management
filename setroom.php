<?php
session_start();
ob_start();
$_SESSION['wybranyPokoj'] = $_GET['wybranyPokoj'];
header('Location: guest.php');

ob_end_flush();
?>