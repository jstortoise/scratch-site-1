<?php
	require 'share.php';
?>
<!-- Page Heading -->
<script src="js/addpost.js"></script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Transact
		</h1>
		<div class="col-lg-6">
			<h5>Add Stocks by inputting Details and Press Save</h5>

			<form action="#" role="form" method="POST" class="jumbotron">
				<div class="form-group">
					<label>Product:</label>
					<select class="form-control" onchange="run('AddDropDown.php','nDesc')" data-toggle="select" id="nType" name="nType">
					<?php
						//save all
						if (isset($_POST['save'])) {
							$sql = "select * from tempstocks where User = '$user'";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								//output data of each row
								while($row = $result->fetch_assoc()) {
									$sql2 = "select Product from stocks where Product = '" . $row["Product"]. "' and ProductType = '". $row["ProductType"]. "' and Description = '" . $row["Description"]. "' and ModelNo = '" . $row["ModelNo"]."'";

									$result2 = $conn->query($sql2);

									if ($result2->num_rows === 1) {
										$update = "update stocks set Quantity = ".$row["Quantity"]." + Quantity where Product = '" . $row["Product"]. "' and ProductType = '". $row["ProductType"]. "' and Description = '" . $row["Description"]. "' and ModelNo = '" . $row["ModelNo"]."'";

										$stocklog = "insert into stocklog(`TransactionID`, `StockID`, `Product`, `ProductType`, `Quantity`, `Unit`, `TimeIn`,`LastDateIn`,`LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`, `Action`) select '',`ID`, `Product`, `ProductType`, '".$row["Quantity"]."', `Unit`, now(),`LastDateIn`,`LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`,'add' from stocks where Product = '" . $row["Product"]. "' and ProductType = '". $row["ProductType"]. "' and Description = '" . $row["Description"]. "' and ModelNo = '" . $row["ModelNo"]."' ";

										$conn->query($stocklog);
										$conn->query($update);
									} else {
										$export = "insert into stocks (`ID`,`Product`, `ProductType`, `Quantity`,`Unit`, `LastDateIn`, `LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`) select concat(replace(curdate(),'-',''),ID),`Product`, `ProductType`, `Quantity`,`Unit`,concat('$user',' ',curdate()),'', `ModelNo`, `Price`, `Investment`, `Description`, `Remarks` from tempstocks where User = '$user' and Product = '" . $row["Product"]. "' and ProductType = '". $row["ProductType"]. "' and Description = '" . $row["Description"]. "' and ModelNo = '" . $row["ModelNo"]."' and ID ='" . $row["ID"]."'";
										
										$stocklog2 = "insert into stocklog (`TransactionID`,`StockID`,`Product`, `ProductType`, `Quantity`,`Unit`,`TimeIn`, `LastDateIn`, `LastDateTransacted`, `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`,`Action`) select '',concat(replace(curdate(),'-',''),ID),`Product`, `ProductType`, `Quantity`,`Unit`,now(),concat('$user',' ',curdate()),'', `ModelNo`, `Price`, `Investment`, `Description`, `Remarks`,'add' from tempstocks where User = '$user' and Product = '" . $row["Product"]. "' and ProductType = '". $row["ProductType"]. "' and Description = '" . $row["Description"]. "' and ModelNo = '" . $row["ModelNo"]."' and ID ='" . $row["ID"]."'";
										
										$conn->query($export);
										$conn->query($stocklog2);
									}
								}
							}
							
							$delete = "delete from tempstocks where 1";
							$conn->query($delete);
							echo "<script>alert('Saved to Stocks');</script>";
	//										echo "<center><h6>Saved to Stocks</h6></center>";
						}

						if (isset($_POST['nDesc'])) {
							$nID = $_POST['nDesc'];
							$Qty = $_POST['nQty'];
							$user = $_SESSION['user'];
							
							$insert = "INSERT INTO tempstocks (Product,ProductType,Quantity,Unit,ModelNo,Price,Investment,Description,Remarks,User) 
										SELECT Product,ProductType,'$Qty',Unit,ModelNo,Price,Investment,Description,Remarks,'$user' from stocks where ID = '$nID'";
							$conn->query($insert);
						} else {
							if (!empty($_POST['nUser']) || !empty($_POST['nPass']) || !empty($_POST['nName']) || !empty($_POST['nAccess'])) {
								echo "<script>alert('Complete All Fields!');</script>";
							}
						}

						$sql = "select distinct ProductType from stocks";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<option value='". $row["ProductType"]. "'>". $row["ProductType"]. "</option>";
							}
						}
					?>
					</select>
				</div>

				<div class="form-group">
					<label>Quantity:</label>
					<input class="form-control" placeholder="ex:10" name="nQty" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Description:</label>
					<select class="form-control" size="10" id = "nDesc" name = "nDesc" style="white-space:pre-wrap;"></select>
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
							<th>Product</th>
							<th>Type</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>ModelNo</th>
							<th>Price</th>
							<th>Investment</th>
							<th>Description</th>
							<th>Remarks</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = "select * from tempstocks where User = '$user'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							 //output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<tr><td>" . $row["Product"] . "</td><td>" . $row["ProductType"] . "</td><td>" . $row["Quantity"] . "</td><td>" . $row["Unit"] . "</td><td>" . $row["ModelNo"] . "</td><td>" . $row["Price"] . "</td><td>" . $row["Investment"] . "</td><td>" . $row["Description"] . "</td><td>" . $row["Remarks"] . "</td><td><a href='delrowtmp.php?unique=". $row["ID"]. "' onClick=\"window.open(this.href,'delete','height=161,width=160'); return false;\">Delete</a></td></tr>";
							}
						} 
						$conn -> close();
					?>
					</tbody>
				</table>
				
				<form action="#" role="form" method="POST" id="saveform">
					<input type="hidden" value="1" name="save">
					<button onclick="if(confirm('Are you sure to save?'))$('#saveform').submit();" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>