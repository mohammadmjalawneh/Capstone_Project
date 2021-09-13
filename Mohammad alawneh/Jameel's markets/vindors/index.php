<?php
include_once 'included/database.php';
session_start();
if (!isset($_SESSION['vid'])) {
    header('Location:login.php');
} else {
    $vin = new DBO();
    $vi = $vin->get_vin($_SESSION['vid']);
}
if (isset($_POST['update'])) {
    $imgname = $_FILES['img']['name'];
    if ($imgname != '') {
        $temp = $_FILES['img']['tmp_name'];
        $path = 'vinimg/';
        $imgname = time() . $imgname;
        move_uploaded_file($temp, $path . $imgname);
    } else {
        $imgname = $vi['vin_img'];
    }
    $upd = new DBO();
    $vi = $upd->updvin($vi['vin_id'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['email'], $_POST['mobile'], $_POST['pass'], $_POST['address'], $imgname, $vi['vin_status']);
    header("Location:index.php");
}
$SI = new DBO();
$S = $SI->get_cat($vi['bigcat_id']);
include_once 'included/header.php';
include_once 'included/connect.php';
?>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <a href="vinimg/<?php echo ($vi['vin_img']); ?>"><img class="img-fluid" src="vinimg/<?php echo ($vi['vin_img']); ?>" alt="Vindor Img"></a>
                    <div class="card-body">
                        <h3 class="card-title">Vindor name:<?php echo ' ' . $vi['vin_fname'] . ' ' . $vi['vin_lname']; ?></h3>
                        <h3 class="card-title">Vindor Email:<?php echo ' ' . $vi['vin_email']; ?></h3>
                        <h3 class="card-title">Vindor Address:<?php echo ' ' . $vi['vin_address']; ?></h3>
                        <h3 class="card-title">Vindor mobile:<?php echo ' ' . $vi['vin_mobile']; ?></h3>
                        <h3 class="card-title">Vindor date:<?php echo ' ' . $vi['vin_sdate']; ?></h3>
                        <h3 class="card-title">Vindor category:<?php echo ' ' . $S['bigcat_name']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Editing Form</h5>
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="POST" data-parsley-validate="">
                            <div class="form-group">
                                <label for="inputUserName">Your First name</label>
                                <input type="text" name="fname" data-parsley-trigger="change" required="" placeholder="Enter First name" value="<?php echo ($vi['vin_fname']); ?>" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputUserName">Your Mid name</label>
                                <input type="text" name="mname" value="<?php echo ($vi['vin_mname']); ?>" data-parsley-trigger="change" required="" placeholder="Enter Mid. name" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputUserName">Your Last name</label>
                                <input type="text" name="lname" data-parsley-trigger="change" required="" placeholder="Enter Last name" value="<?php echo ($vi['vin_lname']); ?>" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input id="inputEmail" value="<?php echo ($vi['vin_email']); ?>" type="email" name="email" data-parsley-trigger="change" required="" placeholder="Enter email" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPassword">Your Mobile</label>
                                <input type="text" required="" placeholder="mobile" name="mobile" class="form-control" value="<?php echo ($vi['vin_mobile']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input id="inputPassword" type="password" name="pass" value="<?php echo ($vi['vin_pass']); ?>" placeholder="Password" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPassword">Repeat Password</label>
                                <input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" required="" placeholder="Password" class="form-control" value="<?php echo ($vi['vin_pass']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPassword">Your Address</label>
                                <input type="text" required="" placeholder="Password" name="address" class="form-control" value="<?php echo ($vi['vin_address']); ?>">
                            </div>
                            <div class="card card-figure">
                                <!-- .card-figure -->
                                <figure class="figure">
                                    <a href="vinimg/<?php echo ($vi['vin_img']); ?>"><img class="img-fluid" src="vinimg/<?php echo ($vi['vin_img']); ?>" alt="Card image cap"></a>
                                    <!-- .figure-caption -->
                                    <figcaption class="figure-caption">
                                        <h6 class="figure-title"> Your Img </h6>
                                    </figcaption>
                                    <!-- /.figure-caption -->
                                </figure>
                                <!-- /.card-figure -->
                                <!-- /.card -->
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPassword">Update Your Picture</label>
                                <input type="file" name="img" placeholder="Password" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-sm-6 pl-0">
                                    <p class="text-right">
                                        <button type="submit" name="update" class="btn btn-space btn-primary">Update</button>
                                        <button class="btn btn-space btn-secondary">Cancel</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'included/footer.php'; ?>