<?php
	require 'share.php';
	$unique = $_REQUEST['unique'];
?>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			View Items of Transaction: <?php echo $unique;?>
		</h1>
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>TransactionID</th>
						<th>StockID</th>
						<th>LineItem</th>
						<th>DocumentNo</th>
						<th>Quantity</th>
						<th>Unit</th>
						<th>Description</th>
						<th>UnitPrice</th>
						<th>QtyxPrice</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$sql = "select * from transactionline where TransactionID = $unique order by LineItem";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {
							echo "<tr><td>". $row["TransactionID"]. "</td><td>". $row["StockID"]. "</td><td>". $row["LineItem"]. "</td><td>". $row["DocumentNo"]. "</td><td>". $row["Quantity"]. "</td><td>". $row["Unit"]. "</td><td>". $row["Description"]. "</td><td>". $row["UnitPrice"]. "</td><td>". $row["QtyxPrice"]. "</td><td>". $row["Remarks"]. "</td></tr>";
						}
					}
					$conn -> close();
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>