<?php
session_start();
$_SESSION["matricule"] = null;
header("location:../login.php");
session_unset();
session_destroy();
?>