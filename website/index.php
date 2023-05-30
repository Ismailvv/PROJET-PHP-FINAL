<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['user']))
{
    header('location:form_compte.html');
}
else 
header("location:espace_utilisateur.php");
?>
