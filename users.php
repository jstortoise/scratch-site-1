<?php
	require 'share.php';
?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Users
		</h1>
		<div class="col-lg-6">
			<h5>Add Users by inputting Details and Press Add<br>Access: adm=Adminisrtator,enc=Encoder<br></h5>

			<form action="#" role="form" method="POST" class="jumbotron">
				<div class="form-group">
					<label>Username:</label>
					<input class="form-control" placeholder="user1234" name="nUser" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Password:</label>
					<input class="form-control" placeholder="p@ssw0rd" name="nPass" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Name:</label>
					<input class="form-control" placeholder="Juan De la Cruz" name="nName" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Access:</label>
					<input class="form-control" placeholder="adm,enc" name="nAccess" autocomplete="off">
				</div>

				<button type="submit" class="btn btn-default">Add</button>
			</form>
		</div>
		<div class="col-lg-6">
			<h3>List</h3>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Username</th>
							<th>Password</th>
							<th>Name</th>
							<th>Access</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php
						if (isset($_POST['nUser']) && isset($_POST['nPass']) && isset($_POST['nName']) && isset($_POST['nAccess']) && !empty($_POST['nUser']) && !empty($_POST['nPass']) && !empty($_POST['nName']) && !empty($_POST['nAccess'])) {
							$nUser = $_POST['nUser'];
							$Pass = $_POST['nPass'];
							$Name = $_POST['nName'];
							$Access = $_POST['nAccess'];
							
							$insert = "INSERT INTO login VALUES ('$nUser','$Pass','$Name','$Access')";
							$success = $conn->query($insert);
							
							if ($success) {
							} else {
								echo "<script>alert('Please Input other Username');</script>";
							}
						} else {
							if (!empty($_POST['nUser']) || !empty($_POST['nPass']) || !empty($_POST['nName']) || !empty($_POST['nAccess'])) {
								echo "<script>alert('Complete All Fields!');</script>";
							}
						}

						$sql = "SELECT * FROM login";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<tr><td>". $row["username"]. "</td><td>". $row["password"]. "</td><td>". $row["name"]. "</td><td>". $row["access"]. "</td><td><a href='edituser.php?unique=". $row["username"]. "' onClick=\"window.open(this.href,'edit','height=272,width=300'); return false;\">Edit</a></td><td><a href='deluser.php?unique=". $row["username"]. "' onClick=\"window.open(this.href,'delete','height=161,width=160'); return false;\">Delete</a></td></tr>";
							}
						}
						$conn -> close();
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>