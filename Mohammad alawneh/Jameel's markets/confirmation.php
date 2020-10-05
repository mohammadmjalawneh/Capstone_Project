<?php 
include_once 'included/header.php';
include_once 'included/database.php';
$OJ=new DBO();
$I=$OJ->order_info($_SESSION['order']);
$AD=$OJ->ad_info($I['add_id']);
?>
  <section class="breadcrumb breadcrumb_bg">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="breadcrumb_iner">
                      <div class="breadcrumb_iner_item">
                          <p>Home / About</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- breadcrumb start-->
  <!--================ confirmation part start =================-->
  <section class="confirmation_part section_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span>Thank you. Your order has been received.</span>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>order info</h4>
            <ul>
              <li>
                <p>order number</p><span>: <?php echo $_SESSION['order']; ?></span>
              </li>
              <li>
                <p>data</p><span>: <?php echo $I['or_date']; ?></span>
              </li>
              <li>
                <p>total</p><span>: <?php echo $I['total']; ?></span>
              </li>
              <li>
                <p>mayment methord</p><span>: Cash of delivary</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>shipping Address</h4>
            <ul>
              <li>
                <p>Street</p><span>: <?php echo $AD['sr_name'] ; ?></span>
              </li>
              <li>
                <p>city</p><span>: <?php echo $AD['city'] ; ?></span>
              </li>
              <li>
                <p>country</p><span>: <?php echo $AD['country'] ; ?></span>
              </li>
              <li>
                <p></p><span></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="order_details_iner">
            <h3>Order Details</h3>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $newcart=$_SESSION['cart'];
                $C=0;$total1=0;
                foreach ($newcart as $key => $value) {
                  foreach ($newcart as $key1 => $value1) {
                    if ($value==$value1) {
                      $C++;
                      unset($newcart[$key1]);
                    }
                  }
                  if ($C!=0) {
                    $I2=$OJ->proinfo($value);
                    echo "<tr>
                  <th colspan='2'><span>{$I2['pro_name']}</span></th>
                  <th>x{$C}</th>
                  <th><span>".($OJ->cal_price($I2['pro_price'],$I2['pro_descount']))*$C."</span></th>
                </tr>";
                $total1+=(($OJ->cal_price($I2['pro_price'],$I2['pro_descount']))*$C);
                  }
                  $C=0;
                }
                ?>
                  <th colspan="3">Subtotal</th>
                  <th> <span><?php echo $total1; ?></span></th>
                </tr>
                <tr>
                  <th colspan="3">shipping</th>
                  <th><span>for Delivaly: JOD 10.00</span></th>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col" colspan="3">Quantity : <?php echo sizeof($_SESSION['cart']); ?></th>
                  <th scope="col">Total : <?php echo "JOD ".((float)$total1+10.00);?></th>
                </tr>
              </tfoot>
            </table>
            <?php unset($_SESSION['cart']) ?>
            <div class="row">
            <div class="col-lg-4 col-sm-6">
              <a class="btn_1 checkout_btn_1" href="category.php">Continue Shopping</a>
            </div>
            <div class="col-lg-4"></div><hr>
            <div class="col-lg-4 col-sm-6">
              <a class="btn_1 checkout_btn_1" href="logout.php">Log Out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include_once 'included/footer.php'; ?>