<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/ContentUlti.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/Utf8ToLatinUtil.php';
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>SHARE IT - TTNQ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Business_Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="/templates/shareit/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="/templates/shareit/css/style.css" rel='stylesheet' type='text/css' />	
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="/templates/shareit/js/jquery-3.3.1.min.js"></script>
<script src="/templates/shareit/js/comment.js"></script>
<script src="/templates/shareit/js/rep-comment.js"></script>
<script src="/templates/shareit/js/jquery.validate.min.js"></script>
<script src="/templates/shareit/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>

</head>
<body>
	<!--start-main-->
           <div class="header">
		        <div class="header-top">
			        <div class="container">
						<div class="logo">
							<a href="/index.php"><h1>SHARE IT - TTNQ</h1></a>
						</div>
						<div class="search">
							<form>
								<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
								<input type="submit" value="">
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			
<!--head-bottom-->
<div class="head-bottom">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/index.php">Home</a></li>
            <?php
				$query = "SELECT * FROM cat_list WHERE parent_id = 0";
				$result = $mysqli->query($query);
				// LẤY RA thằng cha
				while($row = mysqli_fetch_assoc($result)){
					$id = $row['cat_id'];
					$name = $row['name'];
					$parent_id = $row['parent_id'];
			?>
				<li class="dropdown">
				<?php
					$queryMenu = "SELECT * FROM cat_list WHERE parent_id = {$id}";
					$resultMenu = $mysqli->query($queryMenu);
					$arMenu = mysqli_fetch_assoc($resultMenu);
					if(mysqli_num_rows($resultMenu) == 0) {
				?>
					<li><a href="/index.php"><?php echo $name ?></a></li>
				<?php
					} else {?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $name ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 
							$queryMenu1 = "SELECT * FROM cat_list WHERE parent_id = {$id}";
							$resultMenu1 = $mysqli->query($queryMenu1); 
							while($arMenu1 = mysqli_fetch_assoc($resultMenu1)){
							?>
							<li><a href="/cat.php?id=<?php echo $arMenu1['cat_id'] ?>"><?php echo $arMenu1['name'] ?></a></li>
					  <?php } ?>
					 </ul>
					<?php } ?>
				</li>
			<?php
				}
			?>
			<li><a href="/contact.php">Liên hệ</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>
<!--head-bottom-->
</div>