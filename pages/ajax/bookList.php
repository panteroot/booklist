<?php
include_once ( '../../config.php');
include_once ( '../../'.CLASSES.'database.php');
include ("../../controllers/book.php");

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : '';
$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : '';


$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];


if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);


$title=($_REQUEST['title']) ? $_REQUEST['title'] : false;
$author=($_REQUEST['author']) ? $_REQUEST['author'] : false;
$date_from=($_REQUEST['date_from']) ? $_REQUEST['date_from'] : false;
$date_to=($_REQUEST['date_to']) ? $_REQUEST['date_to'] : false;
$where = "";


if($title != ''){
	$where .= " AND title LIKE :title";
	$where_val[':title'] = "%$title%";
}
if($author != ''){
	$where .= " AND author LIKE :author";
	$where_val[':author'] = "%$author%";
} 

if($date_from && $date_to) {
  $date_from2 = date('Y-m-d',strtotime($date_from));
  $date_to2 = date('Y-m-d',strtotime($date_to));
  $where .= " AND (date_published BETWEEN :date_from AND :date_to)";
  $where_val[':date_from'] = $date_from2;
  $where_val[':date_to'] = $date_to2;
} 


// // Setup sort and search SQL using posted data
$sortSql = " ORDER BY $sortname $sortorder";
$limit = " LIMIT $start, $rp";
// $where_val['start'] = $start;
// $where_val['rp'] = $rp;

$where .= " $sortSql $limit";

$book = new Book(); 
$rows = $book->getBooksBySearch($where, $where_val);

$total = $book->getTotalBooks();

header("Content-type: application/json");
$jsonData = array('page'=>$page,'total'=>$total,'rows'=>array());
$counter = 1;
foreach($rows AS $row){
	//If cell's elements have named keys, they must match column names
	//Only cell's with named keys and matching columns are order independent.

	if($_SESSION[WEB_ABSTRACT]['user_id']>0){
		$actions = '<a href="'.URL_LOCATION.MODULES.'book.frm.php?mode=edit&id='.$row->book_id.'" title="Edit" target="" class="btn btn-xs btn-primary">Edit</a>';
		$actions .= ' | <a href="'.URL_LOCATION.MODULES.'book.delete.php?mode=delete&id='.$row->book_id.'" title="Delete" onClick="return confirmDelete()" target="" class="btn btn-xs btn-danger">Del</a>';	
	}
	
	$date_published = date('M d, Y',strtotime($row->date_published));
	
	$entry = array('id'=>$counter,
		'cell'=>array(
			'actions'=>$actions,
			'book_id'=>$row->book_id,
			'title'=>$row->title,
			'author'=>$row->author,
			'genre'=>$row->genre,
			'date_published'=>$date_published,
			'description'=>$row->description
		),
	);
	$jsonData['rows'][] = $entry;
	$counter++;
}
echo json_encode($jsonData);

?>