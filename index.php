<?php
	require 'share.php';

	$page = $_REQUEST['page'];
	if (!isset($page)) {
		$page = "home";
	}

	ini_set('max_execution_time', 0);
	ini_set('memory_limit', '2048M');
	ini_set('post_max_size','100M');
	
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
		if (error_reporting() == 0) {
			return;
		}
		if (error_reporting() & $severity) {
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		}
	}
	$valid_formats = array("csv");
	$max_file_size = 1024*1024*1024*1024;
	$dir = "Files/";//directory of the temp file uploaded
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "gobyteit";
	
	// If File Submitted
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QWERTY Corporation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        img {
            max-width: 100%;
        }
		
		#demo .active, #stocks .active {
			color: #fff;
			background-color: #080808;
		}

		.row {
			min-height: 500px;
		}

		@media screen and (min-width: 768px){
		.container .jumbotron, .container-fluid .jumbotron {
			padding: 20px;
		}}
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="img/logo_header.png"/></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                    <a href="logout.php"><i class="fa fa-user"></i> Log Out (<?php echo $user;?>)</a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php if ($page=='home'){ echo 'active';}?>">
                        <a href="index.php?page=home"><i class="fa fa-fw fa-home"></i> Home</a>
                    </li>
                    <li class="<?php if ($page=='transact'){ echo 'active';}?>">
                        <a href="index.php?page=transact"><i class="fa fa-fw fa-table"></i> Transact</a>
                    </li>
                    <li class="<?php if ($page=='viewStocks'){ echo 'active';}?>">
                        <a href="index.php?page=viewStocks"><i class="fa fa-fw fa-table"></i> View Stocks</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#stocks"><i class="fa fa-fw fa-list"></i> Stocks <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="stocks" class="collapse <?php if($page=='addStocks'||$page=='addNewStocks'||$page=='editDelStocks'){echo 'in';}?>">
		                    <li class="<?php if ($page=='addStocks'){ echo 'active';}?>">
                                <a href="index.php?page=addStocks">Add Stocks</a>
                            </li>
				            <li class="<?php if ($page=='addNewStocks'){ echo 'active';}?>">
                                <a href="index.php?page=addNewStocks">Add NEW Stocks</a>
                            </li>
						    <li class="<?php if ($page=='editDelStocks'){ echo 'active';}?>">
                                <a href="index.php?page=editDelStocks">Edit/Delete Stocks</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-list"></i> Transactions <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse <?php if($page=='viewTrans'||$page=='editDelTrans'){echo 'in';}?>">
							<li class="<?php if ($page=='viewTrans'){ echo 'active';}?>">
                                <a href="index.php?page=viewTrans">View Transactions</a>
                            </li>
							<li class="<?php if ($page=='editDelTrans'){ echo 'active';}?>">
                                <a href="index.php?page=editDelTrans">Edit/Delete Transactions</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($page=='users'){ echo 'active';}?>">
                        <a href="index.php?page=users"><i class="fa fa-fw fa-user"></i> Users</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
            <?php
				include $page . '.php';
            ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <footer>
            <!-- /#page-wrapper -->
    		<nav class="navbar navbar-inverse" role="navigation" style="border: none;">
    			<div class="navbar-right" style="margin: 0;">
    				<a class="navbar-brand" href="#">Powered by GoByteIT</a>
    			</div>
    		</nav>
        </footer>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
