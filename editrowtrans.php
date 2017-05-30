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
				$Doc = $_POST['nDoc'];
				$Name = $_POST['nName'];
				$Add = $_POST['nAdd'];
				$Tel = $_POST['nTel'];
				$Date = $_POST['nDate'];
				$Tax = $_POST['nTax'];
				$Price = $_POST['nPrice'];
				$DC = $_POST['nDC'];
				$Paid = $_POST['nPaid'];
				$Change = $_POST['nChange'];
				$Rem = $_POST['nRem'];
				$update = "update transaction set DocumentNo='$Doc', Name='$Name', Address='$Add', Telephone='$Tel', `Date`='$Date', Tax='$Tax', TotalPrice='$Price', DiscountAmt='$DC', AmountPaid='$Paid', `ChangeAmt`='$Change', Remarks='$Rem' where TransactionID = '$unique' ";	
				$conn->query($update);
				$conn -> close();
				echo "<script>window.opener.location.href='index.php?page=editDelTrans';</script>";
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
$sql = "select * from transaction where TransactionID = '$unique'";
				
				$result = $conn->query($sql);
							  
	                   if ($result->num_rows > 0) {
	                                // output data of each row
						while($row = $result->fetch_assoc()) {
										echo "<table align='center' style='position:relative; height:500px;overflow:auto;' width = '100%'>";
                                        echo "<tr><td><font color = WHITE>Document No:</font></td><td><input type='text' class='inputs-new' value='". $row["DocumentNo"]. "' name = 'nDoc'></td></tr>";
										echo "<tr><td><font color = WHITE>Name:</font></td><td><input type='text' class='inputs-new' value='". $row["Name"]. "' name = 'nName'></td></tr>";
										echo "<tr><td><font color = WHITE>Address:</font></td><td><input type='text' class='inputs-new' value='". $row["Address"]. "' name = 'nAdd'></td></tr>";
										echo "<tr><td><font color = WHITE>Telephone:</font></td><td><input type='text' class='inputs-new' value='". $row["Telephone"]. "' name = 'nTel'></td></tr>";
										echo "<tr><td><font color = WHITE>Date:</font></td><td><input type='text' class='inputs-new' value='". $row["Date"]. "' name = 'nDate'></td></tr>";
										echo "<tr><td><font color = WHITE>Tax:</font></td><td><input type='text' class='inputs-new' value='". $row["Tax"]. "' name = 'nTax'></td></tr>";
										echo "<tr><td><font color = WHITE>Total:</font></td><td><input type='text' class='inputs-new' value='". $row["TotalPrice"]. "' name = 'nPrice'></td></tr>";
										echo "<tr><td><font color = WHITE>Discount:</font></td><td><input type='text' class='inputs-new' value='". $row["DiscountAmt"]. "' name = 'nDC'></td></tr>";
										echo "<tr><td><font color = WHITE>Paid Amount:</font></td><td><input type='text' class='inputs-new' value='". $row["AmountPaid"]. "' name = 'nPaid'></td></tr>";
										echo "<tr><td><font color = WHITE>Change:</font></td><td><input type='text' class='inputs-new' value='". $row["ChangeAmt"]. "' name = 'nChange'></td></tr>";
										echo "<tr><td><font color = WHITE>Remarks:</font></td><td><input type='text' class='inputs-new' value='". $row["Remarks"]. "' name = 'nRem'></td></tr>";
										echo "</tabel>";						
																}
                                    
													} 
?>
</form>	
</dl>
