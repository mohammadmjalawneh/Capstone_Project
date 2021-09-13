<?php ob_start();
include_once 'included/header.php';
include_once 'included/connect.php';
include_once 'included/database.php';
if (!isset($_GET['S'])) {
  header("Location:index.php");
} else {
  $O = new DBO();
  $I = $O->proinfo($_GET['S']);
}
if (isset($_GET['id'])) {
  array_push($_SESSION['cart'], $_GET['id']);
  header('Location:single-product.php?S=' . $_GET['S']);
}
if (isset($_POST['add_comment'])) {
  $O = new DBO();
  $O->add_com($_GET['S'], $_POST['email'], $_POST['name'], $_POST['number'], date("Y-m-d H:i:s"), $_POST['message']);
}
?>
<!doctype html>
<html lang="zxx">

<body>
  <div class="product_image_area section_padding">
    <div class="container">
      <div class="row s_product_inner">
        <div class="col-lg-5">
          <div class="product_slider_img">
            <div id="vertical">
              <?php
              $Que = "SELECT * FROM pro_img WHERE pro_id=" . $_GET['S'];
              $res = mysqli_query($connect, $Que);
              while ($IMG = $res->fetch_assoc()) {
                echo "<div data-thumb='img/pro_img/{$IMG['pro_img']}'>
                <img src='img/pro_img/{$IMG['pro_img']}' />
              </div>";
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <div class="s_product_text">
            <?php echo "<h3>{$I['pro_name']}</h3>"; ?>
            <?php $OBJ = new DBO;
            $CI = $OBJ->getcat($I['bigcat_id']);
            $B = $OBJ->getbrand($I['br_id']);
            $V = $OBJ->getvin($I['vin_id']);
            echo "<h2>JOD {$I['pro_price']}</h2>";
            echo "<ul class='list'>
          <li>
          <a class='active' href='category.php?C={$I['bigcat_id']}'>
          <span>Category</span> : {$CI['bigcat_name']}</a>
          </li>";
            echo "<li>
          <a class='' href='category.php?B={$I['br_id']}'>
          <span>Brand</span> : {$B['br_name']}</a>
          </li>";
            echo "<li>
          <a class='' href=''>
          <span>Vindor</span> : {$V['vin_fname']} {$V['vin_lname']}</a>
          </li>";
            if ($I['pro_qty'] > 0) {
              echo "<li>
            <a href=''> <span>Availibility</span> : In Stock</a>
            </li>";
            } else {
              echo "<li>
            <a href='#'> <span>Availibility</span> : Out of stock</a>
            </li>";
            }

            echo "</ul>";
            ?>
            <div class="card_area">
              <div class="add_to_cart">
                <a href="<?php echo "single-product.php?S={$I['pro_id']}&id={$I['pro_id']}"; ?>" class="btn_3">add to cart</a>
                <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
              </div>
              <div class="social_icon">
                <a href="#" class="fb"><i class="ti-facebook"></i></a>
                <a href="#" class="tw"><i class="ti-twitter-alt"></i></a>
                <a href="#" class="li"><i class="ti-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->
  <!--================Product Description Area =================-->
  <section class="product_description_area">
    <div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
          <p><?php echo $I['pro_desc']; ?></p>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="row">
            <div class="col-lg-6">
              <div class="comment_list">
                <?php
                $Que = "SELECT * FROM reviews where pro_id=" . $_GET['S'];
                $res = mysqli_query($connect, $Que);
                while ($CO = $res->fetch_assoc()) {
                  echo "<div class='review_item'>
                      <div class='media'>
                        <div class='media-body'>
                          <h4>{$CO['com_name']}</h4>
                          <h5>{$CO['com_time']}</h5>
                        </div>
                      </div>
                      <p>
                        {$CO['com_text']}
                      </p>
                    </div>";
                }
                ?>

              </div>
            </div>
            <div class="col-lg-6">
              <div class="review_box">
                <h4>Post a comment</h4>
                <form class="row" action="" method="POST">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="message" id="message" style="resize: none;" rows="1" placeholder="Message"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 text-right">
                    <input type="submit" name="add_comment" class="btn_3">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="product_list best_seller padding_bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="section_tittle text-center">
            <h2>Best Sellers</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
        $Q = "SELECT * FROM product WHERE pro_sta='1'";
        $R = mysqli_query($connect, $Q);
        $C = 0;
        $OBJ1 = new DBO();
        while ($T = $R->fetch_assoc()) {
          $IMG = $OBJ1->getimg($T['pro_id']);
          echo "<div class='col-lg-3 col-sm-6'>
               <div class='single_category_product'>
               <div class='single_category_img'>
               <img src='img/pro_img/{$IMG['pro_img']}' alt=''>
               <div class='category_social_icon'>
               <ul>
               <li><a href='#'><i class='ti-heart'></i></a></li>
               <li><a href='single-product.php?S={$T['pro_id']}&id={$T['pro_id']}'><i class='ti-bag'></i></a></li>
               </ul>
               </div>
               <div class='category_product_text'>
               <a href='single-product.php?S={$T['pro_id']}'><h5>{$T['pro_name']}</h5></a>
               <p>JOD {$T['pro_price']}</p>
               </div>
               </div>
               </div>
               </div>";
          if ($C == 3) {
            break;
          } else {
            $C++;
          }
        }
        ?>
  </section>
  </div>
  </div>
  </section>
</body>

</html>
<?php include_once 'included/footer.php'; ?>