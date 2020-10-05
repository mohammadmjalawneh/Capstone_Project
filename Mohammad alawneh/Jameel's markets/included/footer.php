<?php include_once 'connect.php';
include_once 'mail.php';
if (isset($_POST['submit'])) {
    Send_mail($_POST['email']);
}
?>
 <section class="shipping_details section_padding border_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="img/icon/icon_1.png" alt="">
                    <h4>Free Delivary</h4>
                    <p>You Order can Travel all over Jordan,Just for free .......</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="img/icon/icon_2.png" alt="">
                    <h4>Free shipping</h4>
                    <p>Divided face for bearing the divide unto seed winged divided light Forth.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="img/icon/icon_3.png" alt="">
                    <h4>Free shipping</h4>
                    <p>Divided face for bearing the divide unto seed winged divided light Forth.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="img/icon/icon_4.png" alt="">
                    <h4>Fast Delivary</h4>
                    <p>24 Hours to be in Your Hands ..........</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- free shipping end -->

<!-- subscribe_area part start-->
<section class="instagram_photo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="instagram_photo_iner">
                    <div class="single_instgram_photo">
                        <img src="img/instagram/inst_1.png" alt="">
                        <a href="https://www.instagram.com"><i class="ti-instagram"></i></a> 
                    </div>
                    <div class="single_instgram_photo">
                        <img src="img/instagram/inst_2.png" alt="">
                        <a href="https://www.instagram.com"><i class="ti-instagram"></i></a> 
                    </div>
                    <div class="single_instgram_photo">
                        <img src="img/instagram/inst_3.png" alt="">
                        <a href="https://www.instagram.com"><i class="ti-instagram"></i></a> 
                    </div>
                    <div class="single_instgram_photo">
                        <img src="img/instagram/inst_4.png" alt="">
                        <a href="https://www.instagram.com"><i class="ti-instagram"></i></a> 
                    </div>
                    <div class="single_instgram_photo">
                        <img src="img/instagram/inst_5.png" alt="">
                        <a href="https://www.instagram.com"><i class="ti-instagram"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer_part">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-lg-3">
                <div class="single_footer_part">
                    <h4>Category</h4>
                    <ul class="list-unstyled">
                        <?php 
                        $Q="SELECT * FROM bigcat where bigcat_sta='1'";
                        $res=mysqli_query($connect,$Q);
                        while ($CT=$res->fetch_assoc()){
                            echo "<li><a href='category.php?C={$CT['bigcat_id']}'>{$CT['bigcat_name']}</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_footer_part">
                    <h4>Address</h4>
                    <ul class="list-unstyled">
                        <li><a href="contact.php">200, Oxford St., London</a></li>
                        <li><a href="#">+962 77621 9747</a></li>
                        <li><span>mohammadmalawneh@gmail.com</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_footer_part">
                    <h4>Newsletter</h4>
                    <div id="mc_embed_signup">
                        <form action="" method="POST" class="subscribe_form relative mail_part">
                        <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                        class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = ' Email Address '" required="">
                        <button type="submit" name="submit" id="newsletter-submit"
                        class="email_icon newsletter-submit button-contactForm">subscribe</button>
                        <div class="mt-10 info"></div>
                    </form>
                </div>
                <div class="social_icon">
                    <a href="https://www.facebook.com"><i class="ti-facebook"></i></a>
                    <a href="https://www.twitter.com"><i class="ti-twitter-alt"></i></a>
                    <a href="https://www.instagram.com"><i class="ti-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="copyright_text">
                <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="js/jquery-1.12.1.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- easing js -->
<script src="js/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="js/lightslider.min.js"></script>
<!-- swiper js -->
<script src="js/mixitup.min.js"></script>
<script src="js/lightslider.min.js"></script>
<!-- particles js -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<!-- slick js -->
<script src="js/slick.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/jquery-1.12.1.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/lightslider.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!-- <script src="js/popper.min.js"></script> -->
<script src="js/price_rangs.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/stellar.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/waypoints.min.js"></script>