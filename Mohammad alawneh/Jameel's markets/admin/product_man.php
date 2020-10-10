<?php
include_once 'included/database.php';
include_once 'included/connect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
if (isset($_GET['Did'])) {
	$De=new DBO();
	$De->delpro($_GET['Did']);
	header('Location:product_man.php');
}
if (isset($_GET['aid'])) {
	$De=new DBO();
	$De->actpro($_GET['aid']);
	header('Location:product_man.php');
}
$OI=new DBO();
if(!$OI->chick_privileges($_SESSION['id'],6)){
	header("Location:index.php");
}
include_once 'included/header.php'; ?>
<style type="text/css">
	textarea {
		resize: none;
	}
</style>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Your Product Table</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered second" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>category</th>
										<th>Price</th>
										<th>Descount</th>
										<th>Subcat</th>
										<th>Brand</th>
										<th>Quantity</th>
										<th>vindor</th>
										<th>Status</th>
										<th>Enable or Disable</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$Que="SELECT * FROM product";
									$res=mysqli_query($connect,$Que);
									while ($pro=$res->fetch_assoc()) {
										echo "<td>".$pro['pro_name']."</td>";
										echo "<td>".$pro['pro_desc']."</td>";
										$cef="SELECT * FROM bigcat WHERE bigcat_id=".$pro['bigcat_id'];
										$cf=mysqli_query($connect,$cef);
										$cat=$cf->fetch_assoc();
										echo "<td>".$cat['bigcat_name']."</td>";
										echo "<td>".$pro['pro_price']."</td>";
										echo "<td>".$pro['pro_descount']."</td>";
										$SubQue="SELECT * FROM subcat WHERE subcat_id=".$pro['subcat_id'];
										$SubRes=mysqli_query($connect,$SubQue);
										$Subcat=$SubRes->fetch_assoc();
										echo "<td>".$Subcat['subcat_name']."</td>";
										$BraQue="SELECT * FROM brand WHERE br_id=".$pro['br_id'];
										$BraRes=mysqli_query($connect,$BraQue);
										$Bra=$BraRes->fetch_assoc();
										echo "<td>".$Bra['br_name']."</td>";
										echo "<td>".$pro['pro_qty']."</td>";
										$Qu="SELECT * FROM vindor WHERE vin_id=".$pro['vin_id'];
										$ref=mysqli_query($connect,$Qu);
										$vin_name=$ref->fetch_assoc();
										echo "<td>".$vin_name['vin_fname'].' '.$vin_name['vin_lname']."</td>";
										if ($cat['bigcat_sta']) {
											if ($Subcat['subcat_sta']) {
												if ($Bra['br_sta']) {
													if ($pro['pro_sta']) {
														echo "<td style='color:green'>Active</td>";
														echo"<td><a href='product_man.php?Did={$pro['pro_id']}' class='btn btn-outline-danger'>Disactive Product</a></td>";
													}else{
														echo"<td><a href='product_man.php?aid={$pro['pro_id']}' class='btn btn-rounded btn-primary'>Active Product</a></td>";
														echo "<td style='color:red'>Disactive</td>";
													}
												}else{
													echo "<td class='text-danger'>Brand Disactive</td>";
													echo "<td></td>";
												}
											}else{
												echo "<td class='text-danger'>Sub Category Disactive</td>";
												echo "<td></td>";
											}
										}else{
											echo "<td class='text-danger'>Big Category Disactive</td>";
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