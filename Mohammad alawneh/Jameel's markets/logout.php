<?php
session_start();
unset($_SESSION['cart']);
unset($_SESSION['cid']);
header("Location:index.php");
