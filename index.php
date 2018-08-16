<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<style>
.btn {
  display: inline-block;
  padding: 13px 20px;
  color: #fff;
  text-decoration: none;
  position: relative;
  background: transparent;
  border: 1px solid #e1e1e1;
  font: 12px/1.2 "Oswald", sans-serif;
  letter-spacing: 0.4em;
  text-align: center;
  text-indent: 2px;
  text-transform: uppercase;
  transition: color 0.1s linear 0.05s;
}
.btn::before {
  content: "";
  display: block;
  position: absolute;
  top: 50%;
  left: 0;
  width: 100%;
  height: 1px;
  background: #e1e1e1;
  z-index: 1;
  opacity: 0;
  transition: height 0.2s ease, top 0.2s ease, opacity 0s linear 0.2s;
}
.btn::after {
  transition: border 0.1s linear 0.05s;
}
.btn .btn-inner {
  position: relative;
  z-index: 2;
}
.btn:hover {
  color: #373737;
  transition: color 0.1s linear 0s;
}
.btn:hover::before {
  top: 0;
  height: 100%;
  opacity: 1;
  transition: height 0.2s ease, top 0.2s ease, opacity 0s linear 0s;
}
.btn:hover::after {
  border-color: #373737;
  transition: border 0.1s linear 0s;
}

