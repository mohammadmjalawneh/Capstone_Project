<?php
ob_start();
include_once 'included/header.php';
include_once 'included/connect.php';
include_once 'included/database.php';
if (isset($_GET['id']) && isset($_GET['C'])) {
    array_push($_SESSION['cart'], $_GET['id']);
    header('Location:category.php?C=' . $_GET['C']);
}
if (isset($_GET['id']) && isset($_GET['S'])) {
    array_push($_SESSION['cart'], $_GET['id']);
    header('Location:category.php?S=' . $_GET['S']);
}
if (isset($_GET['id']) && isset($_GET['B'])) {
    array_push($_SESSION['cart'], $_GET['id']);
    header('Location:category.php?B=' . $_GET['B']);
}
if (isset($_GET['id'])) {
    array_push($_SESSION['cart'], $_GET['id']);
    header("Location:category.php");
} elseif (isset($_GET['C'])) {
    $N = 0;
    $T = new DBO();
    $R = new DBO();
    $C = $T->getcat($_GET['C']);
    $N = $R->bigcatproduct_count($_GET['C']);
} elseif (isset($_GET['S'])) {
    $N = 0;
    $T = new DBO();
    $R = new DBO();
    $C = $T->getsub($_GET['S']);
    $N = $R->subproduct_count($_GET['S']);
} elseif (isset($_GET['B'])) {
    $T = new DBO();
    $R = new DBO();
    $C = $T->getbrand($_GET['B']);
    $N = $R->brproduct_count($_GET['B']);
} else {
    $R = new DBO();
    $N = $R->getproduct_count();
}
?>

