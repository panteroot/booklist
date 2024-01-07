 <?php
 
	include ("config.php");
	include CLASSES."classes.php";
	include CLASSES."messages.php";
	include LAYOUT."top.php"; 
	include LAYOUT."nav.php";	
	
?>	
	<!-- Page Content -->
	<div class="container">	
		<?php if(isset($_GET['success'])) echo $messages['alert'][$_GET['success']]; ?>
		
		<form method="post" action="" onSubmit="searchBookList();return false" id="form_filter">
		<br/>
		<div class="row">
			<div class="col-xs-3">
				<input class="form-control" type="text" name="title" id="title" placeholder="Book Title"> 
			</div>	
			<div class="col-xs-2">
				<input class="form-control" type="text" name="author" id="author" placeholder="Author"> 
			</div>		
			<div class="col-xs-2">
				<input type="text" id="date_from" name="date_from" autocomplete="off" class="form-control" placeholder="Click to choose date">
				<label class="control-label">Published To</label>
			</div>
			<div class="col-xs-2">
				<input type="text" id="date_to" name="date_to" autocomplete="off" class="form-control" placeholder="Click to choose date">
				<label class="control-label">Published To</label>
			</div>
			
			<div class="col-xs-1">
				<input type="submit" value="Search" id="search" class="form-control btn btn-md btn-success">
			</div>
		</div>

		<?php if($_SESSION[WEB_ABSTRACT]['user_id']>0){ ?>
		<div class="row">
			<div class="col-xs-6">
			<a href="<?php echo URL_LOCATION.MODULES?>book.frm.php?mode=add"><b>Add New Book</b></a>
			</div>
		</div>
		<?php } ?>
		<br/>
		<div class="row" id="result">
			<div class="col-xs-12">
				<table id="grid_research" style="display: none" ></table>
			</div>
		</div>
		</form>
	</div>
	
<?php
	include LAYOUT."footer.php";
	include "js.php";
?>



