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
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$Pass = $_POST['nPass'];
		$Name = $_POST['nName'];
		$Access = $_POST['nAccess'];
		$update = "update login set password='$Pass', name='$Name', access='$Access' where username = '$unique' ";
		$conn->query($update);
		$conn -> close();
		echo "<script>window.opener.location.href='index.php?page=users';</script>";
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
			<button onclick="window.close();" class="btn  btn-inverse">No</button>
			<?php
				$sql = "select * from login where username = '$unique'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<table align='center' style='position:relative; overflow:auto;' width = '100%'>";
						echo "<tr><td><font color = WHITE>Password:</font></td><td><input type='text' class='inputs-new' value='". $row["password"]. "' name = 'nPass'></td></tr>";
						echo "<tr><td><font color = WHITE>Name:</font></td><td><input type='text' class='inputs-new' value='". $row["name"]. "' name = 'nName'></td></tr>";
						echo "<tr><td><font color = WHITE>Access:</font></td><td><input type='text' class='inputs-new' value='". $row["access"]. "' name = 'nAccess'></td></tr>";
						echo "</tabel>";
					}
				}
			?>
		</form>
	</p>
</dl>
