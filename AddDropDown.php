<?php
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
	if (isset($_POST['ProductType'])) {
		$Type = $_POST['ProductType'];
		//echo "<link href='dist/css/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'><link href='dist/css/flat-ui.css' rel='stylesheet'><link href='docs/assets/css/demo.css' rel='stylesheet'>";
		//echo "<select class='form-control select select-primary' onchange = \"run('AddDropDown.php','Selected')\" data-toggle='select' id = 'nType' >";
		$Desc= "select ID, concat(Product,' - ' , Description) as Proddesc from stocks where ProductType = '$Type'";
		$Descresult = $conn->query($Desc);
		if ($Descresult->num_rows > 0) {
			// output data of each row
			while ($drow = $Descresult->fetch_assoc()) {
				echo "<option value='". $drow["ID"]. "'>". $drow["Proddesc"]. "</option>";
			}
		}
		echo "</select>";
	}
?>