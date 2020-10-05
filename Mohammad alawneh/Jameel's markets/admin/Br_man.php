<?php session_start();
include_once 'included/database.php';
include_once 'included/connect.php';
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
if (isset($_GET['aid'])) {
	$AC=new DBO();
	$AC->act_bra($_GET['aid']);
	header("Location:Br_man.php");
}
if (isset($_GET['eid'])) {
	$ED=new DBO();
	$BI=$ED->get_bra($_GET['eid']);
	header("Location:Br_man.php");
}
if (isset($_GET['did'])) {
	$DC=new DBO();
	$DC->dis_bra($_GET['did']);
	header("Location:Br_man.php");
}if (isset($_POST['edtbrand'])) {
	$UI=new DBO();
	$imgname=$_FILES['img']['name'];
	if ($imgname!='') {
		$temp=$_FILES['img']['tmp_name'];
		$path="C:/xampp/htdocs/Projects/Jameel's markets/img/brimg/";
		$imgname=time().$imgname;
		move_uploaded_file($temp,$path.$imgname);
	}else{
		$imgname=$BI['br_img'];
	}
	$UI->upd_bra($_POST['br_name'],$imgname,$_POST['bigcat'],$_GET['eid']);
	
}
if (isset($_POST['addbrand'])) {
	$AD=new DBO();
	$imgname=$_FILES['img']['name'];
	$temp=$_FILES['img']['tmp_name'];
	$path="C:/xampp/htdocs/Projects/Jameel's markets/img/brimg/";
	$imgname=time().$imgname;
	move_uploaded_file($temp,$path.$imgname);
	$AD->add_br($_POST['br_name'],$imgname,$_POST['bigcat']);
}
include_once 'included/header.php'; ?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Brand Form</h5>
					<div class="card-body">
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Name</label>
								<div class="col-9 col-lg-10">
									<input id="inputEmail2" type="text" required="" placeholder="Brand Name" class="form-control" name="br_name" value="<?php if(isset($_GET['eid'])){echo $BI['br_name'];} ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword2" class="col-3 col-lg-2 col-form-label text-right">Category</label>
								<div class="col-9 col-lg-10">
									<select name="bigcat" class="form-control" required="">	
										<?php
										if (isset($_GET['eid'])) {
											$I=new DBO();
											$I2=$I->get_cat($BI['bigcat_id']);
										 	echo "<option value='{$BI['bigcat_id']}'>{$I2['bigcat_name']}</option>";

										}
										echo "<option value=''>Select Category</option>"; 
										$Que="SELECT * FROM bigcat";
										$res=mysqli_query($connect,$Que);
										while ($CN=$res->fetch_assoc()) {
										 	echo "<option value='{$CN['bigcat_id']}'>{$CN['bigcat_name']}</option>";
										 } 
										?>
									</select>
								</div>
							</div>
							<?php
							if (isset($_GET['eid'])) {
								$Go;
								$Go="<div class='card' id='images'>
								<h5 class='card-header'>Images</h5>
								<div class='card-body'>";
								$Go=$Go.'<img src="';
								$Go=$Go."../img/brimg/".$BI['br_img']; 
								$Go=$Go.'" class="img-fluid mr-3" alt="Responsive image"
								style="height: 200px;width: 250px;">
								</div>
								</div>';
								echo $Go;
							} 
							?>
							<div class="custom-file mb-3">
								<?php if (isset($_GET['eid'])) {
									echo "<input type='file' name='img' class='custom-file-input' id='customFile'>";
								}else{
									echo "<input type='file' name='img' required='' class='custom-file-input' id='customFile'>";
								
								}
								 ?>
								
								<label class="custom-file-label" for="customFile">File Input</label>
							</div>
							<div class="row pt-2 pt-sm-5 mt-1">
								<div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
								</div>
								<div class="col-sm-6 pl-0">
									<p class="text-right">
										<?php if (isset($_GET['eid'])) {
											echo "<button type='submit' class='btn btn-space btn-primary' name='edtbrand'>Update</button>";
										}else{
											echo "<button type='submit' class='btn btn-space btn-primary' name='addbrand'>Submit</button>";
										} 
										?>
										<a href="Br_man.php" class="btn btn-space btn-secondary">Cancel</a>
									</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Responsive Table</h5>
					<div class="card-body">
						<div class="table-responsive ">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Brand</th>
										<th scope="col">Big Category</th>
										<th scope="col">Brand Image</th>
										<th scope="col">Status</th>
										<th scope="col">Edit</th>
										<th scope="col">Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$Que="SELECT * FROM brand";$BC=new DBO();
									$res=mysqli_query($connect,$Que);
									while ($ref=$res->fetch_assoc()) {
										echo "<tr>";
										echo "<th scope='row'>{$ref['br_id']}</th>";
										echo "<th scope='row'>{$ref['br_name']}</th>";
										$BCI=$BC->get_cat($ref['bigcat_id']);
										echo "<th scope='row'>{$BCI['bigcat_name']}</th>";
										echo "<th scope='row'>{$ref['br_img']}</th>";
										if ($BCI['bigcat_sta']) {
											if ($ref['br_sta']) {
												echo "<td class='text-success'>Active</td>";
												echo "<td><a href='Br_man.php?eid={$ref['br_id']}' class='btn btn-outline-warning'>Edit</a></td>";
												echo "<td><a href='Br_man.php?did={$ref['br_id']}' class='btn btn-outline-danger'>Deactivate</a></td>";
											}else{
												echo "<td class='text-danger'>Brand Disactive</td>";
												echo "<td></td>";
												echo "<td><a href='Br_man.php?aid={$ref['br_id']}' class='btn btn-outline-success'>Activate</a></td>";
											}
										}else{
											echo "<td class='text-danger'>Big Category Disactive</td>";
											echo "<td></td>";
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