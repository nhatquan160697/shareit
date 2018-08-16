<!DOCTYPE html>
<html lang="en">
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/ContentUlti.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/Utf8ToLatinUtil.php';
?>
<head>
	<title>Liên hệ với chúng tôi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/templates/contact/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/contact/css/util.css">
	<link rel="stylesheet" type="text/css" href="/templates/contact/css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="contact100-more">
			<i class="zmdi zmdi-phone-in-talk"></i>
			(+84) 126 423 6535
		</div>

		<div class="wrap-contact100">
			<form class="contact100-form validate-form contact" action="" method="post">
				<span class="contact100-form-title">
					Liên hệ với chúng tôi
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Họ và tên</span>
					<input class="input100" id="name" name="hoTen" class="text" placeholder="Họ tên...">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Email</span>
					<input class="input100" type="text" id="email" name="email" placeholder="Email addess...">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100">
					<span class="label-input100">Số điện thoại</span>
					<input class="input100" type="text" id="website" name="phone" placeholder="Phone Number...">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Tin nhắn</span>
					<textarea class="input100" id="message" name="message" placeholder="Questions/Comments..."></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" type="submit" name="submit" id="imageField" >
							Send
						</button>
					</div>
				</div>
				<?php
					if(isset($_POST['submit'])) {
						$hoTen = $_POST['hoTen'];
						$email = $_POST['email'];
						$phone = $_POST['phone'];
						$message = $_POST['message'];
						$queryAdd = "INSERT INTO contact(name,email,phone,content) VALUES ('{$hoTen}','{$email}','{$phone}','{$message}')";
						$resultAdd = $mysqli->query($queryAdd);
						if ( $resultAdd ) {
						header("location:contact.php?tab=2&msg=Thêm thành công!");
						} else {  
						header("location:contact.php?tab=2&msg=Thêm thất bại!");
						}
					}
				?>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="/templates/contact/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/contact/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/contact/vendor/bootstrap/js/popper.js"></script>
	<script src="/templates/contact/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/contact/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/contact/vendor/daterangepicker/moment.min.js"></script>
	<script src="/templates/contact/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/templates/contact/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="/templates/contact/js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="/templates/contact/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
