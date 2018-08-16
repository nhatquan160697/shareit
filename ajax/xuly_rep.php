<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/ContentUlti.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/Utf8ToLatinUtil.php';
?>
<?php 
	$rep_mess = $_POST["mess"];
	$rep_name = $_POST["name"];
	$com_id = $_POST["com_id"];
	$queryAddCMTR = "INSERT INTO rep_comment(rep_content, rep_email, comment_id)
					VALUES ('{$rep_mess}','{$rep_name}','{$com_id}')";
	$resultAddCMTR = $mysqli->query($queryAddCMTR);
?>
<li style="clear:left; margin-left: 52px; padding-top:5px;">
	<img src="/files/matcuoi.jpg" alt="" width="40" height="40px" style="float:left"/>
	<div style="float:left; margin-left: 3px;">
		<b> <?php echo $rep_name; ?> </b> <small> <?php echo date('d/m/Y') ?> </small>
		<p> <?php echo nl2br($rep_mess); ?> </p>
	</div>
</li>
<div style="clear:left"> </div>