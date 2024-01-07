<script>

	$('#date_from').datepicker({
		autoclose: true,
		format: "M dd, yyyy"
	});

	$('#date_to').datepicker({
		autoclose: true,
		format: "M dd, yyyy"
	});

//   $('#from_date').datetimepicker({});
//   $("#to_date").datetimepicker({});

  $("#grid_research").flexigrid({
			url : '<?php echo URL_LOCATION?>pages/ajax/bookList.php',
			dataType : 'json',
			colModel : [ {
					display : '',
					name : 'actions',
					width : 80,
					sortable : false,
					align : 'left',
					<?php if($_SESSION[WEB_ABSTRACT]['user_id']>0){  ?>
						hide: false
					<?php }else{ ?>
						hide: true
					<?php } ?>
				},
				{
					display : 'ID',
					name : 'book_id',
					width : 50,
					sortable : true,
					align : 'left',
					hide:true
				},
				{
					display : 'Title',
					name : 'title',
					width : 200,
					sortable : true,
					align : 'left',
					hide: false
				},
				{
					display : 'Author',
					name : 'author',
					width : 100,
					sortable : true,
					align : 'left'
				},
				{
					display : 'Genre',
					name : 'genre',
					width : 100,
					sortable : true,
					align : 'left'
				},
				{
					display : 'Description',
					name : 'description',
					width : 500,
					sortable : true,
					align : 'left'
				},
				{
					display : 'Date',
					name : 'date_published',
					width : 200,
					sortable : true,
					align : 'left'
				}		
			],
			sortname: "title",
			sortorder: "asc",
			usepager : true,
			useRp : true,
			rp : 10,
			singleSelect: true,
			showToggleBtn: false,
			height : 420
		});


	//--- FUNCTIONS
	function searchBookList() {
			var xr;
			xr=$("#form_filter").serializeArray();
			$("#grid_research").flexOptions({params: xr}).flexReload();
	}
	
	function confirmDelete(){
		var x = confirm("Are you sure you want to delete book?");
			  if (x)
				  return true;
			  else
				  return false;
	}
</script>