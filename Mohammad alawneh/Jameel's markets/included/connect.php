<?php
$connect = mysqli_connect('localhost', 'root', '', 'matrixstore');
if (!$connect) {
	die("Database connection failed");
}
