<?php
	require 'share.php';
?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			View Stocks
		</h1>

		<form action="#" role="form" method="POST" id="form">

			<div class="form-group col-lg-2" style="float: left; margin-right: 2px; padding-left: 0;">
				<select class="form-control" name = "nType">
					<option value="TransactionID">TransactionID</option>
					<option value="DocumentNo">Document No</option>
					<option value="Name">Name</option>
					<option value="Address">Address</option>
					<option value="Telephone">Telephone</option>
					<option value="Date">Date</option>
					<option value="Tax">Tax</option>
					<option value="TotalPrice">Total Price</option>
					<option value="DiscountAmt">Discount Amount</option>
					<option value="AmountPaid">Amount Paid</option>
					<option value="ChangeAmt">Change</option>
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
						<th>TransactionID</th>
						<th>DocumentNo</th>
						<th>Name</th>
						<th>Address</th>
						<th>Telephone</th>
						<th>Remarks</th>
						<th>Date</th>
						<th>Tax</th>
						<th>TotalPrice</th>
						<th>DiscountAmt</th>
						<th>AmountPaid</th>
						<th>Change</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (isset($_POST['nLike'])) {
						$Like = $_POST['nLike'];
						$Type = $_POST['nType'];
						$sql = "Select * from transaction where `$Type` like '%$Like%' order by TransactionID desc";
					} else {
						$sql = "select * from transaction order by TransactionID desc";
					}
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {
							echo "<tr><td>". $row["TransactionID"]. "</td><td>". $row["DocumentNo"]. "</td><td>". $row["Name"]. "</td><td>". $row["Address"]. "</td><td>". $row["Telephone"]. "</td><td>". $row["Remarks"]. "</td><td>". $row["Date"]. "</td><td>". $row["Tax"]. "</td><td>". $row["TotalPrice"]. "</td><td>". $row["DiscountAmt"]. "</td><td>". $row["AmountPaid"]. "</td><td>". $row["ChangeAmt"]. "</td><td><a href='index.php?page=viewItems&unique=". $row["TransactionID"]. "'>Items</a></td></tr>";
						}
					}
					$conn -> close();
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>