.slideshow {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 550px;
  z-index: 1;
  margin-bottom: 50px;
}
.slideshow .slideshow-inner {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.slideshow .slides {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}
.slideshow .slide {
  display: none;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.slideshow .slide.is-active {
  display: block;
}
.slideshow .slide.is-loaded {
  opacity: 1;
}
.slideshow .slide .caption {
  padding: 0 100px;
}
.slideshow .slide .image-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-position: center;
  z-index: 1;
  background-size: cover;
  image-rendering: optimizeQuality;
}
.slideshow .slide .image-container::before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
}
.slideshow .slide .image {
  width: 100%;
  width: 100%;
  object-fit: cover;
  height: 100%;
}
.slideshow .slide-content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
  color: #fff;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
}
.slideshow .slide .title {
  margin: 0 auto 15px;
  max-width: 1000px;
  font: 300 50px/1.2 "Oswald", sans-serif;
  letter-spacing: 0.35em;
  text-transform: uppercase;
}
.slideshow .slide .text {
  margin: 0 auto;
  max-width: 1000px;
  font-size: 18px;
  line-height: 1.4;
}
.slideshow .slide .btn {
  margin: 15px 0 0;
  border-color: #fff;
}
.slideshow .slide .btn::before {
  background: #fff;
}
.slideshow .pagination {
  position: absolute;
  bottom: 35px;
  left: 0;
  width: 100%;
  height: 12px;
  cursor: default;
  z-index: 2;
  text-align: center;
}
.slideshow .pagination .item {
  display: inline-block;
  padding: 15px 5px;
  position: relative;
  width: 46px;
  height: 32px;
  cursor: pointer;
  text-indent: -999em;
  z-index: 1;
}
.slideshow .pagination .item + .page {
  margin-left: -2px;
}
.slideshow .pagination .item::before {
  content: "";
  display: block;
  position: absolute;
  top: 15px;
  left: 5px;
  width: 36px;
  height: 2px;
  background: rgba(255, 255, 255, 0.5);
  transition: background 0.2s ease;
}
.slideshow .pagination .item::after {
  width: 0;
  background: #fff;
  z-index: 2;
  transition: width 0.2s ease;
}
.slideshow .pagination .item:hover::before, .slideshow .pagination .item.is-active::before {
  background-color: #fff;
}
.slideshow .arrows .arrow {
  margin: -33px 0 0;
  padding: 20px;
  position: absolute;
  top: 50%;
  cursor: pointer;
  z-index: 3;
}
.slideshow .arrows .prev {
  left: 30px;
}
.slideshow .arrows .prev:hover .svg {
  left: -10px;
}
.slideshow .arrows .next {
  right: 30px;
}
.slideshow .arrows .next:hover .svg {
  left: 10px;
}
.slideshow .arrows .svg {
  position: relative;
  left: 0;
  width: 14px;
  height: 26px;
  fill: #fff;
  transition: left 0.2s ease;
}
</style>
<?php
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM news";
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
<main class="main-content">
  <section class="slideshow">
	<?php
		$querySlide1 = "SELECT slide.picture as pics, news.name as nname, preview, slide.news_id as idn From slide INNER JOIN news ON slide.news_id = news.news_id WHERE slide_id = 1";
		$resultSlide1 = $mysqli->query($querySlide1);
		$arSlide1 = mysqli_fetch_assoc($resultSlide1);
		$urlSeo1 = '/detail/'.utf8ToLatin($arSlide1['nname']).'-'.$arSlide1['idn'].'.'.'html';
	?>
	<?php
		$querySlide2 = "SELECT slide.picture as pics, news.name as nname, preview, slide.news_id as idn From slide INNER JOIN news ON slide.news_id = news.news_id WHERE slide_id = 2";
		$resultSlide2 = $mysqli->query($querySlide2);
		$arSlide2 = mysqli_fetch_assoc($resultSlide2);
		$urlSeo2 = '/detail/'.utf8ToLatin($arSlide2['nname']).'-'.$arSlide2['idn'].'.'.'html';
	?>
	<?php
		$querySlide3 = "SELECT slide.picture as pics, news.name as nname, preview, slide.news_id as idn From slide INNER JOIN news ON slide.news_id = news.news_id WHERE slide_id = 3";
		$resultSlide3 = $mysqli->query($querySlide3);
		$arSlide3 = mysqli_fetch_assoc($resultSlide3);
		$urlSeo3 = '/detail/'.utf8ToLatin($arSlide3['nname']).'-'.$arSlide3['idn'].'.'.'html';
	?>
	<?php
		$querySlide4 = "SELECT slide.picture as pics, news.name as nname, preview, slide.news_id as idn From slide INNER JOIN news ON slide.news_id = news.news_id WHERE slide_id = 4";
		$resultSlide4 = $mysqli->query($querySlide4);
		$arSlide4 = mysqli_fetch_assoc($resultSlide4);
		$urlSeo4 = '/detail/'.utf8ToLatin($arSlide4['nname']).'-'.$arSlide4['idn'].'.'.'html';
	?>
    <div class="slideshow-inner">
      <div class="slides">
        <div class="slide is-active ">
          <div class="slide-content">
            <div class="caption">
              <div class="title"><?php echo $arSlide1['nname'] ?></div>
              <div class="text">
                <p><?php echo $arSlide1['preview'] ?></p>
              </div> 
              <a href="<?php echo $urlSeo1 ?>" class="btn">
                <span class="btn-inner">Learn More</span>
              </a>
            </div>
          </div>
          <div class="image-container"> 
            <img src="/files/<?php echo $arSlide1['pics'] ?>" alt="" class="image" />
          </div>
        </div>
		<div class="slide">
          <div class="slide-content">
            <div class="caption">
              <div class="title"><?php echo $arSlide2['nname'] ?></div>
              <div class="text">
                <p><?php echo $arSlide2['preview'] ?></p>
              </div> 
              <a href="<?php echo $urlSeo2 ?>" class="btn">
                <span class="btn-inner">Learn More</span>
              </a>
            </div>
          </div>
          <div class="image-container"> 
            <img src="/files/<?php echo $arSlide2['pics'] ?>" alt="" class="image" />
          </div>
        </div>
		<div class="slide">
          <div class="slide-content">
            <div class="caption">
              <div class="title"><?php echo $arSlide3['nname'] ?></div>
              <div class="text">
                <p><?php echo $arSlide3['preview'] ?></p>
              </div> 
              <a href="<?php echo $urlSeo3 ?>" class="btn">
                <span class="btn-inner">Learn More</span>
              </a>
            </div>
          </div>
          <div class="image-container"> 
            <img src="/files/<?php echo $arSlide3['pics'] ?>" alt="" class="image" />
          </div>
        </div>
        <div class="slide">
          <div class="slide-content">
            <div class="caption">
              <div class="title"><?php echo $arSlide4['nname'] ?></div>
              <div class="text">
                <p><?php echo $arSlide4['preview'] ?></p>
              </div> 
              <a href="<?php echo $urlSeo4 ?>" class="btn">
                <span class="btn-inner">Learn More</span>
              </a>
            </div>
          </div>
          <div class="image-container"> 
            <img src="/files/<?php echo $arSlide4['pics'] ?>" alt="" class="image" />
          </div>
        </div>
      </div>
      <div class="pagination">
        <div class="item is-active"> 
          <span class="icon">1</span>
        </div>
        <div class="item">
          <span class="icon">2</span>
        </div>
        <div class="item">
          <span class="icon">3</span>
        </div>
        <div class="item">
          <span class="icon">4</span>
        </div>
      </div>
      <div class="arrows">
        <div class="arrow prev">
          <span class="svg svg-arrow-left">
            <svg version="1.1" id="svg4-Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px" viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve"> <path d="M13,26c-0.256,0-0.512-0.098-0.707-0.293l-12-12c-0.391-0.391-0.391-1.023,0-1.414l12-12c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414L2.414,13l11.293,11.293c0.391,0.391,0.391,1.023,0,1.414C13.512,25.902,13.256,26,13,26z"/> </svg>
            <span class="alt sr-only"></span>
          </span>
        </div>
        <div class="arrow next">
          <span class="svg svg-arrow-right">
            <svg version="1.1" id="svg5-Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px" viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve"> <path d="M1,0c0.256,0,0.512,0.098,0.707,0.293l12,12c0.391,0.391,0.391,1.023,0,1.414l-12,12c-0.391,0.391-1.023,0.391-1.414,0s-0.391-1.023,0-1.414L11.586,13L0.293,1.707c-0.391-0.391-0.391-1.023,0-1.414C0.488,0.098,0.744,0,1,0z"/> </svg>
            <span class="alt sr-only"></span>
          </span>
        </div>
      </div>
    </div> 
  </section>
