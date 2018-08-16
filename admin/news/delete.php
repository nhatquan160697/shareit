<?php
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
?>
<?php
	$delID = $_GET['delID'];
	$queryOld = "SELECT * FROM news WHERE news_id = {$delID}";
	$resultOld = $mysqli->query($queryOld);
	$arOld = mysqli_fetch_assoc($resultOld);
	$fileName = $arOld['picture'];
	if($fileName != ''){
		$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileName;
		unlink($filePath);
	}
	$queryDelete = "DELETE FROM news WHERE news_id = {$delID} ";
	$resultDelete = $mysqli->query($queryDelete);
	if ($resultDelete) {
		header("location:index.php?tab=3&msg=Xóa thành công!");
	} else {
		header("location:index.php?tab=3&msg=Xóa thất bại!");	
	}	
	
?>
<?php
	ob_end_flush();
?>
