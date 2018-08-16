<?php
	session_start();
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/CheckUserUlti.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/ContentUlti.php';
?>
<?php
$status = $_POST['astatus'];
$acl = $_POST['acl'];
if ($status == 1) {	
	?>
	<a href="javascript:void(0)" onclick="return setStatus(0, '<?php echo $acl?>')">
		<img src="/templates/admin/assets/img/deactive.gif" alt="" />
	</a>
	<?php
	$queryStatus = "UPDATE news SET is_slide = 0 WHERE news_id = {$acl}";
} else if ($status == 0) {
	?>
	<a href="javascript:void(0)" onclick="return setStatus(1, '<?php echo $acl?>')">
		<img src="/templates/admin/assets/img/active.gif" alt="" />
	</a>
	<?php
	$queryStatus = "UPDATE news SET is_slide = 1 WHERE news_id = {$acl}";
}
	$resultStatus = $mysqli->query($queryStatus);
?>
<?php
	ob_end_flush();
?>