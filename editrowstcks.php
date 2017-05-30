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

					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
					}
				
if($_SERVER['REQUEST_METHOD'] == "POST"){
				$Prod = $_POST['nProd'];
				$Type = $_POST['nType'];
				$Qty = $_POST['nQty'];
				$Mod = $_POST['nMod'];
				$Price = $_POST['nPrice'];
				$Inv = $_POST['nInv'];
				$Des = $_POST['nDes'];
				$Rem = $_POST['nRem'];
				$IN = $_POST['nIN'];
				$OUT = $_POST['nOUT'];
				$UOM = $_POST['nUOM'];
				$update = "update stocks set Product='$Prod', ProductType='$Type', Quantity='$Qty', Unit='$UOM', LastDateIn='$IN', LastDateTransacted='$OUT', ModelNo='$Mod', Price='$Price', Investment='$Inv', Description='$Des', Remarks='$Rem' where ID = '$unique' ";
				$stocklog = "insert into stocklog(`TransactionID`, `StockID`, `Product`, `ProductType`, `Quantity`, `Unit`, `TimeIn`,`LastDateIn`,`LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`, `Action`) select '',`ID`, `Product`, `ProductType`, `Quantity`, `Unit`, now(),`LastDateIn`,`LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`,'edt' from stocks where ID = '$unique' ";
				$conn->query($update);
				$conn->query($stocklog);
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
<p align = center valign ='middle'>Save?
<form action="" method="POST" enctype="multipart/form-data" align='center' valign='middle'>
<input type="submit" name="Submit" value="Yes" class="btn  btn-inverse"/>
<button onclick="window.close();" class="btn  btn-inverse">No</button></p>
<?php
$sql = "select * from stocks where ID = '$unique'";
				
				$result = $conn->query($sql);
							  
	                   if ($result->num_rows > 0) {
	                                // output data of each row
						while($row = $result->fetch_assoc()) {
										echo "<table align='center' style='position:relative; height:500px;overflow:auto;' width = '100%'>";
                                        echo "<tr><td><font color = WHITE>Product:</font></td><td><input type='text' class='inputs-new' value='". $row["Product"]. "' name = 'nProd'></td></tr>";
										echo "<tr><td><font color = WHITE>Product Type:</font></td><td><input type='text' class='inputs-new' value='". $row["ProductType"]. "' name = 'nType'></td></tr>";
										echo "<tr><td><font color = WHITE>Quantity:</font></td><td><input type='text' class='inputs-new' value='". $row["Quantity"]. "' name = 'nQty'></td></tr>";
										echo "<tr><td><font color = WHITE>Unit:</font></td><td><input type='text' class='inputs-new' value='". $row["Unit"]. "' name = 'nUOM'></td></tr>";
										echo "<tr><td><font color = WHITE>DateIN:</font></td><td><input type='text' class='inputs-new' value='". $row["LastDateIn"]. "' name = 'nIN'></td></tr>";
										echo "<tr><td><font color = WHITE>DateOUT:</font></td><td><input type='text' class='inputs-new' value='". $row["LastDateTransacted"]. "' name = 'nOUT'></td></tr>";
										echo "<tr><td><font color = WHITE>Model No:</font></td><td><input type='text' class='inputs-new' value='". $row["ModelNo"]. "' name = 'nMod'></td></tr>";
										echo "<tr><td><font color = WHITE>Price:</font></td><td><input type='text' class='inputs-new' value='". $row["Price"]. "' name = 'nPrice'></td></tr>";
										echo "<tr><td><font color = WHITE>Investment:</font></td><td><input type='text' class='inputs-new' value='". $row["Investment"]. "' name = 'nInv'></td></tr>";
										echo "<tr><td><font color = WHITE>Description:</font></td><td><input type='text' class='inputs-new' value='". $row["Description"]. "' name = 'nDes'></td></tr>";
										echo "<tr><td><font color = WHITE>Remarks:</font></td><td><input type='text' class='inputs-new' value='". $row["Remarks"]. "' name = 'nRem'></td></tr>";
										echo "</tabel>";						
																}
                                    
													} 
?>
</form>	
</dl>
