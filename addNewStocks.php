<?php
	require 'share.php';
?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Add New Stocks
		</h1>
		<div class="col-lg-6">
			<h5>Add Stocks by inputting Details and Press Save</h5>

			<form action="#" role="form" method="POST" class="jumbotron">
				<div class="form-group">
					<label>Product:</label>
					<input class="form-control" placeholder="Product" name="nProd" id="nProd" autocomplete="off">
					</select>
				</div>

				<div class="form-group">
					<label>Type:</label>
					<input class="form-control" placeholder="Product Type" name="nType" id="nType" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Quantity:</label>
					<input class="form-control" placeholder="Quantity" name="nQty" id="nQty" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Unit of Measure:</label>
					<input class="form-control" placeholder="PCS" name="nUOM" id="nUOM" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Model No:</label>
					<input class="form-control" placeholder="Model No" name="nMod" id="nMod" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Price:</label>
					<input class="form-control" placeholder="Price" name="nPrice" id="nPrice" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Investment</label>
					<input class="form-control" placeholder="Investment" name="nInv" id="nInv" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Description:</label>
					<input class="form-control" placeholder="Description" name="nDes" id="nDes" autocomplete="off">
				</div>

				<div class="form-group">
					<label>Remarks:</label>
					<input class="form-control" placeholder="Remarks" name="nRem" id="nRem" autocomplete="off">
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

						if (isset($_POST['nProd'])) {
							$user = $_SESSION['user'];
						}
						if (isset($_POST['nProd']) && isset($_POST['nType']) && isset($_POST['nQty']) && isset($_POST['nMod']) && isset($_POST['nPrice']) && isset($_POST['nInv']) && !empty($_POST['nProd']) && !empty($_POST['nType'])&& !empty($_POST['nQty']) && !empty($_POST['nMod']) && !empty($_POST['nPrice']) && !empty($_POST['nInv'])) {
							$Prod = $_POST['nProd'];
							$Type = $_POST['nType'];
							$Qty = $_POST['nQty'];
							$Mod = $_POST['nMod'];
							$Price = $_POST['nPrice'];
							$Inv = $_POST['nInv'];
							$Des = $_POST['nDes'];
							$Rem = $_POST['nRem'];
							$UOM = $_POST['nUOM'];
							$datie = date("Y-m-d H:m:s");
							$insert = "INSERT INTO tempstocks (Product, ProductType, Quantity, Unit, ModelNo, Price, Investment, Description, Remarks, User) VALUES ('$Prod', '$Type', '$Qty', '$UOM', '$Mod', '$Price', '$Inv', '$Des', '$Rem', '$user')";
							$conn->query($insert);
						}
						$sql = "select * from tempstocks where User = '$user'";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								echo "<tr><td>" . $row["Product"] . "</td><td>". $row["ProductType"] . "</td><td>" . $row["Quantity"]. "</td><td>" . $row["Unit"] . "</td><td>" . $row["ModelNo"]. "</td><td>" . $row["Price"] . "</td><td>" . $row["Investment"]. "</td><td>" . $row["Description"] . "</td><td>". $row["Remarks"] . "</td><td><a href='delrowtmpnew.php?unique=". $row["ID"] . "' onClick=\"window.open(this.href,'delete','height=161,width=160'); return false;\">Delete</a></td></tr>";
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
