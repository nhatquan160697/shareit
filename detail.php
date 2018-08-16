<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/header.php'; ?>
<?php 
	$news_id = $_GET['id'];
	$queryCount = "UPDATE news SET counter = counter + 1 WHERE news_id = {$news_id}";
	$resultCount = $mysqli->query($queryCount);
	$query = "SELECT news.* , user.fullname as fname, cat_list.color as color, cat_list.name as cname 
			  FROM news INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
			  INNER JOIN user ON news.user_id = user.user_id
			  WHERE news_id = {$news_id}";
	$ketqua = $mysqli->query($query);
	$arNews = mysqli_fetch_assoc($ketqua);
?>	
<?php
	$queryComment = "SELECT COUNT(*) as DEMCMT FROM comment WHERE news_id = {$news_id}";
	$resultComment = $mysqli->query($queryComment);
	$rowComment = mysqli_fetch_assoc($resultComment);
?>
<!-- banner -->
<div class="banner1">
	
</div>
<!-- technology -->
<div class="technology-1">
	<div class="container">
		<div class="col-md-9 technology-left">
			<div class="business">
				<div class=" blog-grid2">
					<div class="blog-text">
						<h5><?php echo $arNews['name'] ?></h5>
					</div>
					<div class="blog-poast-info">
						<ul>
							<li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"> <?php echo $arNews['fname'] ?> </a></li>
							<li><i class="glyphicon glyphicon-calendar"> </i><?php echo date('d-m-Y', strtotime($arNews['date_create'])) ?></li>
							<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog" href="#"><?php echo $rowComment['DEMCMT'] ?> Comments </a></li>
							<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $arNews['counter'] ?> views</li>
						</ul>
					</div>
					<img src="/files/<?php echo $arNews['picture']?>" style="width: 656px; height: 308px;" class="img-responsive" alt="">
					<div class="blog-text">
						<p><?php echo $arNews['detail'] ?></p>				
					</div>
				</div>
				<div class="comment">
					<!-- Comment here --> 
					<fieldset style="width:700px; margin-left: 10px;">
						<legend> Bình luận của bạn cho bài viết này </legend>
						<form method="post" class="comment-frm">
							<table>
								<tr>
									<td> Nội dung bình luận </td>
									<td> <textarea name="com-mess" class="com-mess" required></textarea></td>
								</tr>
								<tr>
									<td> Email </td>
									<td> <input name="com-name" type="text" id="com-name" class="com-name" required /> </td>
								</tr>
								<tr>
									<td></td>
									<td><input style="color:white; background: red; border: 1px solid red; border-radius: 5px; margin-left: 400px;" type="submit" value="Comment" class="com-submit" data-newsid=<?php echo $news_id; ?>/></td>
								</tr>
							</table>
						</form>
					</fieldset>
					
					<fieldset style="width:600px; margin-left: 10px; padding: 0px 0px 8px 2px;">
						<legend> Các bình luận trước </legend>
						<ul class="cmtul" id="com-list">
							<?php
								$queryCM = "SELECT * FROM comment WHERE news_id = {$news_id} and status = 1 ORDER BY comment_id DESC";
								$resultCM = $mysqli->query($queryCM);
								if(mysqli_num_rows($resultCM)==0) {
									echo "<span style='color: #CCC'> Chưa có bình luận nào ! </span>";
								} else {
								while($rowCM = mysqli_fetch_assoc($resultCM)) {
							?>
							<li class="cmtli" style="clear:left;padding-top: 15px; ">
								<img src="/files/matcuoi.jpg" alt="" width="60" height="60px" style="float:left"/>
								<div style="float:left; margin-left: 3px;">
									<b> <?php echo $rowCM['email'] ?> </b> <small> &nbsp; <?php echo date('d-m-Y', strtotime($rowCM['date_create']))?> <a href="javascript:void(0)" class="cl-reply" data-setid=<?php echo $rowCM['comment_id']; ?> style="color:blue; font-weight: 600;" > Reply </a>  </small>
									<p> <?php echo nl2br($rowCM['content']) ?> </p>
								</div>
								<ul class="rep-ul<?php echo $rowCM['comment_id']; ?>">
									<?php
										$queryCMC = "SELECT * FROM rep_comment WHERE comment_id = {$rowCM['comment_id']}";
										$resultCMC = $mysqli->query($queryCMC);
										while($rowCMC = mysqli_fetch_assoc($resultCMC)) {
									?>
									<li style="clear:left; margin-left: 52px; padding-top:5px;">
										<img src="/files/matcuoi.jpg" alt="" width="40" height="40px" style="float:left"/>
										<div style="float:left; margin-left: 3px;">
											<b> <?php echo $rowCMC['rep_email']; ?> </b> <small> <?php echo date('d-m-Y', strtotime($rowCMC['rep_date']))?> </small>
											<p> <?php echo nl2br($rowCMC['rep_content']); ?> </p>
										</div>
									</li>
									<?php
										}
									?>
								</ul>
								<fieldset style="width:400px; margin-left: 52px; display:none;" class="cl-rep-form<?php echo $rowCM['comment_id']; ?>">
									<legend> Trả lời </legend>
									<form>
										<table>
											<tr>
												<td> Nội dung bình luận </td>
												<td class="rep-mess"> <textarea class="rep-mess<?php echo $rowCM['comment_id']; ?>"></textarea></td>
											</tr>
											<tr>
												<td> Email </td>
												<td class="rep-name"> <input type="text" class="rep-name<?php echo $rowCM['comment_id']; ?>" /> </td>
											</tr>
											<tr>
												<td></td>
												<td><input type="submit" value="Reply" class="rep-submit" data-comid=<?php echo $rowCM['comment_id']; ?> /></td>
											</tr>
										</table>
									</form>
								</fieldset>
							</li>
							<?php
								}
								}
							?>
						</ul>
					</fieldset>
					<!-- End comment here -->
				</div>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/rightbar.php'; ?>
	</div>
