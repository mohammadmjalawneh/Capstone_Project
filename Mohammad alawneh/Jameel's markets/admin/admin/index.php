<?php
include_once 'included/database.php';
include_once 'included/connect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
else{
    $adn=new DBO();
    $ad=$adn->get_admin($_SESSION['id']);
}
if (isset($_POST['update'])) {
    $ED=new DBO();
    $img=$_FILES['img']['name'];
    if ($img!='') {
    $temp=$_FILES['img']['tmp_name'];
    $path='adimg/';
    $img=time().$img;
    move_uploaded_file($temp,$path.$img);
    }else{
        $img=$ad['ad_img'];
    }
    $ED->Edit_admin($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['email'],$_POST['pass'],$img,$_POST['mobile'],$_POST['address'],$_SESSION['id']);
    header("Location:index.php");
}
include_once 'included/header.php';?>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <img class="img-fluid" src="adimg/<?php echo($ad['ad_img']); ?>" alt="Your Img">
                    <div class="card-body">
                        <h3 class="card-title">Your name:<?php echo ' '.$ad['ad_fname'].' '.$ad['ad_lname']; ?></h3>
                        <h3 class="card-title">Your Email:<?php echo ' '.$ad['ad_email'];?></h3>
                        <h3 class="card-title">Your Address:<?php echo ' '.$ad['ad_address'];?></h3>
                        <h3 class="card-title">Your mobile:<?php echo ' '.$ad['ad_phone'];?></h3>
                        <h3 class="card-title">Your Status:<?php echo ' ';
                        if($ad['ad_status'])
                        	echo "Available";
                        else
                        	echo "Not Available";
                        ?></h3>
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
                                <input  type="text" name="fname" data-parsley-trigger="change" required="" placeholder="Enter First name" value="<?php echo($ad['ad_fname']); ?>" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputUserName">Your Mid name</label>
                                <input type="text" name="mname" value="<?php echo($ad['ad_mname']); ?>" data-parsley-trigger="change" required="" placeholder="Enter Mid. name" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputUserName">Your Last name</label>
                                <input type="text" name="lname" data-parsley-trigger="change" required="" placeholder="Enter Last name" value="<?php echo($ad['ad_lname']); ?>" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input id="inputEmail" value="<?php echo($ad['ad_email']); ?>" type="email" name="email" data-parsley-trigger="change" required="" placeholder="Enter email" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mobile Phone<small class="text-muted">(999) 999-9999</small></label>
                                <input type="number" class="form-control xphone-inputmask" id="xphone-mask" placeholder="" name="mobile" value="<?php echo($ad['ad_phone']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input id="inputPassword" type="password" name="pass" value="<?php echo($ad['ad_pass']); ?>" placeholder="Password" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPassword">Repeat Password</label>
                                <input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" required="" placeholder="Password" class="form-control" value="<?php echo($ad['ad_pass']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputRepeatPassword">Your Address</label>
                                <input type="text" required="" placeholder="Password" name="address" class="form-control" value="<?php echo($ad['ad_address']); ?>">
                            </div>
                            <div class="card card-figure">
                                <!-- .card-figure -->
                                <figure class="figure">
                                    <img class="img-fluid" src="adimg/<?php echo($ad['ad_img']); ?>" alt="Card image cap">
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
                                        <a href="index.php" class="btn btn-space btn-secondary">Cancel</a>
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
<?php include_once 'included/footer.php';?>
