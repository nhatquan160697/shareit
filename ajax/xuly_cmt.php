<script type="text/javascript" >
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
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/ContentUlti.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/Utf8ToLatinUtil.php';
?>
<?php 
	$com_mess = $_POST["mess"];
	$com_name = $_POST["name"];
	$news_id = $_POST["id"];
	$queryAddCMT = "INSERT INTO comment(content, email, news_id, status)
					VALUES ('{$com_mess}','{$com_name}','{$news_id}',1)";
	$resultAddCMT = $mysqli->query($queryAddCMT);
?>
<li class="cmtli" style="clear:left;padding-top: 15px; ">
	<img src="/files/matcuoi.jpg" alt="" width="60" height="60px" style="float:left"/>
	<div style="float:left; margin-left: 3px;">
		<b> <?php echo $com_name; ?> </b> <small> &nbsp; <?php echo date('d/m/Y') ?> <a href="#"> Reply </a>  </small>
		<?php
			$mess = nl2br($com_mess);
		?>
		<p> <?php echo $mess; ?> </p>
	</div>
</li>
<div style="clear:left"> </div>