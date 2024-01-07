<?php
	include ("../config.php");
	unset($_SESSION);
	session_destroy();
	
	header('Location: ' . URL_LOCATION);
?>