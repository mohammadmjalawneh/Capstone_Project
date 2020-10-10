<?php
include_once 'included/connect.php';
include_once 'included/database.php';
if (isset($_SESSION['id'])) {
$A=new DBO();
$ad=$A->get_admin($_SESSION['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/libs/css/style.css">
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    </head>
    <body>
        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">
            <!-- ============================================================== -->
            <!-- navbar -->
            <!-- ============================================================== -->
            <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand" href="index.php">Concept</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item dropdown nav-user">
                                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
                                    if (isset($_SESSION['id'])){
                                    echo '<img src=adimg/';
                                    echo $ad['ad_img'];
                                    echo " alt='' class='user-avatar-md rounded-circle'>";
                                    }else{
                                    echo "<img src='assets/images/avatar-1.jpg' alt='' class='user-avatar-md rounded-circle'>";

                                    }
                                ?></a>
                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name"><?php if (isset($_SESSION['id'])) {
                                        echo $ad['ad_fname'].'  '.$ad['ad_lname'];
                                        }else{
                                        echo "no name";
                                        }
                                        ?></h5>
                                        <span class="status"></span><span class="ml-2"><?php if (isset($_SESSION['id'])) {
                                        if ($ad['ad_status']==1) {
                                        echo "Available";
                                        }else
                                        echo "Desactive";
                                    } ?></span>
                                </div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="index.php" aria-expanded="false" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                                <?php 
                                $Que="SELECT * FROM ad_privileges WHERE ad_id=".$_SESSION['id'];
                                $res=mysqli_query($connect,$Que);
                                while ($P=$res->fetch_assoc()) {
                                    if ($P['privileges']==1) {
                                        echo "<a class='nav-link' href='ad_man.php' aria-expanded='false'><i class='fa fa-fw fa-user-circle'></i>Admin managment</a>";
                                    }
                                    if ($P['privileges']==2) {
                                        echo "<a class='nav-link' href='Cat_man.php' aria-expanded='false' aria-controls='submenu-1'><i class='fa fa-fw fa-user-circle'></i>Category managment</a>";
                                    }
                                    if ($P['privileges']==3) {
                                        echo "<a class='nav-link' href='vindor_man.php' aria-expanded='false' aria-controls='submenu-1'><i class='fa fa-fw fa-user-circle'></i>Vendor managment</a>";
                                    }
                                    if ($P['privileges']==4) {
                                        echo "<a class='nav-link' href='order_man.php' aria-expanded='false' aria-controls='submenu-1'><i class='fa fa-fw fa-user-circle'></i>Order managment</a>";
                                    }
                                    if ($P['privileges']==5) {
                                        echo "<a class='nav-link' href='cos_man.php' aria-expanded='false' aria-controls='submenu-1'><i class='fa fa-fw fa-user-circle'></i>Costmer managment</a>";
                                    }
                                    if ($P['privileges']==6) {
                                        echo"<a class='nav-link' href='product_man.php' aria-expanded='false' aria-controls='submenu-1'><i class='fa fa-fw fa-user-circle'></i>Porduct managment</a>";
                                    }
                                    if ($P['privileges']==7) {
                                        echo "<a class='nav-link' href='br_man.php' aria-expanded='false' aria-controls='submenu-1'><i class='fa fa-fw fa-user-circle'></i>Brand managment</a>";
                                    }
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>