<!-- Header part end-->
<!--================Home Banner Area =================-->
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <p>Home / Shop</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<!--================Category Product Area =================-->
<section class="cat_product_area section_padding border_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                        <div class="l_w_title">
                            <h3>Browse Sub Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <?php
                                $Que = "SELECT * FROM bigcat where bigcat_sta='1'";
                                $res = mysqli_query($connect, $Que);
                                while ($I = $res->fetch_assoc()) {
                                    echo "<li class='sub-menu'>";
                                    echo "<a href='#' class='d-flex justify-content-between'>
                                    {$I['bigcat_name']}
                                    <div class='right ti-plus'></div>
                                    </a>";
                                    echo "<ul>";
                                    $Q2 = "SELECT * FROM subcat where bigcat_id=" . $I['bigcat_id'] . " AND subcat_sta ='1'";
                                    $r2 = mysqli_query($connect, $Q2);
                                    while ($I2 = $r2->fetch_assoc()) {
                                        echo "<li>
                                        <a href='category.php?S={$I2['subcat_id']}'>{$I2['subcat_name']}</a>
                                        </li>";
                                    }
                                    echo "</ul>";
                                    echo "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="l_w_title">
                            <h3>Browse Brands</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <?php
                                $Que = "SELECT * FROM bigcat where bigcat_sta='1'";
                                $res = mysqli_query($connect, $Que);
                                while ($I = $res->fetch_assoc()) {
                                    echo "<li class='sub-menu'>";
                                    echo "<a href='#' class=' d-flex justify-content-between'>
                                    {$I['bigcat_name']}
                                    <div class='right ti-plus'></div>
                                    </a>";
                                    echo "<ul>";
                                    $Q2 = "SELECT * FROM brand where bigcat_id=" . $I['bigcat_id'] . " AND brand_sta ='1'";
                                    $r2 = mysqli_query($connect, $Q2);
                                    while ($I2 = $r2->fetch_assoc()) {
                                        echo "<li>
                                        <a href='category.php?B={$I2['brand_id']}'>{$I2['brand_name']}</a>
                                        </li>";
                                    }
                                    echo "</ul>";
                                    echo "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <div class="single_product_menu product_bar_item">
                                <?php
                                if (isset($_GET['C'])) {
                                    echo "<h2>{$C['bigcat_name']} ({$N})</h2>";
                                } elseif (isset($_GET['S'])) {
                                    echo "<h2>{$C['subcat_name']} ({$N})</h2>";
                                } elseif (isset($_GET['B'])) {
                                    echo "<h2>{$C['brand_name']} ({$N})</h2>";
                                } else {
                                    echo "<h2>All Products ($N)</h2>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-group">
                        <?php
                        if (isset($_GET['C'])) {
                            $OBJ2 = new DBO();
                            $Que = "SELECT * FROM product where bigcat_id=" . $_GET['C'] . " and product_sta='1'";
                            $R = mysqli_query($connect, $Que);
                            while ($I = $R->fetch_assoc()) {
                                $sub = $OBJ2->getsub($I['subcat_id']);
                                if ($sub['subcat_sta']) {
                                    $br = $OBJ2->getbrand($I['brand_id']);
                                    if ($br['brand_sta']) {
                                        $vin = $OBJ2->getvin($I['vindor_id']);
                                        if ($vin['vindor_status']) {
                                            $Q = "SELECT * FROM product_img where product_id=" . $I['product_id'];
                                            $O = mysqli_query($connect, $Q);
                                            $I3 = $O->fetch_assoc();
                                            echo "<div class='col-lg-4 col-sm-6 mt-4'>
                                            <div class='card'>
                                            <div class='card-body'>
                                            <div class='single_category_product'>
                                            <div class='single_category_img'>
                                            <img src='img/product_img/{$I3['product_img']}' alt='' style='height: 20rem;'>
                                            <div class='category_social_icon'>
                                            <ul>
                                            <li><a href='#''><i class='ti-heart'></i></a></li>
                                            <li><a href='category.php?C={$I['bigcat_id']}&id={$I['product_id']}'><i class='ti-bag'></i></a></li>
                                            </ul>
                                            </div>
                                            <div class='category_product_text'>
                                            <a href='single-product.php?S={$I['product_id']}'><h5>{$I['product_name']}</h5></a>
                                            </div>
                                            </div>
                                            </div>
                                            <div class='card-footer'><p>JOD{$I['product_price']}</p></div>
                                            </div>
                                            </div>
                                            </div>";
                                        }
                                    }
                                }
                            }
                        } elseif (isset($_GET['S'])) {
                            $OBJ2 = new DBO();
                            $Que = "SELECT * FROM product where subcat_id=" . $_GET['S'] . " and product_sta='1'";
                            $R = mysqli_query($connect, $Que);
                            while ($I = $R->fetch_assoc()) {
                                $big = $OBJ2->getcat($I['bigcat_id']);
                                if ($big['bigcat_sta']) {
                                    $br = $OBJ2->getbrand($I['brand_id']);
                                    if ($br['brand_sta']) {
                                        $vin = $OBJ2->getvin($I['vindor_id']);
                                        if ($vin['vindor_status']) {
                                            $Q = "SELECT * FROM product_img where product_id=" . $I['product_id'];
                                            $O = mysqli_query($connect, $Q);
                                            $I3 = $O->fetch_assoc();
                                            echo "<div class='col-lg-4 col-sm-6 mt-4'>
                                            <div class='card'>
                                            <div class='card-body'>
                                            <div class='single_category_product'>
                                            <div class='single_category_img'>
                                            <img src='img/product_img/{$I3['product_img']}' alt='' style='height: 20rem;'>
                                            <div class='category_social_icon'>
                                            <ul>
                                            <li><a href='#''><i class='ti-heart'></i></a></li>
                                            <li><a href='category.php?S={$_GET['S']}&id={$I['product_id']}'><i class='ti-bag'></i></a></li>
                                            </ul>
                                            </div>
                                            <div class='category_product_text'>
                                            <a href='single-product.php?S={$I['product_id']}'><h5>{$I['product_name']}</h5></a>
                                            </div>
                                            </div>
                                            </div>
                                            <div class='card-footer'><p>JOD{$I['product_price']}</p></div>
                                            </div>
                                            </div>
                                            </div>";
                                        }
                                    }
                                }
                            }
                        } elseif (isset($_GET['B'])) {
                            $OBJ2 = new DBO();
                            $Que = "SELECT * FROM product where product_sta='1' AND brand_id=" . $_GET['B'];
                            $R2 = mysqli_query($connect, $Que);
                            while ($I = $R2->fetch_assoc()) {
                                $big = $OBJ2->getcat($I['bigcat_id']);
                                if ($big['bigcat_sta']) {
                                    $sub = $OBJ2->getsub($I['subcat_id']);
                                    if ($sub['subcat_sta']) {
                                        $vin = $OBJ2->getvin($I['vindor_id']);
                                        if ($vin['vindor_status']) {
                                            $Q = "SELECT * FROM product_img where product_id=" . $I['product_id'];
                                            $O = mysqli_query($connect, $Q);
                                            $I3 = $O->fetch_assoc();
                                            echo "<div class='col-lg-4 col-sm-6 mt-4'>
                                            <div class='card'>
                                            <div class='card-body'>
                                            <div class='single_category_product'>
                                            <div class='single_category_img'>
                                            <img src='img/pro_img/{$I3['product_img']}' alt='' style='height: 20rem;width: 80rem;'>
                                            <div class='category_social_icon'>
                                            <ul>
                                            <li><a href='#''><i class='ti-heart'></i></a></li>
                                            <li><a href='category.php?B={$_GET['B']}&id={$I['product_id']}'><i class='ti-bag'></i></a></li>
                                            </ul>
                                            </div>
                                            <div class='category_product_text'>
                                            <a href='single-product.php?S={$I['product_id']}'><h5>{$I['product_name']}</h5></a>
                                            </div>
                                            </div>
                                            </div>
                                            <div class='card-footer'><p>JOD{$I['product_price']}</p></div>
                                            </div>
                                            </div>
                                            </div>";
                                        }
                                    }
                                }
                            }
                        } elseif (isset($_GET['search_input'])) {
                            $OBJ2 = new DBO();
                            $Que = "SELECT * FROM product 
                            WHERE product_name LIKE '%" . $_GET['search_input'] . "%'
                            OR product_desc LIKE '%" . $_GET['search_input'] . "%'";
                            $R2 = mysqli_query($connect, $Que);
                            while ($I = $R2->fetch_assoc()) {
                                $big = $OBJ2->getcat($I['bigcat_id']);
                                if ($big['bigcat_sta']) {
                                    $sub = $OBJ2->getsub($I['subcat_id']);
                                    if ($sub['subcat_sta']) {
                                        $br = $OBJ2->getbrand($I['brand_id']);
                                        if ($br['brand_sta']) {
                                            $vin = $OBJ2->getvin($I['vindor_id']);
                                            if ($vin['vindor_status']) {
                                                $Q = "SELECT * FROM product_img where product_id=" . $I['product_id'];
                                                $O = mysqli_query($connect, $Q);
                                                $I3 = $O->fetch_assoc();
                                                echo "<div class='col-lg-4 col-sm-6 mt-4'>
                                            <div class='card'>
                                            <div class='card-body'>
                                            <div class='single_category_product'>
                                            <div class='single_category_img'>
                                            <img src='img/pro_img/{$I3['product_img']}' alt='' style='height: 20rem;width: 80rem;'>
                                            <div class='category_social_icon'>
                                            <ul>
                                            <li><a href='#''><i class='ti-heart'></i></a></li>
                                            <li><a href='category.php?B={$_GET['search_input']}&id={$I['product_id']}'><i class='ti-bag'></i></a></li>
                                            </ul>
                                            </div>
                                            <div class='category_product_text'>
                                            <a href='single-product.php?S={$I['product_id']}'><h5>{$I['product_name']}</h5></a>
                                            </div>
                                            </div>
                                            </div>
                                            <div class='card-footer'><p>JOD{$I['product_price']}</p></div>
                                            </div>
                                            </div>
                                            </div>";
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $OBJ2 = new DBO();
                            $Que = "SELECT * FROM product where product_sta='1'";
                            $R2 = mysqli_query($connect, $Que);
                            while ($I = $R2->fetch_assoc()) {
                                $big = $OBJ2->getcat($I['bigcat_id']);
                                if ($big['bigcat_sta']) {
                                    $sub = $OBJ2->getsub($I['subcat_id']);
                                    if ($sub['subcat_sta']) {
                                        $br = $OBJ2->getbrand($I['brand_id']);
                                        if ($br['brand_sta']) {
                                            $vin = $OBJ2->getvin($I['vindor_id']);
                                            if ($vin['vindor_status']) {
                                                $Q = "SELECT * FROM product_img where product_id=" . $I['product_id'];
                                                $O = mysqli_query($connect, $Q);
                                                $I3 = $O->fetch_assoc();
                                                echo "<div class='col-lg-4 col-sm-6 mt-4'>
                                                <div class='card'>
                                                <div class='card-body'>
                                                <div class='single_category_product'>
                                                <div class='single_category_img'>
                                                <img src='img/pro_img/{$I3['product_img']}' alt='' style='height: 20rem;'>
                                                <div class='category_social_icon'>
                                                <ul>
                                                <li><a href='#''><i class='ti-heart'></i></a></li>
                                                <li><a href='category.php?id={$I['product_id']}'><i class='ti-bag'></i></a></li>
                                                </ul>
                                                </div>
                                                <div class='category_product_text'>
                                                <a href='single-product.php?S={$I['product_id']}'><h5>{$I['product_name']}</h5></a>
                                                </div>
                                                </div>
                                                </div>
                                                <div class='card-footer'><p>JOD{$I['product_price']}</p></div>
                                                </div>
                                                </div>
                                                </div>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'included/footer.php'; ?>
</body>

</html>