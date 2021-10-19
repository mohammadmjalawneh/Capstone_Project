<?php ob_start();
include_once 'included/header.php';
include_once 'included/connect.php';
include_once 'included/database.php';
if (isset($_GET['id'])) {
    array_push($_SESSION['cart'], $_GET['id']);
    header('Location:index.php');
}
if (isset($_POST['removecart'])) {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
}
?>
<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="banner_slider">
                    <div class="single_banner_slider">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                                <h5>Winter Shop</h5>
                                <h1>All what you need</h1>
                                <a href="category.php" class="btn_1">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->

<!-- feature_part start-->
<section class="feature_part pt-4">
    <div class="container-fluid p-lg-0 overflow-hidden">
        <div class="row align-items-center justify-content-between">
            <?php $Que = "SELECT * FROM bigcat where bigcat_sta='1'";
            $res = mysqli_query($connect, $Que);
            while ($I = $res->fetch_assoc()) {
                echo "<div class='col-lg-4 col-sm-6 mt-3'>
                    <div class='single_feature_post_text'>
                    <img src='img/category/{$I['bigcat_img']}' style='height: 550px;' alt=''>
                    <div class='hover_text'>
                    <a href='category.php?C={$I['bigcat_id']}' class='btn_2'>shop for {$I['bigcat_name']}</a>
                    </div>
                    </div>
                    </div>";
            }
            ?>
        </div>
    </div>
</section>
<!-- upcoming_event part start-->

<!-- new arrival part here -->
<section class="new_arrival section_padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="arrival_tittle">
                    <h2>new arrival</h2>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="arrival_filter_item filters">
                    <ul>
                        <li class="active controls" data-filter="*">all</li>
                        <?php $Q = "SELECT * FROM bigcat where bigcat_sta='1'";
                        $res = mysqli_query($connect, $Q);
                        while ($CN = $res->fetch_assoc()) {
                            echo "<li class='controls' data-toggle='.{$CN['bigcat_name']}'>{$CN['bigcat_name']}</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php
            $CV = "SELECT * FROM bigcat where bigcat_sta='1'";
            $L = mysqli_query($connect, $CV);
            while ($A = $L->fetch_assoc()) {
                $proQ = "SELECT * FROM product WHERE product_sta='1' AND bigcat_id=" . $A['bigcat_id'];
                $row = mysqli_query($connect, $proQ);
                $k = 1;
                $IM = new DBO();
                while ($P = $row->fetch_assoc()) {
                    $F = $IM->getcat($P['bigcat_id']);
                    $G = $IM->getimg($P['product_id']);
                    $B = $IM->getbrand($P['brand_id']);
                    echo "<div class='col-lg-4 col-sm-6' style='width: 100%;height: 100%;'>
                        <div class='single_arrivel_item weidth_1 mix {$F['bigcat_name']}'>
                        <img src='img/pro_img/{$G['product_img']}' alt='#'>
                        <div class='hover_text'>
                        <p>{$B['brand_name']}</p>
                        <a href='single-product.php?id={$P['product_id']}'><h3>{$P['product_name']}</h3></a>
                        <h5>JOD {$P['product_price']}</h5>
                        <div class='social_icon'>
                        <a href='#'><i class='ti-heart'></i></a>
                        <a href='index.php?id={$P['product_id']}'><i class='ti-bag'></i></a>
                        </div>
                        </div>
                        </div>
                        </div>";
                    if ($k == 3) {
                        break;
                    } else {
                        $k++;
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<?php include_once 'included/footer.php'; ?>