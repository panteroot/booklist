<?php

	include ("../config.php"); 
	include ("../".CLASSES."database.php");
	include ("../".CLASSES."custom.class.php");   
	include ("../controllers/user.php");
	
	
	$valid = 'NO';
	if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
		$custom = new custom;
		$username = $custom->sql_safe($_POST['username']);
		$password = $custom->sql_safe($_POST['password']);	
		
		$user = new User();	
		$row_user = $user->login($username, $password);

		if($row_user){
			$_SESSION[WEB_ABSTRACT]['user_id']  = $row_user->user_id;
			$_SESSION[WEB_ABSTRACT]['username'] = $username;
			$_SESSION[WEB_ABSTRACT]['user_fullname'] = $row_user->fullname;
			
			echo $valid = 'YES';
			header( 'Location: ' . URL_LOCATION ) ;
		}else{
			header( 'Location: ' . URL_LOCATION. "pages/login.frm.php?valid=$valid" ) ;
		}

	}else{

		header( 'Location: ' . URL_LOCATION. "pages/login.frm.php?valid=$valid" ) ;
	}

	include "../".LAYOUT."footer.php";
?>

