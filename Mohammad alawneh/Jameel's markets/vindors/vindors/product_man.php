<?php ob_start();
session_start();
include_once 'included/database.php';
include_once 'included/connect.php';
if (!isset($_SESSION['vid'])) {
header('Location:login.php');
}else{
	$DE=new DBO();
	$cat=$DE->get_vin($_SESSION['vid']);
}
if (isset($_POST['backone'])) {
	header('Location:product_man.php');
}
if (isset($_GET['Eid'])) {
	$DE=new DBO();
	$product=$DE->getdata($_GET['Eid']);
}
if (isset($_GET['Did'])) {
$DE=new DBO();
	$DE->delpro($_GET['Did']);
		header("Location:product_man.php");
}
if (isset($_GET['aid'])) {
$DE=new DBO();
	$DE->actpro($_GET['aid']);
	header("Location:product_man.php");
}
if (isset($_POST['Editproduct'])) {
	$ED=new DBO();
	if($_FILES['files']['name']['0']!=''){
		$AD=$ED->Deimg($_GET['Eid']);
		foreach ($_FILES['files']['tmp_name'] as $key => $value) { 	
			$temp = $_FILES['files']['tmp_name'][$key]; 
			$file_name = time().$_FILES['files']['name'][$key];
			$path="C:/xampp/htdocs/Projects/Jameel's markets/img/pro_img/";
			move_uploaded_file($temp,$path.$file_name);
			$Que="INSERT INTO pro_img (pro_id, pro_img) VALUES (".$_GET['Eid'].", '".$file_name."')";
			$res=mysqli_query($connect,$Que);
		}
	}
	$DS=$ED->updpro($_POST['name'],$_POST['desc'],$_POST['price'],$_POST['description'],$_POST['qty'],$_POST['brand'],$cat['bigcat_id'],$_GET['Eid']);
}
if (isset($_POST['Addproduct'])) {
	$add=new DBO();$DE=new DBO();
	$get1=new DBO();
	$add->storepro($_POST['name'],$_POST['description'],$_POST['price'],$_POST['decs'],$_POST['qty'],$_POST['brand'],$cat['bigcat_id'],$_POST['subcat'],$_SESSION['vid']);
	$get=$get1->getpro($_POST['name'],$_POST['description'],$_POST['decs'],$_POST['brand'],$cat['bigcat_id'],$_POST['subcat'],$_SESSION['vid']);
	if(!empty(array_filter($_FILES['files']['name']))) { 
		foreach ($_FILES['files']['tmp_name'] as $key => $value) { 	
			$temp = $_FILES['files']['tmp_name'][$key]; 
			$file_name = time().$_FILES['files']['name'][$key];
			$path="C:/xampp/htdocs/Projects/Jameel's markets/img/pro_img/";
			move_uploaded_file($temp,$path.$file_name);
			$Que="INSERT INTO pro_img (pro_id, pro_img) VALUES (".$get.", '".$file_name."')";
 		    $res=mysqli_query($connect,$Que);
 		}
	}
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
					<?php
					if (isset($_GET['Eid'])) {
						echo "<h5 class='card-header'>Edit Product</h5>";
					}else{
						echo "<h5 class='card-header'>Add Product</h5>";
					}
					?>
					<div class="card-body">
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">product name</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<input type="text" required="" placeholder="product name" name="name"
									 class="form-control" value="<?php if(isset($_GET['Eid'])){
										echo $product['pro_name'];
									}
									?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">Project Description</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<textarea required="" class="form-control" value="" cols="10" rows="5" name="description"><?php if(isset($_GET['Eid'])){echo $product['pro_desc'];}else{echo "";}?>	
									</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">product price</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<input type="number" required="" placeholder="product price" name="price" class="form-control" step="any" value="<?php if(isset($_GET['Eid'])){
										echo $product['pro_price'];
									}
									?>"></input>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">product descount</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<input type="number" required="" min="0" name="decs" placeholder="product Descount like 10,20,ets" class="form-control" value="<?php if(isset($_GET['Eid'])){
										echo $product['pro_descount'];
									}
									?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">product Category</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<label class="form-control"><?php
										$Se="SELECT * FROM bigcat WHERE bigcat_id=".$cat['bigcat_id'];
										$res=mysqli_query($connect,$Se);
										$catname=mysqli_fetch_assoc($res);
										echo $catname['bigcat_name'];
										?>
										
									</label>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">Chose Subcategory</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<select name="subcat" id="subcat" class="form-control" required="">
										<?php
										if (isset($_GET['Eid'])) {
										$Que="SELECT * FROM subcat where bigcat_id=".$product['bigcat_id'];
										$vio=mysqli_query($connect,$Que);
										$bra1=mysqli_fetch_assoc($vio);
											echo "<option value='{$bra['subcat_id']}'>".$bra1['subcat_name']."</option>";
										}
										echo "<option value=''>Select Subcat</option>";
										$Que="SELECT * FROM subcat where bigcat_id=".$cat['bigcat_id'];
										$vio=mysqli_query($connect,$Que);
										while ($bra=mysqli_fetch_assoc($vio)) {
											echo "<option value='{$bra['subcat_id']}'>".$bra['subcat_name']."</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">Chose Brand</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<select name="brand" id="brand" class="form-control" required="">
										<?php
										if (isset($_GET['Eid'])) {
											$Que="SELECT * FROM brand where br_id=".$product['br_id'];
											$vio=mysqli_query($connect,$Que);
											$bra1=mysqli_fetch_assoc($vio);
												echo "<option value='{$bra['br_id']}'>".$bra1['br_name']."</option>";
										}
										echo "<option value=''>Select brand</option>";
										$Que="SELECT * FROM brand where bigcat_id=".$cat['bigcat_id'];
										$vio=mysqli_query($connect,$Que);
										while ($bra=mysqli_fetch_assoc($vio)) {
											echo "<option value='{$bra['br_id']}'>".$bra['br_name']."</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">Enter Quantity</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<input type="number" required="" name="qty" placeholder="Enter Quantity" class="form-control" min="0" value="<?php if(isset($_GET['Eid'])){
										echo $product['pro_qty'];
									}
									?>">
								</div>
							</div>
							<div class="form-group row">
								<?php
								if (isset($_GET['Eid'])) {
									echo "<div class='col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12'></div>";
									$Que="SELECT * FROM pro_img where pro_id=".$product['pro_id'];
									$res=mysqli_query($connect,$Que);
									$i=1;
									while ($imag=mysqli_fetch_assoc($res)) {
										echo "<div class='col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12'>
									<!-- .card -->
									<div class='card card-figure'>
										<!-- .card-figure -->
										<figure class='figure'>
											<img class='img-fluid' src='pro_img/{$imag['pro_img']}' alt='Card image cap'>
											<!-- .figure-caption -->
											<figcaption class='figure-caption'>
											<h6 class='figure-title'> Image {$i}</h6>
											<p class='text-muted mb-0'> Give some text description </p>
											</figcaption>
											<!-- /.figure-caption -->
										</figure>
										<!-- /.card-figure -->
										<!-- /.card -->
									</div>
								</div>";
								$i++;
								}
								}
								?>
							</div>
							<div class="form-group row">
								<label class="col-12 col-sm-3 col-form-label text-sm-right">Uploud Images</label>
								<div class="col-12 col-sm-8 col-lg-6">
									<?php if (isset($_GET['Eid'])) {
										echo "Alert : all adjesment will Delete all privious Photos";
										echo "<input type='file'  multiple='multiple' name='files[]' class='form-control'>";
									}else{
										echo "<input type='file' required='' multiple='multiple' name='files[]' class='form-control'>";
									}
									 ?>
								</div>
							</div>
							<div class="form-group row text-right">
								<div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
									<?php if (isset($_GET['Eid'])) {
										echo "<button type='submit' name='Editproduct'class='btn btn-space btn-primary'>Edit</button>";
									}else{
										echo "<button type='submit' name='Addproduct'class='btn btn-space btn-primary'>Submit</button>";
									}
									?>
									<button class="btn btn-space btn-secondary" name="backone" type="submit">Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
										<th>Status</th>
										<th>Edit</th>
										<th>Enable or Disable</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$Que="SELECT * FROM product WHERE vin_id=".$_SESSION['vid'];
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
										if ($pro['pro_sta']) {
											echo "<td style='color:green'>Active</td>";
										}else{
											echo "<td style='color:red'>Disactive</td>";
										}
										echo"<td><a href='product_man.php?Eid={$pro['pro_id']}' class='btn btn-rounded btn-success'>Edit</a></td>";
										if ($pro['pro_sta']) {
											echo"<td><a href='product_man.php?Did={$pro['pro_id']}' class='btn btn-rounded btn-danger'>Delete</a></td>";
										}else{
											echo"<td><a href='product_man.php?aid={$pro['pro_id']}' class='btn btn-rounded btn-primary'>Active</a></td>";
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