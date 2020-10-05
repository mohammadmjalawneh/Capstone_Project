<?php
include_once 'database.php';
function getdata($id){
	$I=new DBO();
	$IA=$I->get_vin($id);
	$pass=pass_gene();
	$I->up_pass($pass,$IA['vin_id']);
	SendingMails($pass,$IA['vin_email'],$IA['vin_fname'].$IA['vin_lname']);
}
function pass_gene(){
	$pass='';
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	for ($i = 0; $i < 14; $i++) {
		$n = rand(0, strlen($alphabet)-1);
		$pass.=$alphabet[$n];
	}
	return $pass;
}
function SendingMails($Password,$resiver,$name){
	require_once 'PHPMailer/PHPMailerAutoload.php';
	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Host='smtp.gmail.com';
	$mail->Port='465';
	$mail->isHTML();
	$mail->Username='marketsjameel@gmail.com';
	$mail->Password='saif2020';
	$mail->SetFrom='no-reply@howcode.org';
	$mail->Subject='Password Update';
	$subject = "You have a message from your Bitmap Photography.";
	$mail->Body="<!DOCTYPE html>
	<html lang='en'>
	<head>
	<title>Bootstrap 4 Example</title>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
	</head>
	<body>
	<div class='container'>
	<img src='https://i.ibb.co/TKrKW4q/logo.png' alt='logo' border='0'>
	<h4>Vindors Department-Jameel's Market</h4>
	<p>Dear Mr/Mrs:".$name."</p>
	<p>We are So Sorry About Your Password.....</p>
	<p>We writing To inform You that, we are changing the Your Password Depending on your request You Should Login and Changing Your Password Imediatly</p>
	<p>Your password Now:<span class='font-weight-bold'>".$Password."</span></p><br><br><br>
	<p>Best Regardes</p>
	<p>Costomer Center-Jameel's Market</p>
	<p>Tel:+962776219747</p>
	<img src='https://i.ibb.co/TKrKW4q/logo.png' alt='logo' border='0'>
	</div>
	</body>
	</html>";
	$mail->AddAddress($resiver);
	$mail->send();
}