<?php
	session_start();
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/templates/admin/assets/css/main.css">
	<script src="/templates/admin/assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/templates/admin/assets/img/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>
				<?php
					if(isset($_SESSION['userinfo'])) {
						header("location:/admin/");
					} else {
						if(isset($_POST['submit'])) {
							$username = $_POST['username'];
							$password = $_POST['password'];
							$queryLogin = "SELECT * FROM user
											WHERE username = '{$username}' AND password = '{$password}'";
							$resultLogin = $mysqli->query($queryLogin);
							$arLogin = mysqli_fetch_assoc($resultLogin);
							/// die là dừng ko chạy dòng tiếp theo
							if($arLogin) {
								$_SESSION['userinfo'] = $arLogin;
								header("location:/admin/");
							} else {
								echo "<script> alert('Sai tên đăng nhập hoặc mật khẩu'); </script>";
							}
						}
					}
				?>
				<form class="login100-form validate-form" method="post" action="">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
					</div>
					<br />
					<br />
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="Login" name="submit" />
					</div>
				</form>
			</div>
		</div>
	</div>
	

</body>
</html>
<?php
	ob_end_flush();
?>