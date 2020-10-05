<?php
require_once 'included/PHPMailer/PHPMailerAutoload.php';
$mail=new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';
$mail->Host='smtp.gmail.com';
$mail->Port='465';
$mail->isHTML();
$mail->Username='jameel.markets2020@gmail.com';
$mail->Password='saif2020';
$mail->SetFrom='no-reply@jameel.markets2020@gmail.com';
$mail->Subject='Password Update';
$subject = "You have a message from your Bitmap Photography.";
$mail->Body="<!DOCTYPE html>
<html lang='en'>
<head>
<title>Jameel's Markets</title>
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
<h4>Costmers care center-Jameel's Market</h4>
<p>Dear Mr/Mrs:".'Jameel Deeb'."</p>
<p>We are So Sorry About Your Password.....</p>
<p>We writing To inform You that, we are changing the Your Password Depending on your request You Should Login and Changing Your Password Imediatly</p>
<p>Your password Now:<span class='font-weight-bold'>".'GGGGGGGGGGGGGGGGGGgg'."</span></p><br><br><br>
<p>Best Regardes</p>
<p>Costomer Center-Jameel's Market</p>
<p>Tel:+962776219747</p>
<img src='https://i.ibb.co/TKrKW4q/logo.png' alt='logo' border='0'>
</div>
</body>
</html>";
$mail->AddAddress('mohammadmalawneh@gmail.com');
$mail->send();