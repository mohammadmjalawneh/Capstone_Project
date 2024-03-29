<?php ob_start();
session_start();
include_once 'included/database.php';
include_once 'included/connect.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="index.php"><img class="logo-img" src="assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form action="" method="POST">
                    <?php
                    if (isset($_POST['login'])) {
                        $Re = new DBO();
                        $ad = $Re->chick_admin($_POST['email'], $_POST['password']);
                        if (empty($ad)) {
                            echo "<div class='alert alert-danger' role='alert'>
                         Please Check Your E-mail or Password
                         </div>";
                        } elseif ($ad['ad_status']) {
                            $_SESSION['id'] = $ad['ad_id'];
                            header("Location:index.php");
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>
                         You are not Active,Please Call the manager
                         </div>";
                        }
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" name="email" type="email" placeholder="Your E-mail" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Sign in</button><br>
                    <div class="form-group">
                        <a href="fr.php" class="btn btn-primary btn-lg btn-block">Forgot Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>