</main>
<!-- end banner -->
<script>
var slideshowDuration = 4000;
var slideshow=$('.main-content .slideshow');

function slideshowSwitch(slideshow,index,auto){
  if(slideshow.data('wait')) return;

  var slides = slideshow.find('.slide');
  var pages = slideshow.find('.pagination');
  var activeSlide = slides.filter('.is-active');
  var activeSlideImage = activeSlide.find('.image-container');
  var newSlide = slides.eq(index);
  var newSlideImage = newSlide.find('.image-container');
  var newSlideContent = newSlide.find('.slide-content');
  var newSlideElements=newSlide.find('.caption > *');
  if(newSlide.is(activeSlide))return;

  newSlide.addClass('is-new');
  var timeout=slideshow.data('timeout');
  clearTimeout(timeout);
  slideshow.data('wait',true);
  var transition=slideshow.attr('data-transition');
  if(transition=='fade'){
    newSlide.css({
      display:'block',
      zIndex:2
    });
    newSlideImage.css({
      opacity:0
    });

    TweenMax.to(newSlideImage,1,{
      alpha:1,
      onComplete:function(){
        newSlide.addClass('is-active').removeClass('is-new');
        activeSlide.removeClass('is-active');
        newSlide.css({display:'',zIndex:''});
        newSlideImage.css({opacity:''});
        slideshow.find('.pagination').trigger('check');
        slideshow.data('wait',false);
        if(auto){
          timeout=setTimeout(function(){
            slideshowNext(slideshow,false,true);
          },slideshowDuration);
          slideshow.data('timeout',timeout);}}});
  } else {
    if(newSlide.index()>activeSlide.index()){
      var newSlideRight=0;
      var newSlideLeft='auto';
      var newSlideImageRight=-slideshow.width()/8;
      var newSlideImageLeft='auto';
      var newSlideImageToRight=0;
      var newSlideImageToLeft='auto';
      var newSlideContentLeft='auto';
      var newSlideContentRight=0;
      var activeSlideImageLeft=-slideshow.width()/4;
    } else {
      var newSlideRight='';
      var newSlideLeft=0;
      var newSlideImageRight='auto';
      var newSlideImageLeft=-slideshow.width()/8;
      var newSlideImageToRight='';
      var newSlideImageToLeft=0;
      var newSlideContentLeft=0;
      var newSlideContentRight='auto';
      var activeSlideImageLeft=slideshow.width()/4;
    }

    newSlide.css({
      display:'block',
      width:0,
      right:newSlideRight,
      left:newSlideLeft
      ,zIndex:2
    });

    newSlideImage.css({
      width:slideshow.width(),
      right:newSlideImageRight,
      left:newSlideImageLeft
    });

    newSlideContent.css({
      width:slideshow.width(),
      left:newSlideContentLeft,
      right:newSlideContentRight
    });

    activeSlideImage.css({
      left:0
    });

    TweenMax.set(newSlideElements,{y:20,force3D:true});
    TweenMax.to(activeSlideImage,1,{
      left:activeSlideImageLeft,
      ease:Power3.easeInOut
    });

    TweenMax.to(newSlide,1,{
      width:slideshow.width(),
      ease:Power3.easeInOut
    });

    TweenMax.to(newSlideImage,1,{
      right:newSlideImageToRight,
      left:newSlideImageToLeft,
      ease:Power3.easeInOut
    });

    TweenMax.staggerFromTo(newSlideElements,0.8,{alpha:0,y:60},{alpha:1,y:0,ease:Power3.easeOut,force3D:true,delay:0.6},0.1,function(){
      newSlide.addClass('is-active').removeClass('is-new');
      activeSlide.removeClass('is-active');
      newSlide.css({
        display:'',
        width:'',
        left:'',
        zIndex:''
      });

      newSlideImage.css({
        width:'',
        right:'',
        left:''
      });

      newSlideContent.css({
        width:'',
        left:''
      });

      newSlideElements.css({
        opacity:'',
        transform:''
      });

      activeSlideImage.css({
        left:''
      });

      slideshow.find('.pagination').trigger('check');
      slideshow.data('wait',false);
      if(auto){
        timeout=setTimeout(function(){
          slideshowNext(slideshow,false,true);
        },slideshowDuration);
        slideshow.data('timeout',timeout);
      }
    });
  }
}

