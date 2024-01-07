<?php
	
	include ( '../config.php');
	include ( '../'.CLASSES.'custom.class.php' );
    include ( '../'.CLASSES.'database.php');
	include ( '../controllers/book.php' ); 
	include ( '../controllers/genre.php' );
	
	include '../'.LAYOUT."top.php";
	include '../'.LAYOUT."nav.php";	

	// sql sanitization
	$custom = new custom();

	// get genres
	$genre = new Genre();
	$res_genre = $genre->getGenres();

	// book
	$book = new book();
	
	$mode = $_REQUEST['mode'];
	if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
		$book_id		= $_REQUEST['id'];
		
		$row			= $book->getBook($book_id);

		$title 	 		= $row->title;	
		$f_genre_id		= $row->f_genre_id;
		$author  		= $row->author;
		$description 	= $row->description;
		$date_published = date('M d, Y',strtotime($row->date_published));
	}

	$form_action 	= trim($_REQUEST['form_action']);
	if($form_action!=''){	
		$book_id = $custom->sql_safe($_POST['book_id']);
		unset($_POST['form_action']);
		unset($_POST['book_id']);
		unset($_POST['submit']);	


		$post_fields = "";
		$post_data = array();	
		foreach( $_POST as $key => $value ){
			$sanitized_val = $custom->sql_safe($value);
			$post_data[$key] = $sanitized_val;

			if(!empty($post_fields))
				$post_fields .= ", $key = :$key ";
			else
				$post_fields .= " $key = :$key ";
		}	

		$post_data['date_published'] 	 = date('Y-m-d',strtotime($post_data['date_published']));	
		
		switch($form_action){
			case 'add':	
				$added 	 = 	$book->createBook($post_fields,$post_data);
				
				if($added > 0) {
					$success = 1;
				}
				else {
					$success = 3;
				}

				header('Location:' .  URL_LOCATION."?success=$success");
				
			break;
			case 'edit': 	
				$updated  = $book->updateBook($post_fields,$post_data, $book_id);
				
				if($updated > 0) {
					$success = 2;
				}
				else {
					$success = 3;
				}
				
				header('Location:' .  URL_LOCATION."?success=$success");
			break;
		}
	}
	
?>

<!-- Page Content -->
		
	<form method="post" action="#" id="form_filter">
		<br/>
		<input type="text" hidden name="form_action" id="form_action" value="<?php echo $mode; ?>" />
		<input type="text" hidden name="book_id" id="book_id" value="<?php echo $book_id ?>" />
		<div class="row">
			<div class="col-xs-12">
				<label class="control-label" for="title"> Title </label>
				<input class="form-control" type="text" required name="title" id="title" placeholder="Book Title" value="<?php echo $title;?>"> 
			</div> 
		</div>
		
		<div class="row">
			<div class="col-xs-4">
				<label class="control-label" for="f_genre_id"> Genre </label>
				<select class="form-control" required id="f_genre_id" name="f_genre_id">
					<option  value="">Select</option>
					<?php
						foreach($res_genre as $row_genre){
							$selected = $f_genre_id == $row_genre->genre_id? 'selected' : '';
							echo '<option '.$selected.' value="'.$row_genre->genre_id.'">'.$row_genre->genre_name.'</option>';
						}
					?>
				</select>	
			</div>	

			<div class="col-xs-4">
				<label class="control-label" for="r_type"> Author </label>
				<input class="form-control" type="text" required name="author" id="author" placeholder="Book Author" value="<?php echo $author;?>"> 
			</div>	

			<div class="col-xs-4">
				<label class="control-label" for="published_date"> Date Published </label>
				<input type="text" required id="date_published" name="date_published" autocomplete="off" value="<?php echo $mode=='edit'? $date_published : '' ?>" class="form-control" placeholder="Click to show the datepicker">
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
				<label class="control-label" for="abstract"> Description </label>
				<textarea class="form-control" required id="description" name="description" rows="5" placeholder="Book Description" ><?php echo $description?></textarea>
			</div>	
		</div>

		
		
		
		<div class="row">
			<div class="col-xs-3">
				<br/>
				<input type="submit" name="submit" value="Save Book" id="search" class="form-control btn btn-md btn-success">
			</div>
		</div>
	</form>
	
<?php
	include '../'.LAYOUT."footer.php";
	include "js.php";
?>

	