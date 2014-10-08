<?php
	session_start();
	unset($_SESSION['truth']);
	header("location:../");
?>