function slideshowNext(slideshow,previous,auto){
  var slides=slideshow.find('.slide');
  var activeSlide=slides.filter('.is-active');
  var newSlide=null;
  if(previous){
    newSlide=activeSlide.prev('.slide');
    if(newSlide.length === 0) {
      newSlide=slides.last();
    }
  } else {
    newSlide=activeSlide.next('.slide');
    if(newSlide.length==0)
      newSlide=slides.filter('.slide').first();
  }

  slideshowSwitch(slideshow,newSlide.index(),auto);
}

function homeSlideshowParallax(){
  var scrollTop=$(window).scrollTop();
  if(scrollTop>windowHeight) return;
  var inner=slideshow.find('.slideshow-inner');
  var newHeight=windowHeight-(scrollTop/2);
  var newTop=scrollTop*0.8;

  inner.css({
    transform:'translateY('+newTop+'px)',height:newHeight
  });
}

$(document).ready(function() {
 $('.slide').addClass('is-loaded');

 $('.slideshow .arrows .arrow').on('click',function(){
  slideshowNext($(this).closest('.slideshow'),$(this).hasClass('prev'));
});

 $('.slideshow .pagination .item').on('click',function(){
  slideshowSwitch($(this).closest('.slideshow'),$(this).index());
});

 $('.slideshow .pagination').on('check',function(){
  var slideshow=$(this).closest('.slideshow');
  var pages=$(this).find('.item');
  var index=slideshow.find('.slides .is-active').index();
  pages.removeClass('is-active');
  pages.eq(index).addClass('is-active');
});

/* Lazyloading
$('.slideshow').each(function(){
  var slideshow=$(this);
  var images=slideshow.find('.image').not('.is-loaded');
  images.on('loaded',function(){
    var image=$(this);
    var slide=image.closest('.slide');
    slide.addClass('is-loaded');
  });
*/

var timeout=setTimeout(function(){
  slideshowNext(slideshow,false,true);
},slideshowDuration);

slideshow.data('timeout',timeout);
});

