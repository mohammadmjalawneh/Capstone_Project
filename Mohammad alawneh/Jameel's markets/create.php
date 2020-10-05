<?php 
ob_start();
include_once 'included/header.php';
include_once 'included/connect.php';
include_once 'included/database.php';
if (isset($_POST['addcos'])){
	$OJ=new DBO();
	$OJ->addcos($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['email'],$_POST['pass'],$_POST['mobile'],"");
	header('Location:Login.php');
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$('document').ready(function() {
		$('#inputRepeatPassword').keyup(function() {
			if(($('#inputRepeatPassword').val())!=($('#inputPassword').val())){
				$('#inputRepeatPassword').css('background', 'pink');
				$('#Submited').attr("disabled", true);
			}
			else {
				$('#inputRepeatPassword').css('background', 'lightgreen');
				$('#Submited').attr("disabled", false);				
			}
		});
	});
</script>
<body class="bg-white">
	<div class="container">
		<div class="whole-wrap">
			<div class="section-top-border">
				<div class="row">
					<div class="col-lg-8 col-md-8">
						<h3 class="mb-30">Rigester</h3>
						<form action="" method="post" enctype="multipart\form-data">
							<div class="mt-10">
								<input type="text" name="fname" placeholder="First Name"
								onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required
								class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="mname" placeholder="Mid. Name" onfocus="this.placeholder = ''"
								onblur="this.placeholder = 'Last Name'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="lname" placeholder="Last Name" onfocus="this.placeholder = ''"
								onblur="this.placeholder = 'Last Name'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''"
								onblur="this.placeholder = 'Email address'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="password" name="pass" placeholder="Password" id="inputPassword"
								onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Password'" required
								class="single-input-primary">
							</div>
							<div class="mt-10">
								<input type="password" id="inputRepeatPassword" name="re-type" placeholder="Re-type Password" data-parsley-equalto="#inputPassword"
								onfocus="this.placeholder = 'retype your password'" onblur="this.placeholder = 'retype your password'" required
								class="single-input-accent">
							</div>
							<div class="mt-10">
								<input type="tel" name="mobile"  placeholder="Your mobile" 
								onfocus="this.placeholder = 'Your mobile'" onblur="this.placeholder = 'Your mobile'" required
								class="single-input-secondary">
							</div>
							<div class="mt-5">
								<button type="submit" class="genric-btn primary e-large pt-1 pb-1 pl-5 pr-5" id='Submited' name="addcos">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include_once 'included/footer.php'; ?>