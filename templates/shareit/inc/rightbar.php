<!-- technology-right -->
		<div class="col-md-3 technology-right">
				<div class="blo-top">
					<div class="tech-btm">
						<h4>Danh mục </h4>
						<?php
							$query = "SELECT * FROM cat_list WHERE parent_id = 0";
							$ketqua = $mysqli->query($query);
							while($arCat = mysqli_fetch_assoc($ketqua) ) {
								$cat_id = $arCat['cat_id'];
								$name = $arCat['name'];
								// /detail/toi-nhu-anh-duong-ruc-ro-32.html
								$urlCat = '/cat/'.utf8ToLatin($name).'-'.$arCat['cat_id'];
						?>
						<div class="blog-grids">
							<div class="blog-grid-right">
								<h5><a href="<?php echo $urlCat ?>"><?php echo $name ?></a> </h5>
								<ul>
									<?php
										$queryCatCon ="SELECT * FROM cat_list WHERE parent_id = {$cat_id}"; 
										$resultCatCon = $mysqli->query($queryCatCon);
										// Loop thằng con
										while($rowCatCon = mysqli_fetch_assoc($resultCatCon)){
											$urlCatCon = '/cat/'.utf8ToLatin($rowCatCon['name']).'-'.$rowCatCon['cat_id'];
									?>
										<li style="list-style-type: circle; margin-left: 20px;">
											<a href="<?php echo $urlCatCon ?>"><?php echo $rowCatCon['name'] ?></a>
										</li>
									<?php	
										}
									?>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						<?php
							}
						?>
					</div>
				</div>
				<div class="clearfix"> </div>
				<div class="blo-top1">
					<div class="tech-btm">
					<h4>Tin xem nhiều </h4>
						<?php
							$query = "SELECT news.* , user.fullname as fname, cat_list.name as cname 
									  FROM news INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
									  INNER JOIN user ON news.user_id = user.user_id
									  ORDER BY counter DESC LIMIT 5
									  ";
							$ketqua = $mysqli->query($query);
							while($arNews = mysqli_fetch_assoc($ketqua) ) {
								$news_id = $arNews['news_id'];
								$name = $arNews['name'];
								$cname = $arNews['cname'];
								$preview = $arNews['preview'];
								$date_create = $arNews['date_create'];
								$counter = $arNews['counter'];
								$created_by = $arNews['fname'];
								$picture = $arNews['picture'];
								// /detail/toi-nhu-anh-duong-ruc-ro-32.html
								$urlSeo = '/detail/'.utf8ToLatin($name).'-'.$news_id.'.'.'html';
						?>
						<div class="blog-grids">
							<?php
								$queryComment = "SELECT COUNT(*) as DEMCMT FROM comment WHERE news_id = {$news_id}";
								$resultComment = $mysqli->query($queryComment);
								$rowComment = mysqli_fetch_assoc($resultComment);
							?>
							<div class="blog-grid-left">
								<a href="<?php echo $urlSeo ?>"><img src="/files/<?php echo $picture ?>" style="width: 89px; height: 85px;" class="img-responsive" alt=""/></a>
							</div>
							<div class="blog-grid-right">
								<h5><a href="<?php echo $urlSeo ?>"><?php echo $name ?></a> </h5>
							</div>
							<div class="clearfix"> </div>
							<div class="blog-poast-info">
							<ul>
								<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog" href="#"><?php echo $rowComment['DEMCMT'] ?> comments</a></li>
								<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $counter ?> views </li>
							</ul>
						</div>
							<div class="clearfix"> </div>
						</div>
						<?php
							}
						?>
					</div>
				</div>		
		</div>
		<div class="clearfix"></div>
<!-- technology-right -->