if($('.main-content .slideshow').length > 1) {
  $(window).on('scroll',homeSlideshowParallax);
}
</script>
<div class="clearfix"></div>
<!-- technology -->
<div class="technology">
	<div class="container">
		<div class="col-md-9 technology-left">
		<div class="tech-no">
			<?php
				$query = "SELECT news.* , user.fullname as fname, cat_list.color as color, cat_list.name as cname , cat_list.cat_id as catid
						  FROM news INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
						  INNER JOIN user ON news.user_id = user.user_id
						  WHERE is_slide = 1
						  ORDER BY news_id DESC
						  LIMIT {$offset},{$row_count}";
				$ketqua = $mysqli->query($query);
				while($arNews = mysqli_fetch_assoc($ketqua) ) {
					$news_id = $arNews['news_id'];
					$name = $arNews['name'];
					$cname = $arNews['cname'];
					$preview = $arNews['preview'];
					$color = $arNews['color'];
					$date_create = $arNews['date_create'];
					$created_by = $arNews['fname'];
					$picture = $arNews['picture'];
					$counter = $arNews['counter'];
					// /detail/toi-nhu-anh-duong-ruc-ro-32.html
					$urlSeo = '/detail/'.utf8ToLatin($name).'-'.$news_id.'.'.'html';
					$urlCat = '/cat/'.utf8ToLatin($cname).'-'.$arNews['catid'];
			?>
					<!-- technology-top -->
			<div class="soci">
				<ul>
					<li><a href="#" class="facebook-1"> </a></li>
					<li><a href="#" class="facebook-1 twitter"> </a></li>
					<li><a href="#" class="facebook-1 chrome"> </a></li>
					<li><a href="#"><i class="glyphicon glyphicon-envelope"> </i></a></li>
					<li><a href="#"><i class="glyphicon glyphicon-print"> </i></a></li>
					<li><a href="#"><i class="glyphicon glyphicon-plus"> </i></a></li>
				</ul>
			</div>
			 <div class="tc-ch">
					<?php
						$queryComment = "SELECT COUNT(*) as DEMCMT FROM comment WHERE news_id = {$news_id}";
						$resultComment = $mysqli->query($queryComment);
						$rowComment = mysqli_fetch_assoc($resultComment);
					?>
					<div class="tch-img">
						<a href="<?php echo $urlSeo ?>"><img src="/files/<?php echo $picture ?>" class="img-responsive" style="width: 656px; height: 308px;" alt=""/></a>
					</div>
					<a class="blog <?php echo $color ?>" href="<?php echo $urlCat ?>"><?php echo $cname ?></a>
					<h3><a href="<?php echo $urlSeo ?>"><?php echo $name ?></a></h3>
						<p><?php echo $preview ?></p>
					
						<div class="blog-poast-info">
							<ul>
								<li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"> <?php echo $created_by ?> </a></li>
								<li><i class="glyphicon glyphicon-calendar"> </i><?php echo date('d-m-Y', strtotime($date_create)) ?></li>
								<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog" href="#"> <?php echo $rowComment['DEMCMT'] ?> Comments </a></li>
								<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $counter ?> views</li>
							</ul>
						</div>
			</div>
			<div class="clearfix"></div>
			<?php
				}
			?>
			<!-- technology-top -->	
			<!-- page -->
			<div class="col-sm-6">
				<div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ <?php echo $current_page; ?> đến <?php echo $tongSoTrang ?> của <?php echo $tongSoDong ?> tin</div>
			</div>
			<div class="col-sm-6" style="text-align: right;">
				<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
					<ul class="pagination">
						<?php
						 for($i = 1; $i <= $tongSoTrang; $i++) {
							 $urlSeo = "/page/".$i;
							 $active = '';
							 if($i == $current_page) {
								 $active = 'active';
							 }
						?>
						<li class="paginate_button <?php echo $active ?>" ><a href="<?php echo $urlSeo ?>"><?php echo $i; ?></a></li>
						<?php
						 }
						?>
					</ul>
				</div>
			</div>
			<!-- end page -->
		</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
	</div>
</div>
<!-- technology -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>	