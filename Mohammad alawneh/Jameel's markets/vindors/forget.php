<?php
include_once 'included/database.php';
include_once 'included/mail.php';
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
        <div class="splash-container">
            <div class="card">
                <div class="card-header text-center"><img class="logo-img" src="assets/images/logo.png" alt="logo"><span class="splash-description">Please enter your user information.</span></div>
                <div class="card-body">
                    <?php
                    if (isset($_POST['reset'])) {
                    $Re=new DBO();
                    $AD=$Re->chick_vindor($_POST['email']);
                    if (empty($AD)) {
                    echo "<div class='alert alert-danger' role='alert'>
                        Please Check Your E-mail or Password
                    </div>";
                    }else{
                    getdata($AD['vin_id']);
                    }
                    }
                    ?>
                    <form action="" method="post">
                        <p>Don't worry, we'll Reset Your Password</p>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="Your Email" autocomplete="off">
                        </div>
                        <div class="form-group pt-1">
                            <button class="btn btn-block btn-primary btn-xl" name="reset">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    </body>
    
</html>