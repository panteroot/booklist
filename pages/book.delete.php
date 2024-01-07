<?php
	
	include ( '../config.php' ); 
	include ( '../'.CLASSES.'database.php');
	include ( '../controllers/book.php' ); 
 
	
	$book_id	= $_GET['id'];
	$book		= new Book();
	$deleted	= $book->deleteBook($book_id);
	
	if($deleted>0)  $success = 4;
	else			$success = 3;
	header('Location:' .  URL_LOCATION."?success=$success");
?>	

