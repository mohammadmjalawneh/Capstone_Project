<?php session_start();
include_once 'included/connect.php';
include_once 'included/database.php';
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
if (isset($_GET['Eid'])) {
	$CT=new DBO();
	$I=$CT->get_cat($_GET['Eid']);
}
if (isset($_GET['did'])) {
	$DIS=new DBO();
	$DIS->dis_sub($_GET['did']);
	header("Location:Cat_man.php");
}
if (isset($_GET['Aid'])) {
	$DIS=new DBO();
	$DIS->act_sub($_GET['Aid']);
	header("Location:Cat_man.php");
}
if (isset($_GET['Did'])) {
	$DC=new DBO();
	$DC->Deact_cat($_GET['Did']);
	header("Location:Cat_man.php");
}
if (isset($_GET['aid'])) {
	$AC=new DBO();
	$AC->Act_cat($_GET['aid']);
	header("Location:Cat_man.php");
}
if (isset($_POST['edit_sub'])) {
	$ES=new DBO();
	$ES->update_sub($_POST['subname'],$_POST['bigcat'],$_GET['eid']);
	header("Location:Cat_man.php");
}
if (isset($_POST['addcat'])) {
	$AD=new DBO();
	$imgname=$_FILES['img']['name'];
	$temp=$_FILES['img']['tmp_name'];
	$path="C:/xampp/htdocs/Projects/Jameel's markets/img/category/";
	$imgname=time().$imgname;
	move_uploaded_file($temp,$path.$imgname);
	$AD->add_cat($_POST['name'],$imgname);
}
if (isset($_GET['eid'])) {
	$EDS=new DBO();
	$SI=$EDS->get_sub_cat($_GET['eid']);
}
if (isset($_POST['add_sub'])) {
	$AS=new DBO();
	$AS->add_sub_cat($_POST['subname'],$_POST['bigcat']);
}
if (isset($_POST['editcat'])) {
	$ED=new DBO();
	$imgname=$_FILES['img']['name'];
	if ($imgname!='') {
		$temp=$_FILES['img']['tmp_name'];
		$path="C:/xampp/htdocs/Projects/Jameel's markets/img/category/";
		$imgname=time().$imgname;
		move_uploaded_file($temp,$path.$imgname);
	}else{
		$imgname=$I['bigcat_img'];
	}
	$ED->update_cat($_GET['Eid'],$_POST['name'],$imgname);
	header("Location:Cat_man.php");
}
include_once 'included/header.php'; 
?>
<div class="dashboard-wrapper">
	<div class="container-fluid  dashboard-content">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Big Category Form</h5>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Name</label>
								<div class="col-9 col-lg-10">
									<input id="inputEmail2" type="text" required="" placeholder="Name" class="form-control" name="name" value="<?php if(isset($_GET['Eid'])){echo $I['bigcat_name'];} ?>">
								</div>
							</div>
							<?php
							if (isset($_GET['Eid'])) {
								$Go;
							 	$Go="<div class='card' id='images'>
								<h5 class='card-header'>Images</h5>
								<div class='card-body'>";
								$Go=$Go.'<img src="';
								$Go=$Go."../img/category/".$I['bigcat_img']; 
								$Go=$Go.'" class="img-fluid mr-3" alt="Responsive image"
									style="height: 200px;width: 200px;">
								</div>
							</div>';
							echo $Go;
							 } 
							?>
							<div class="custom-file mb-3">
								<?php if (isset($_GET['Eid'])) {
									echo "<input type='file' class='custom-file-input' name='img' id='customFile'>";
								}else{
									echo "<input type='file' class='custom-file-input' required='' name='img' id='customFile'>";
								} 
								?>
								<label class="custom-file-label" for="customFile">File Input</label>
							</div>
							<div class="row pt-2 pt-sm-5 mt-1">
								<div class="col-sm-6 pl-0">
									<p class="text-right">
										<?php if (isset($_GET['Eid'])) {
											echo "<button type='submit' class='btn btn-space btn-primary' name='editcat'>Submit</button>";

										}else{
											echo "<button type='submit' class='btn btn-space btn-primary' name='addcat'>Submit</button>";
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
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Sub. Category Form</h5>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Name</label>
								<div class="col-9 col-lg-10">
									<input id="inputEmail2" type="text" name="subname" required="" placeholder="Sub. Category name" class="form-control" value="<?php if(isset($_GET['eid'])){echo $SI['subcat_name'];} ?>">
								</div>
							</div>

							<div class="form-group row">
								<label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">Bigcat</label>
								<div class="col-9 col-lg-10">
									<select id="inputEmail2" required="" name="bigcat" class="form-control">
										<?php
										if (isset($_GET['eid'])) {
											$TY=new DBO();
											$CTY=$TY->get_cat($SI['bigcat_id']);
											echo "<option value='{$CTY['bigcat_id']}'>{$CTY['bigcat_name']}</option>";
										}
										echo "<option value=''>Select Category</option>";
										$Que="SELECT * FROM bigcat WHERE bigcat_sta='1'";
										$res=mysqli_query($connect,$Que);
										while ($CTN=$res->fetch_assoc()) {
											echo "<option value='{$CTN['bigcat_id']}'>{$CTN['bigcat_name']}</option>";
										}

										?>
									</select>
								</div>
							</div><br>
							<div class="row pt-2 pt-sm-5 mt-1">
								<div class="col-sm-6 pl-0">
									<p class="text-right">
										<?php if (isset($_GET['eid'])) {
											echo "<button type='submit' class='btn btn-space btn-primary' name='edit_sub'>Submit</button>";

										}else{
											echo "<button type='submit' class='btn btn-space btn-primary' name='add_sub'>Submit</button>";
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
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Big Category Table</h5>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Category name</th>
									<th scope="col">Image</th>
									<th scope="col">Stuts</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$Que="SELECT * FROM bigcat ORDER BY bigcat_id ASC";
								$res=mysqli_query($connect,$Que);
								while ($CT=$res->fetch_assoc()) {
									echo "<tr>";
									echo "<th scope='row'>{$CT['bigcat_id']}</th>";
									echo "<td>{$CT['bigcat_name']}</td>";
									echo "<td><a href='../img/category/".$CT['bigcat_img']."'><img src='../img/category/".$CT['bigcat_img']."' style='width: 4rem;height: 4rem;'></a></td>";
									if ($CT['bigcat_sta']) {
										echo "<td class='text-success'>Active</td>";
										echo "<td><a href='Cat_man.php?Eid={$CT['bigcat_id']}' class='btn btn-outline-warning'>Edit</a></td>";
										echo "<td><a href='Cat_man.php?Did={$CT['bigcat_id']}' class='btn btn-outline-danger'>Deactivate</a></td>";
									}else{
										echo "<td class='text-danger'>Disactive</td>";
										echo "<td></td>";
										echo "<td><a href='Cat_man.php?aid={$CT['bigcat_id']}' class='btn btn-outline-danger'>Active</a></td>";
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
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Sub. Category Table</h5>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Category name</th>
									<th scope="col">Category name</th>
									<th scope="col">Stuts</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$Que="SELECT * FROM subcat ORDER BY subcat_id ASC";
								$res=mysqli_query($connect,$Que);
								$CN=new DBO();
								while ($CT=$res->fetch_assoc()) {
									echo "<tr>";
									echo "<th scope='row'>{$CT['subcat_id']}</th>";
									$RE=$CN->get_cat($CT['bigcat_id']);
									echo "<td>{$RE['bigcat_name']}</td>";
									echo "<td>{$CT['subcat_name']}</td>";
									if ($RE['bigcat_sta']) {
										if ($CT['subcat_sta']) {
											echo "<td class='text-success'>Active</td>";
											echo "<td><a href='Cat_man.php?eid={$CT['subcat_id']}' class='btn btn-outline-warning'>Edit</a></td>";
											echo "<td><a href='Cat_man.php?did={$CT['subcat_id']}' class='btn btn-outline-danger'>Deactivate</a></td>";
										}else{
											echo "<td class='text-danger'>Sub Category Disactive</td>";
											echo "<td></td>";
											echo "<td><a href='Cat_man.php?Aid={$CT['subcat_id']}' class='btn btn-outline-danger'>Active</a></td>";
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
<?php include_once 'included/footer.php'; ?>