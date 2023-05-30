<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();
//unset($_SESSION['user']);
//$_SESSION['user']='blabla';
session_destroy();
header('location:index.php');
?>
