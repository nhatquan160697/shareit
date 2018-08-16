<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<?php
	$cat_id = $_GET['id'];
	$query = "SELECT * FROM cat_list WHERE cat_id = {$cat_id}";
	$ketqua = $mysqli->query($query);
	$arCat = mysqli_fetch_assoc($ketqua);
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM news WHERE cat_id = {$cat_id}";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$tongSoDong = $arTmp['TSD'];
	// số truyện trên 1 trang
	$row_count = ROW_COUNT;
	// Tổng số trang
	$tongSoTrang = ceil($tongSoDong/$row_count);
	// trang hiện tại
	$current_page = 1;
	if(isset($_GET['page'])) {
		$current_page = $_GET['page'];
	}
	// offset
	$offset = ($current_page - 1) * $row_count;
?>
<!-- banner -->
<div class="banner1">
	
</div>
<!-- technology -->
<div class="technology-1">
	<div class="container">
		<div class="col-md-9 technology-left">
			<h1 style="color: #FFFFFF; border: 1px solid #386ECF; margin-bottom: 25px; padding: 5px; background: #386ECF; font-weight: 600"><?php echo $arCat['name'] ?></h1>
			<div class="business">
				<?php
					$query2 = "SELECT news.* , user.fullname as fname, cat_list.color as color, cat_list.name as cname 
								FROM news INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
								INNER JOIN user ON news.user_id = user.user_id
								WHERE news.cat_id = {$cat_id} OR cat_list.parent_id = {$cat_id}
								ORDER BY news_id DESC LIMIT {$offset}, {$row_count}";
					$ketqua2 = $mysqli->query($query2);
					while($arNews = mysqli_fetch_assoc($ketqua2) ) {
						$news_id = $arNews['news_id'];
						$name = $arNews['name'];
						$created_by = $arNews['fname'];
						$counter = $arNews['counter'];
						$picture = $arNews['picture'];
						$preview_text = $arNews['preview'];
				?>
				<div class="rev-1">
					<div class="rev-img">
						<a href="/detail.php?id=<?php echo $news_id ?>"><img src="/files/<?php echo $picture ?>" style="width: 281px; height: 132px;" class="img-responsive" alt=""></a>
					</div>
					<div class="rev-info">
						<h3><a href="/detail.php?id=<?php echo $news_id ?>"><?php echo $name ?></a></h3>
						<p><?php echo $preview_text ?></p>
					</div>
					<div class="clearfix"></div>
					<div class="blog-poast-info">
						<ul>
							<li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"> <?php echo $created_by ?> </a></li>
							<li><i class="glyphicon glyphicon-calendar"> </i><?php echo date('d-m-Y', strtotime($arNews['date_create'])) ?></li>
							<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog" href="#">3 Comments </a></li>
							<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $counter ?> views</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
	</div>
</div>
<!-- technology -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>