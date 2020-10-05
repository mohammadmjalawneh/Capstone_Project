<!DOCTYPE HTML>
<html lang="zxx">
<?php
ob_start();
include_once 'included/database.php';
include_once 'included/connect.php';
include_once 'included/header.php'; ?>
<?php if (isset($_GET['Did'])) {
  unset($_SESSION['cart'][$_GET['Did']]);
  header('Location:cart.php');
} ?>
  <!-- Header part end-->

  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="breadcrumb_iner">
                      <div class="breadcrumb_iner_item">
                          <p>Home/Shop/Single product/Cart list</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- breadcrumb start-->
  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Descount</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($_SESSION['cart'])) {
                $OBJ=new DBO();$C=0;
                $TotalPrice=0;
                $final_one=$_SESSION['cart'];
                foreach ($final_one as $key => $value) {
                  foreach ($final_one as $key1 => $value1) {
                    if ($value==$value1) {
                      $C++;
                      unset($final_one[$key1]);
                    }
                  }
                  if ($C!=0) {
                    $I=$OBJ->proinfo($value);
                    $IMG=$OBJ->getimg($value);
                    echo "<tr>
                    <td>
                    <div class='media'>
                    <div class='d-flex'>
                    <img src='img/pro_img/{$IMG['pro_img']}' alt='' />
                    </div>
                    <div class='media-body'>
                    <p>{$I['pro_name']}</p>
                    </div>
                    </div>
                    </td>
                    <td>
                    <h5>JOD {$I['pro_price']}</h5>
                    </td>
                    <td>
                    {$I['pro_descount']}
                    </td>
                    <td>
                    <div class='product_count'>
                    <h5>$C<h5>
                    </div>
                    </td>
                    <td>
                    <h5 id='result'>"."JOD ".$C*$OBJ->cal_price($I['pro_price'],$I['pro_descount'])."</h5>
                    </td>
                    <td>
                    <a class='genric-btn danger radius' href='cart.php?Did={$key}'>Delete</a>
                    </td>
                    </tr>";
                    $TotalPrice=$TotalPrice+($C*$OBJ->cal_price($I['pro_price'],$I['pro_descount']));
                  }
                  $C=0;
                }
              }else{
                echo "<h2>The cart is empty</h2>";
                echo "<a href='category.php' class='genric-btn primary-border e-large'>Back to shop</a>";
              }
              ?>
              <tr>
                <th></th>
                <th></th>
                <th><h5>Sub-total</h5></th>
                <th><h5><?php if (!empty($_SESSION['cart'])) {
                  echo 'JOD'.$TotalPrice;
                }?><h5></th>
                <th></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-4 col-sm-6">
              <a class="btn_1 checkout_btn_1" href="category.php">Continue Shopping</a>
            </div>
            <div class="col-lg-4"></div><hr>
            <div class="col-lg-4 col-sm-6">
              <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
            </div>
      </div>
  </section>
  <!--================End Cart Area =================-->

  <!--::footer_part start::-->
  <?php include_once 'included/footer.php'; ?>
</body>

</html>