</div>
<script type="text/javascript" >
	n = $("#com-name").val();
	if(isEmail(n)){
		alert('Hãy nhập đúng email');
	}
	$(document).ready(function (){
		$('.comment-frm').validate({
			ignore: [],
			rules: {
				"com-mess": {
					required: true,
				},
				"com-name": {
					required: true,
					email: true,
				},			
			},
			messages: {
				"com-mess": {
					required: "Vui lòng nhập nội dung",
				},
				"com-name": {
					required: "Vui lòng nhập email",
					email: "Email phải đúng định dạng",
				},
			},
		});
	});	
</script>
<!-- technology -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/shareit/inc/footer.php'; ?>	

<script>
function isEmail(emailStr)
{
	
        var emailPat=/^(.+)@(.+)$/
        var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
        var validChars="\[^\\s" + specialChars + "\]"
        var quotedUser="(\"[^\"]*\")"
        var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
        var atom=validChars + '+'
        var word="(" + atom + "|" + quotedUser + ")"
        var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
        var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
        var matchArray=emailStr.match(emailPat)
        if (matchArray==null) {
                return false
        }
        var user=matchArray[1]
        var domain=matchArray[2]
 
        // See if "user" is valid
        if (user.match(userPat)==null) {
            return false
        }
        var IPArray=domain.match(ipDomainPat)
        if (IPArray!=null) {
            // this is an IP address
                  for (var i=1;i<=4;i++) {
                    if (IPArray[i]>255) {
                        return false
                    }
            }
            return true
        }
        var domainArray=domain.match(domainPat)
        if (domainArray==null) {
            return false
        }
 
        var atomPat=new RegExp(atom,"g")
        var domArr=domain.match(atomPat)
        var len=domArr.length
 
        if (domArr[domArr.length-1].length<2 ||
            domArr[domArr.length-1].length>3) {
           return false
        }
 
        if (len<2)
        {
           return false
        }
 
        return true;
}
</script>