<?php
ob_start();
include_once 'included/connect.php';
include_once 'included/database.php';

session_start();
if (!$_SESSION['id'] == 3) {
	header("Location:login.php");
}
if (isset($_GET['Eid'])) {
	$Te = new DBO();
	$Adm = $Te->get_admin($_GET['Eid']);
}
if (isset($_GET['Did'])) {
	$De = new DBO();
	$De->Del_admin($_GET['Did']);
	header("Location:ad_man.php");
}
if (isset($_GET['aid'])) {
	$Ac = new DBO();
	$Ac->Act_admin($_GET['aid']);
	header("Location:ad_man.php");
}
if (isset($_POST['add_ad'])) {
	$Ad = new DBO();
	$imgname = $_FILES['img']['name'];
	$temp = $_FILES['img']['tmp_name'];
	$path = 'adimg/';
	$imgname = time() . $imgname;
	move_uploaded_file($temp, $path . $imgname);
	$Ad->add_admin($_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['email'], $_POST['pass'], $imgname, $_POST['phone'], $_POST['address']);
	if (!empty($_POST['Privelges'])) {
		$ID = $Ad->chick_admin($_POST['email'], $_POST['pass']);
		foreach ($_POST['Privelges'] as $key => $value) {
			$Ad->add_prvlage($ID['ad_id'], $value);
		}
	}
	header("Location:ad_man.php");
}
if (isset($_POST['Edit_ad'])) {
	$Ed = new DBO();
	$imgname = $_FILES['img']['name'];
	if ($imgname == '') {
		$imgname = $Adm['ad_img'];
	} else {
		$temp = $_FILES['img']['tmp_name'];
		$path = 'adimg/';
		$imgname = time() . $imgname;
		move_uploaded_file($temp, $path . $imgname);
	}
	$Ed->Edit_admin($_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['email'], $_POST['pass'], $imgname, $_POST['phone'], $_POST['address'], $_GET['Eid']);
	$Ed->drop_priv($_GET['Eid']);
	foreach ($_POST['Privelges'] as $key => $value) {
		$Ed->add_prvlage($_GET['Eid'], $value);
	}
	header("Location:ad_man.php");
}
include_once 'included/header.php';
$OI = new DBO();
if (!$OI->chick_privileges($_SESSION['id'], 1)) {
	header("Location:index.php");
}
?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<?php
					if (isset($_GET['Eid'])) {
						echo "<h5 class='card-header'>Edit Admin</h5>";
					} else {
						echo "<h5 class='card-header'>Add Admin</h5>";
					}
					?>
					<div class="card-body">
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="inputEmail">First Name</label>
								<input type="text" name="fname" data-parsley-trigger="change" required="" placeholder="Enter First Name" value="<?php
																																				if (isset($_GET['Eid'])) {
																																					echo $Adm['ad_fname'];
																																				}
																																				?>" autocomplete="off" class="form-control">
							</div>
							<div class="form-group">
								<label for="inputEmail">Middle name</label>
								<input type="name" name="mname" data-parsley-trigger="change" required="" placeholder="Enter Middle name" value="<?php
																																					if (isset($_GET['Eid'])) {
																																						echo $Adm['ad_mname'];
																																					}
																																					?>" autocomplete="off" class="form-control">
							</div>
							<div class="form-group">
								<label for="inputEmail">Last name</label>
								<input type="text" name="lname" data-parsley-trigger="change" required="" placeholder="Enter Last name" value="<?php
																																				if (isset($_GET['Eid'])) {
																																					echo $Adm['ad_lname'];
																																				}
																																				?>" autocomplete="off" class="form-control">
							</div>
							<div class="form-group">
								<label for="inputEmail">Email address</label>
								<input id="inputEmail" type="email" name="email" data-parsley-trigger="change" required="" placeholder="Enter email" value="<?php
																																							if (isset($_GET['Eid'])) {
																																								echo $Adm['ad_email'];
																																							}
																																							?>" autocomplete="off" class="form-control">
							</div>
							<div class="form-group">
								<label for="inputPassword">Password</label>
								<input id="inputPassword" name="pass" type="password" placeholder="Password" required="" class="form-control" value="<?php
																																						if (isset($_GET['Eid'])) {
																																							echo $Adm['ad_pass'];
																																						}
																																						?>">
							</div>
							<div class="form-group">
								<label for="inputRepeatPassword">Repeat Password</label>
								<input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" required="" placeholder="Password" class="form-control" value="<?php
																																														if (isset($_GET['Eid'])) {
																																															echo $Adm['ad_pass'];
																																														}
																																														?>">
							</div>
							<div class="form-group">
								<label for="inputRepeatPassword">Phone Number</label>
								<input type="tel" name="phone" class="form-control xphone-inputmask" id="xphone-mask" placeholder="Phone Number" value="<?php
																																						if (isset($_GET['Eid'])) {
																																							echo $Adm['ad_phone'];
																																						}
																																						?>">
							</div>
							<div class="form-group">
								<h4>Privelges</h4>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="1" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Admin</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="2" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Vindors</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="3" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Costmers</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="4" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Catgorise & Sub. cat</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="5" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Brands</span>
								</label>

								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="6" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Product</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" value="7" class="custom-control-input" name="Privelges[]"><span class="custom-control-label">Orders</span>
								</label>
							</div>
							<div class="form-group">
								<label for="inputRepeatPassword">Address</label>
								<input type="tel" name="address" placeholder="Address" class="form-control" value="<?php
																													if (isset($_GET['Eid'])) {
																														echo $Adm['ad_address'];
																													}
																													?>">
							</div>
							<?php
							if (isset($_GET['Eid'])) {
								$Go;
								$Go = "<div class='card' id='images'>
								<h5 class='card-header'>Images</h5>
								<div class='card-body'>";
								$Go = $Go . '<a href="adimg/' . $Adm['ad_img'] . '">
								<img src=';
								$Go = $Go . '"adimg/' . $Adm['ad_img'];
								$Go = $Go . '" class="img-fluid mr-3" alt="Responsive image"
									style="height: 200px;width: 150px;"></a>
								</div>
							</div>';
								echo $Go;
							}
							?>
							<div class="custom-file mb-3">
								<?php if (isset($_GET['Eid'])) {
									echo "<input type='file' name='img' class='custom-file-input' id='customFile'>";
								} else {
									echo "<input type='file' name='img' class='custom-file-input' id='customFile' required=''>";
								}
								?>

								<label class="custom-file-label" for="customFile">File Input</label>
							</div>
							<div class="form-group">
								<?php
								if (isset($_GET['Eid'])) {
									echo "<button type='submit' name='Edit_ad' class='btn btn-space btn-primary'>Edit Admin</button>";
								} else {
									echo "<button type='submit' name='add_ad' class='btn btn-space btn-primary'>Add Admin</button>";
								}
								?>
								<a href="ad_man.php" class='btn btn-space btn-primary'>Cancel</a>
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
						<h5 class="mb-0">Admin Information</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered second" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Privelges</th>
										<th>Status</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$AdQue = "SELECT * FROM admin";
									$ReQue = mysqli_query($connect, $AdQue);
									while ($Ad = $ReQue->fetch_assoc()) {
										echo "<tr>";
										echo "<td>" . $Ad['ad_fname'] . ' ' . $Ad['ad_lname'] . "</td>";
										echo "<td>{$Ad['ad_email']}</td>";
										echo "<td>{$Ad['ad_phone']}</td>
										<td>{$Ad['ad_address']}</td>";
										$PreQue = "SELECT * FROM ad_privileges where ad_id=" . $Ad['ad_id'];
										$re = mysqli_query($connect, $PreQue);
										echo "<td><ol type='A' class='text-justify'>";
										while ($Pre = $re->fetch_assoc()) {
											echo "<li>";
											if ($Pre['privileges'] == 1) {
												echo "Admins";
											} elseif ($Pre['privileges'] == 2) {
												echo "Catgorises";
											} elseif ($Pre['privileges'] == 3) {
												echo "Vindor";
											} elseif ($Pre['privileges'] == 4) {
												echo "Orders";
											} elseif ($Pre['privileges'] == 5) {
												echo "Costmers";
											} elseif ($Pre['privileges'] == 6) {
												echo "Product";
											} elseif ($Pre['privileges'] == 7) {
												echo "Brands";
											}
											echo "</li>";
										}
										echo "</ol></td>";
										if ($Ad['ad_status']) {
											echo "<td class='text-success'>Active</td>";
										} else {
											echo "<td>Desactive</td>";
										}
										echo "<td><a href='ad_man.php?Eid={$Ad['ad_id']}' class='btn btn-warning'>Edit</a></td>";
										if ($Ad['ad_status']) {
											echo "<td><a href='ad_man.php?Did={$Ad['ad_id']}' class='btn btn-danger'>Deactive</a></td>";
										} else {
											echo "<td><a href='ad_man.php?aid={$Ad['ad_id']}' class='btn btn-danger'>Active</a></td>";
										}

										echo "</tr>";
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Address</th>
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
<?php include_once 'included/footer.php';
?>