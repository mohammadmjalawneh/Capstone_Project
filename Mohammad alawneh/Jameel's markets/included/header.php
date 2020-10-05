<?php
ob_start();
session_start(); 
include_once 'connect.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart']=array();
}
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>winter</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/lightslider.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/price_rangs.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"search.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#search_result').html(data);
                }
            });
        }
        $('#search_input').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();            
            }
        });
    });
</script>
<body class="bg-white">
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-11">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Category
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <?php
                                            echo "<a class='dropdown-item' href='category.php'>Shop</a>";
                                        $Que="SELECT * FROM bigcat where bigcat_sta='1'";
                                        $res=mysqli_query($connect,$Que);
                                        while ($I=$res->fetch_assoc()) {
                                            echo "<a class='dropdown-item' href='category.php?C={$I['bigcat_id']}'>{$I['bigcat_name']}</a>";
                                        }
                                        ?>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            <div class="dropdown">
                                <a href="cart.php" role="button">
                                   <i class="fas fa-shopping-cart" style="font-size: 24px;"></i><span><?php  if (sizeof($_SESSION['cart'])!=0) {
                                       echo sizeof($_SESSION['cart']);
                                   } 
                                ?></span></a>
                                </a>
                                <span style='font-size: 24px;color:black;'>|</span>
                                <?php if (isset($_SESSION['cid'])) {
                                    echo "<a href='logout.php' style='font-size: 16px;color:black;' role='button'>Logout</a>";
                                }else{
                                    echo "<a href='login.php' style='font-size: 16px;color:black;' role='button'>Login</a>";
                                }
                                 ?>
                            </div>
                            <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner" method="GET" action="category.php?val=<?php $_GET['search_input'] ?>">
                    <input type="text" class="form-control" id="search_input" name="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
                <div class="d-flex justify-content-between search-inner" id="search_result">
                </div>
            </div>
        </div>
    </header>