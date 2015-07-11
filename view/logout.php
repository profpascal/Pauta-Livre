<?php
	session_start();
	$_SESSION["id"] = null;
	$_SESSION["nome"] = null;
	$_SESSION["usuario"] = null;
	header("location: ../view/index.php");
?>
