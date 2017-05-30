<?php
	require 'share.php';
?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Edit/Delete Stocks
		</h1>

		<form action="#" role="form" method="POST" id="form">

			<div class="form-group col-lg-2" style="float: left; margin-right: 2px; padding-left: 0;">
				<select class="form-control" name = "nType">
					<option value="Product">Product</option>
					<option value="ProductType">Product Type</option>
					<option value="Quantity">Quantity</option>
					<option value="Unit">Unit</option>
					<option value="LastDateIn">Last Date In</option>
					<option value="LastDateTransacted">Last Date Transacted</option>
					<option value="ModelNo">Model No</option>
					<option value="Price">Price</option>
					<option value="Investment">Investment</option>
					<option value="Location">Location</option>
					<option value="Remarks">Remarks</option>
				</select>
			</div>

			<div class="form-group input-group col-lg-2" style="float: left;">
				<input type="text" class="form-control" placeholder="Type Keyword" name="nLike">
				<span class="input-group-btn"><button class="btn btn-default" type="button" onclick="$('#form').submit();"><i class="fa fa-search"></i></button></span>
			</div>
			<div style="clear: both;"></div>
		</form>
	</div>
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Product</th>
						<th>Type</th>
						<th>Quantity</th>
						<th>Unit</th>
						<th>Last Date In(y-m-d)</th>
						<th>Last Date Out(y-m-d)</th>
						<th>Model No</th>
						<th>Price</th>
						<th>Investment</th>
						<th>Description</th>
						<th>Remarks</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (isset($_POST['nLike'])) {
						$Like = $_POST['nLike'];
						$Type = $_POST['nType'];
						$sql = "Select * from stocks where `$Type` like '%$Like%' order by ID desc";
					} else {
						$sql = "select * from stocks order by ID desc";
					}
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {
							echo "<tr><td>". $row["Product"]. "</td><td>". $row["ProductType"]. "</td><td>". $row["Quantity"]. "</td><td>". $row["Unit"]. "</td><td>". $row["LastDateIn"]. "</td><td>". $row["LastDateTransacted"]. "</td><td>". $row["ModelNo"]. "</td><td>". $row["Price"]. "</td><td>". $row["Investment"]. "</td><td>". $row["Description"]. "</td><td>". $row["Remarks"]. "</td><td><a href='editrowstcks.php?unique=". $row["ID"]. "' onClick=\"window.open(this.href,'edit','height=646,width=310'); return false;\">Edit</a></td><td><a href='delrowstcks.php?unique=". $row["ID"]. "' onClick=\"window.open(this.href,'delete','height=161,width=160'); return false;\">Delete</a></td></tr>";
						}
					}
					$conn -> close();
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>