<?php ob_start(); 
		require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php';
?>
<?php
$tab = $_GET['tab'];
echo"<script>
		document.getElementById($tab).classList.add('active');
</script>"
?>
<?php
if(empty($_GET['id'])){
	header('location: /admin/cat');
}else{
	$id = $_GET['id'];
	
	$query = "DELETE FROM cat_list WHERE cat_id = {$id}";
	$result = $mysqli->query($query);
	if($result){
		header('location: index.php?msg=Xóa thành công');
	}else{
		header('location: index.php?msg=Xóa thất bại');
	}
}
?>
<?php ob_end_flush(); ?>