

<!-- Navigation -->
	
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL_LOCATION?>">Booklist</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo URL_LOCATION?>"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>
				</ul>


				<ul class="nav navbar-nav navbar-right">
					<?php if ($_SESSION[WEB_ABSTRACT]['user_id']>0) { ?> 
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> 
							 <b><?php echo "HELLO  ".$_SESSION[WEB_ABSTRACT]['user_fullname']; ?> 
							 </b> 
							 <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo URL_LOCATION.MODULES?>logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
							</ul>
						</li>				
					<?php }
						else{		
					?>
						<li><a href="<?php echo URL_LOCATION.MODULES?>login.frm.php"><b>Login</b></a></li>
					<?php
						}
					?>
				</ul>
				
				
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	
	<div class="container">
	<?php 
		include "../".CLASSES."others.php";
		
	?>
	<div class="row">
		<div class="col-xs-8">
	