<?php
session_start();
unset($_SESSION['datauserid']);
header("Location: ../datafeeder.php");
?>