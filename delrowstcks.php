<?php
$unique=$_GET['unique'];
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
			if($_SERVER['REQUEST_METHOD'] == "POST"){
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
					}
			
				$delete = "delete from stocks where ID = '$unique'";	
				$stocklog = "insert into stocklog(`TransactionID`, `StockID`, `Product`, `ProductType`, `Quantity`, `Unit`, `TimeIn`,`LastDateIn`,`LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`, `Action`) select '',`ID`, `Product`, `ProductType`, `Quantity`, `Unit`, now(),`LastDateIn`,`LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`,'del' from stocks where ID = '$unique' ";
				$conn->query($stocklog);
				$conn->query($delete);
				$conn -> close();
				echo "<script>window.opener.location.href='index.php?page=editDelStocks';</script>";
				echo "<script>window.close();</script>";
			}
?>
<head>
<link href="dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">
</head>
<dl class="palette palette-belize-hole">
<p align = center valign ='middle'>Are you sure to delete?
<form action="" method="POST" enctype="multipart/form-data" align='center' valign='middle'>
<input type="submit" name="Submit" value="Yes" class="btn  btn-inverse"/>
<button onclick="window.close();" class="btn  btn-inverse">No</button></p>
</form>	
</dl>
