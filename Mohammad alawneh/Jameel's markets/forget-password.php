<?php include_once 'included/header.php';
include_once 'included/database.php';
include_once 'included/mail.php';
?>
<section class="login_part section_padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>New to our Shop?</h2>
                        <p>There are advances being made in science and technology
                            everyday, and a good example of this is the</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Welcome Back ! <br>
                            Don't worry, we'll send you an email to reset your password.</h3>
                        <?php
                        if (isset($_POST['submit'])) {
                            $OBJ = new DBO();
                            $TR = $OBJ->check_cos($_POST['email']);
                            if (empty($TR)) {
                                echo "<div class='alert alert-danger' role='alert'>
                                Please check Your E-mail</div>";
                            } elseif ($TR['cos_status']) {
                                getdata($TR['cos_id']);
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>
                                Please contact with the costmer care center</div>";
                            }
                        }
                        ?>
                        <form class="row contact_form" action="" method="post">
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control" id="name" name="email" value="" placeholder="Enter Email" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="submit" value="submit" class="btn_3">
                                    reset password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'included/footer.php'; ?>