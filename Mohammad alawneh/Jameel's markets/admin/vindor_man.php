<?php session_start();
include_once 'included/database.php';
include_once 'included/connect.php';
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
if (isset($_POST['add_vi'])) {
	$Vi=new DBO();
	$imgname=$_FILES['img']['name'];
	if ($imgname=='') {
		$imgname=$vd['ad_img'];
	}
	else{
		$temp=$_FILES['img']['tmp_name'];
		$path="C:/xampp/htdocs/Projects/Jameel's markets/vindors/vinimg/";
		$imgname=time().$imgname;
		move_uploaded_file($temp,$path.$imgname);
	}
	$add=$Vi->advin($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['email'],$_POST['phone'],$_POST['pass'],
		$_POST['address'],$imgname,$_POST['bigcat'],$_SESSION['id']);
	header("Location:vindor_man.php");
}
if (isset($_GET['Eid'])) {
	$Vi=new DBO();
	$vd=$Vi->get_vin($_GET['Eid']);
}
if (isset($_POST['Ed_vi'])) {
	$VN=new DBO();
	$imgname=$_FILES['img']['name'];
	if ($imgname=='') {
		$imgname=$vd['vin_img'];
	}
	else{
		$temp=$_FILES['img']['tmp_name'];
		$path="C:/xampp/htdocs/Projects/Jameel's markets/vindors/vinimg/";
		$imgname=time().$imgname;
		move_uploaded_file($temp,$path.$imgname);
	}
	$VN->updvin($_GET['Eid'],$_SESSION['id'],$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['email'],$_POST['phone'],$_POST['pass'],$_POST['address'],$imgname,$vd['vin_status'],$_POST['bigcat']);
	header("Location:vindor_man.php");
}
if (isset($_GET['Did'])) {
	$D=new DBO();
	$D->dis_vin($_GET['Did']);
	header("Location:vindor_man.php");
}
if (isset($_GET['aid'])) {
	$D=new DBO();
	$D->act_vin($_GET['aid']);
	header("Location:vindor_man.php");
}
$OI=new DBO();
if(!$OI->chick_privileges($_SESSION['id'],3)){
	header("Location:index.php");
}
include_once 'included/header.php'; ?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<?php if (isset($_GET['Eid'])) {
						echo "<h5 class='card-header'>Edit Vindor Form</h5>";
					}else{
						echo "<h5 class='card-header'>Add Vindor Form</h5>";
					} 
					?>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="inputEmail">First Name</label>
								<input id="inputEmail" type="text" name="fname" required="" placeholder="Enter First Name" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_fname'];
								 }
								 ?>" 
								>
							</div>
							<div class="form-group">
								<label for="inputEmail">Middle Name</label>
								<input id="inputEmail" type="text" name="mname" required="" placeholder="Enter Middle Name" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_mname'];
								 }
								 ?>"
								>
							</div>
							<div class="form-group">
								<label for="inputEmail">Last Name</label>
								<input id="inputEmail" type="text" name="lname" required="" placeholder="Enter Last Name" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_lname'];
								 }
								 ?>"
								>
							</div>
							<div class="form-group">
								<label for="inputEmail">Email address</label>
								<input id="inputEmail" type="email" name="email" required="" placeholder="Enter email" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_email'];
								 }
								 ?>"
								>
							</div>
							<div class="form-group">
								<label for="inputEmail">Category</label>
								<select class="form-control" name="bigcat">
									<?php
									if (isset($_GET['Eid'])) {
										$VC=new DBO();
										$CA=$VC->get_cat($vd['bigcat_id']);
										echo "<option value='{$CA['bigcat_id']}'>{$CA['bigcat_name']}</option>";
									}
									echo "<option>Select Category</option>";
									$Que="SELECT * FROM bigcat";
									$res=mysqli_query($connect,$Que);
									while ($cat=$res->fetch_assoc()){
										echo "<option value='{$cat['bigcat_id']}'>{$cat['bigcat_name']}</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputEmail">Mobile Number</label>
								<input id="inputEmail" type="Number" name="phone" required="" placeholder="Enter Phone" class="form-control xphone-inputmask" id="xphone-mask" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_mobile'];
								 }
								 ?>"
								>
							</div>
							<div class="form-group">
								<label for="inputEmail">Address</label>
								<input id="inputEmail" type="text" name="address" required="" placeholder="Enter Address" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_address'];
								 }
								 ?>"
								>
							</div>
							<div class="form-group">
								<label for="inputPassword">Password</label>
								<input id="inputPassword" type="password" name="pass" placeholder="Password" required="" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_pass'];
								 }
								 ?>">
							</div>
							<div class="form-group">
								<label for="inputRepeatPassword">Repeat Password</label>
								<input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" required="" placeholder="Password" class="form-control" value="<?php
								 if(isset($_GET['Eid'])){
								 	echo $vd['vin_pass'];
								 }
								 ?>"
								>
							</div>
							<?php
							if (isset($_GET['Eid'])) {
								$Go;
							 	$Go="<div class='card' id='images'>
								<h5 class='card-header'>Images</h5>
								<div class='card-body'>";
								$Go=$Go.'<img src="';
								$Go=$Go."../vindors/vinimg/".$vd['vin_img']; 
								$Go=$Go.'" class="img-fluid mr-3" alt="Responsive image"
									style="height: 200px;width: 150px;">
								</div>
							</div>';
							echo $Go;
							 } 
							?>
							<div class="custom-file mb-3">
								<?php if (isset($_GET['Eid'])){
									echo "<input type='file' name='img' class='custom-file-input' id='customFile'>";
								}
								else{
									echo "<input type='file' name='img' class='custom-file-input' id='customFile' required=''>";
								}
								?>
								<label class="custom-file-label" for="customFile">File Input</label>
							</div>
							<div class="row">
								<div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
									<label class="be-checkbox custom-control custom-checkbox">
									</label>
								</div>
								<div class="col-sm-6 pl-0">
									<p class="text-right">
										<?php if (isset($_GET['Eid'])) {
											echo "<button type='submit' class='btn btn-space btn-primary' name='Ed_vi'>Edit</button>";
										}
										else{
											echo "<button type='submit' class='btn btn-space btn-primary' name='add_vi'>Submit</button>";
										}
										?>
										<a href="Cat_man.php" class="btn btn-space btn-secondary">Cancel</a>
									</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Vindors Table</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered second" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>category</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Start Date</th>
										<th>Status</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$AdQue="SELECT * FROM vindor";
									$ReQue=mysqli_query($connect,$AdQue);
									while ($vi=$ReQue->fetch_assoc()){
										echo "<tr>";
										echo "<td>".$vi['vin_fname'].' '.$vi['vin_lname']."</td>";
										echo"<td>{$vi['vin_email']}</td>";
										$CaQue="SELECT * FROM bigcat WHERE bigcat_id=".$vi['bigcat_id'];
										$Recat=mysqli_query($connect,$CaQue);
										$Cat=$Recat->fetch_assoc();
										echo"<td>{$Cat['bigcat_name']}</td>";
										echo"<td>{$vi['vin_mobile']}</td>
										<td>{$vi['vin_address']}</td>
										<td>{$vi['vin_sdate']}</td>";

										if ($vi['vin_status']) {
											echo "<td>Active</td>";
										}else{
											echo "<td>Desactive</td>";
										}
										echo "<td><a href='vindor_man.php?Eid={$vi['vin_id']}' class='btn btn-outline-warning'>Edit</a></td>";
										if ($vi['vin_status']) {
											echo "<td><a href='vindor_man.php?Did={$vi['vin_id']}' class='btn btn-outline-danger'>Deactive</a></td>";
										}else{
											echo "<td><a href='ad_man.php?aid={$vi['vin_id']}' class='btn btn-outline-success'>Active</a></td>";
										}
										
										echo"</tr>";
									} 
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>category</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Start Date</th>
										<th>Status</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once 'included/footer.php'; ?>