<?php 
session_start();
unset($_SESSION['vid']);
header('Location:index.php');