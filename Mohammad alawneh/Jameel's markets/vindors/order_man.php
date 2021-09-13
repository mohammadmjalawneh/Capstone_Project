<?php session_start();
if (!isset($_SESSION['vid'])) {
	header("Location:login.php");
}
include_once 'included/database.php';
include_once 'included/connect.php';
include_once 'included/header.php';
$OBJ = new DBO();
?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
						<p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered second" style="width:100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Costmer name</th>
										<th>Delivary Location</th>
										<th>Quantity</th>
										<th>Order date</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$C = 0;
									$total = 0;
									$Que = "SELECT * FROM orders";
									$res = mysqli_query($connect, $Que);
									while ($I = $res->fetch_assoc()) {
										$I2 = $OBJ->cos_info($I['cos_id']);
										$Que2 = "SELECT * FROM or_det where order_id=" . $I['or_id'];
										$re = mysqli_query($connect, $Que2);
										while ($T = $re->fetch_assoc()) {
											$I4 = $OBJ->getdata($T['pro_id']);
											if ($I4['vin_id'] == $_SESSION['vid']) {
												$total = $total + $T['pro_price'];
												$C++;
											}
										}
										if ($C != 0) {
											echo "<tr>";
											echo "<th>" . $I['or_id'] . "</th>";
											echo "<th>" . $I2['cos_fname'] . " " . $I2['cos_lname'] . "</th>";
											$Add = $OBJ->get_add($I['add_id']);
											echo "<th>" . $Add['country'] . " " . $Add['city'] . " " . $Add['sr_name'] . "St." . '</th>';
											echo "<th>" . $C . "</th>";
											echo "<th>" . $I['or_date'] . "</th>";
											echo "<th>" . $total . "</th>";
											echo "</tr>";
										}
										$C = 0;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once 'included/footer.php'; ?>