<?php session_start();
include_once 'included/header.php';
include_once 'included/database.php';
$OI=new DBO();
if(!$OI->chick_privileges($_SESSION['id'],4)){
	header("Location:index.php");
}
?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Order Details</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered second" style="width:100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Costmer name</th>
										<th>Order Date</th>
										<th>Delivary Location</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Status</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$OJ=new DBO();
									$Que="SELECT * FROM orders";
									$res=mysqli_query($connect,$Que);
									while ($I=$res->fetch_assoc()) {
										echo "<tr>";
												echo "<th>{$I['or_id']}</th>";
												$C=$OJ->get_cos($I['cos_id']);
												echo "<th>".$C['cos_fname']." ".$C['cos_lname']."</th>";
												echo "<th>{$I['or_date']}</th>";
												$AD=$OJ->get_add($I['add_id']);
												echo '<th>'.$AD['country']." ".$AD['city']." ".$AD['sr_name']."St."."</th>";
												$QTY=$OJ->get_qty($I['or_id']);
												echo "<th>{$QTY['COUNT(order_d_id)']}</th>";
												echo "<th>{$I['total']}</th>";
												if ($I['or_status']) {
													echo "<td>Active</td>";
													echo "<td><a href='order_man.php?Did={$I['or_id']}' class='btn btn-danger'>Deactive</a></td>";
												}else{
													echo "<td>Disactive</td>";
													echo "<td></td>";
												}
										echo "</tr>";
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