<!Doctype html>
<html lang="zxx">

<?php
ob_start();
include_once 'included/header.php';
include_once 'included/database.php';
if (!isset($_SESSION['cid'])) {
  header("Location:login.php");
}
if (isset($_POST['submit'])) {
  $OJ = new DBO();
  $OJ->add_address($_POST['country'], $_POST['city'], $_POST['sr_name'], $_POST['bil_num']);
  $ID = $OJ->add_search($_POST['country'], $_POST['city'], $_POST['sr_name'], $_POST['bil_num']);
  print_r($ID);
  $OJ->add_order($_SESSION['cid'], $ID['add_id'], $_POST['totalprice'], $_POST['message']);
  $ID2 = $OJ->search_ord($_SESSION['cid'], $ID['add_id'], $_POST['totalprice']);
  print_r($ID2);
  foreach ($_SESSION['cart'] as $key => $value) {
    $T = $OJ->proinfo($value);
    $OJ->add_pro($ID2['or_id'], $value, $T['pro_price']);
    $T['pro_qty'] = $T['pro_qty'] - 1;
    $OJ->update_qty($T['pro_qty'], $T['pro_id']);
  }
  $_SESSION['order'] = $ID2['or_id'];
  header("Location:confirmation.php");
}
?>
<section class="breadcrumb breadcrumb_bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="breadcrumb_iner">
          <div class="breadcrumb_iner_item">
            <p>Home / checkout</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- breadcrumb start-->

<!--================Checkout Area =================-->
<section class="checkout_area section_padding">
  <div class="container">
    <div class="billing_details">
      <div class="row">
        <div class="col-lg-7">
          <h3>Delivary Details</h3>
          <form class="row contact_form" action="" method="post">
            <div class="col-md-12 form-group p_star">
              <select class="country_select" name="country" id="select1" required>
                <option value="">Select Country</option>
                <option value="Jordan">Jordan</option>
                <option value="KSA">KSA</option>
                <option value="England">England</option>
              </select>
            </div>
            <div class="col-md-12 form-group p_star">
              <input type="text" class="form-control" id="city" name="city" placeholder="Town/City" required />
            </div>
            <div class="col-md-12 form-group p_star">
              <input type="text" class="form-control" id="sr_name" name="sr_name" placeholder="street name" required />
            </div>
            <div class="col-md-12 form-group p_star">
              <input type="number" class="form-control" id="bil_num" name="bil_num" placeholder="billing number" required />
            </div>
            <div class="col-md-12 form-group">
              <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes" style="resize: none;"></textarea>
            </div>
        </div>
        <div class="col-lg-5">
          <div class="order_box">
            <h2>Your Order</h2>
            <?php
            echo "<div class='row'>";
            echo "<div class='col-lg-6'>Name</div><div class='col-lg-2'>Quantity</div><div class='col-lg-4'>Total</div>";
            $OBJ = new DBO();
            $C = 0;
            $final_one;
            $totalprice = 0;
            $final_one = $_SESSION['cart'];
            foreach ($final_one as $key => $value) {
              foreach ($final_one as $key1 => $value1) {
                if ($value == $value1) {
                  $C++;
                  unset($final_one[$key1]);
                }
              }
              if ($C != 0) {
                $I = $OBJ->proinfo($value);
                echo "<div class='col-lg-6 col-sm-4 text-justify mt-2'>{$I['pro_name']}</div>";
                if ($C > $I['pro_qty']) {
                  $C = $I['pro_qty'];
                }
                echo "<div class='col-lg-2 col-sm-4 mt-2' text-center>{$C}</div>";
                echo "<div class='col-lg-4 col-sm-4 mt-2'>JOD" . ($OBJ->cal_price($I['pro_price'], $I['pro_descount'])) * $C . "</div>";
                $totalprice = $totalprice + (($OBJ->cal_price($I['pro_price'], $I['pro_descount'])) * $C);
              }
              $C = 0;
            }
            echo "</div>";
            ?>
            <ul class="list list_2">
              <li>
                <a href="#">Subtotal
                  <span><?php echo "JOD " . $totalprice; ?></span>
                  <input type="number" name="totalprice" value="<?php echo $totalprice; ?>" hidden>
                </a>
              </li>
              <li>
                <a href="#">For Delivary
                  <span>Flat rate: JOD 10.00</span>
                </a>
              </li>
              <li>
                <a href="#">Total
                  <span><?php echo "JOD " . ((float)$totalprice + 10.00); ?></span>
                </a>
              </li>
              <li>
                <a href="">Payment Way</a>
                <span>Cash on delevary</span>
              </li>
            </ul>
            <div class="payment_item">
              <div class="creat_account">
                <input type="checkbox" id="f-option4" name="selector" required />
                <label for="f-option4">I’ve read and accept the </label>
                <a>terms & conditions*</a>
              </div>
              <button class="btn_3" type="submit" name="submit">Go To Confermation</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
</body>

</html>
<?php include_once 'included/footer.php'; ?>