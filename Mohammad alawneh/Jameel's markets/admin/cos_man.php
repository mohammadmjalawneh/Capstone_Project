<?php ob_start();
session_start();
include_once 'included/connect.php';
include_once 'included/database.php';
include_once 'included/header.php';
if (isset($_GET['aid'])) {
	$OBJ=new DBO();
	$OBJ->act_cos($_GET['aid']);
	header('Location:cos_man.php');
}
if (isset($_GET['did'])) {
	$OBJ=new DBO();
	$OBJ->diact_cos($_GET['did']);
	header('Location:cos_man.php');
}
if (isset($_GET['eid'])) {
	$OBJ=new DBO();
	$I3=$OBJ->get_cos($_GET['eid']);
}
if (isset($_POST['submit'])) {
	$OBJ=new DBO();
	$OBJ->add_cos($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['email'],$_POST['password'],$_POST['mobile']);
}
if (isset($_POST['edit'])) {
	$OBJ=new DBO();
	$OBJ->up_cos($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['email'],$_POST['password'],$_POST['mobile'],$_GET['eid']);
	header('Location:cos_man.php');
}
$OI=new DBO();
if(!$OI->chick_privileges($_SESSION['id'],5)){
	header("Location:index.php");
}
?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<!-- ============================================================== -->
			<!-- basic form -->
			<!-- ============================================================== -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<?php 
					if (isset($_GET['eid'])) {
						echo "<h5 class='card-header'>Edit costmer</h5>";
					}else{
						echo "<h5 class='card-header'>add costmer</h5>";
					}
					?>
					<div class="card-body">
						<form action="#" id="basicform" method="POST" data-parsley-validate="">
							<div class="form-group">
								<label for="inputfName">First Name</label>
								<input id="inputfName" type="text" name="fname" data-parsley-trigger="change" required="" placeholder="Enter first name" autocomplete="off" class="form-control" value="<?php if(isset($_GET['eid'])){
									echo $I3['cos_fname'];
								} ?>">
							</div>
							<div class="form-group">
								<label for="inputmName">Mid. Name</label>
								<input id="inputmName" type="text" name="mname" data-parsley-trigger="change" required="" placeholder="Enter Mid. name" autocomplete="off" class="form-control" value="<?php if(isset($_GET['eid'])){
									echo $I3['cos_mname'];
								} ?>">
							</div>
							<div class="form-group">
								<label for="inputlName">Last Name</label>
								<input id="inputlName" type="text" name="lname" data-parsley-trigger="change" required="" placeholder="Enter last name" autocomplete="off" class="form-control" value="<?php if(isset($_GET['eid'])){
									echo $I3['cos_lname'];
								} ?>">
							</div>
							<div class="form-group">
								<label for="inputEmail">Email address</label>
								<input id="inputEmail" type="email" name="email" data-parsley-trigger="change" required="" placeholder="Enter email" autocomplete="off" class="form-control" value="<?php if(isset($_GET['eid'])){echo $I3['cos_email'];} ?>">
							</div>
							<div class="form-group">
								<label for="inputPassword">Password</label>
								<input id="inputPassword" type="password" placeholder="Password" required="" class="form-control" name="password" value="<?php if(isset($_GET['eid'])){echo $I3['cos_pass'];}?>">
							</div>
							<div class="form-group">
								<label for="inputRepeatPassword">Repeat Password</label>
								<input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" required="" placeholder="Password" class="form-control" value="<?php if(isset($_GET['eid'])){echo $I3['cos_pass'];}?>">
							</div>
							<div class="form-group">
								<label for="inputEmail">Mobile phone</label>
								<input id="xphone-mask" type="text" name="mobile" required="" placeholder="Mobile phone"  class="form-control" value="<?php if(isset($_GET['eid'])){echo $I3['cos_mobile'];} ?>">
							</div>
							<div class="row">
								<div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
								</div>
								<div class="col-sm-6 pl-0">
									<p class="text-right">
										<?php 
										if (isset($_GET['eid'])) {
											echo "<button type='submit' name='edit' class='btn btn-space btn-primary'>Edit</button>";
										}else{
											echo "<button type='submit' name='submit' class='btn btn-space btn-primary'>Submit</button>";
										}
										?>
										<button class="btn btn-space btn-secondary">Cancel</button>
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
						<h5 class="mb-0">Order Details</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered second" style="width:100%">
								<thead>
									<tr>
										<th>#</th>
										<th>full name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Status</th>
										<th>Edit</th>
										<th>Deavivate</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$Que="SELECT * FROM customer";
									$res=mysqli_query($connect,$Que);
									while ($I=$res->fetch_assoc()) {
										echo "<tr>";
										echo "<td>{$I['cos_id']}</td>";
										echo "<td>".$I['cos_fname']." ".$I['cos_lname']."</td>";
										echo "<td>{$I['cos_email']}</td>";
										echo "<td>{$I['cos_mobile']}</td>";
										if ($I['cos_status']) {
											echo "<td class='text-success'>Active</td>";
											echo "<td><a href='cos_man.php?eid={$I['cos_id']}' class='btn btn-outline-warning'>Edit</a></td>";
											echo "<td><a href='cos_man.php?did={$I['cos_id']}' class='btn btn-outline-danger'>Deactivate</a></td>";
										}else{
											echo "<td class='text-danger'>Disactive</td>";
											echo "<td></td>";
											echo "<td><a href='cos_man.php?aid={$I['cos_id']}' class='btn btn-outline-success'>Activate</a></td>";
										}
										echo "</tr>";
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>#</th>
										<th>full name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Status</th>
										<th>Edit</th>
										<th>Deavivate</th>
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