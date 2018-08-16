<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	if(isset($_GET['msg'])){
		echo '<script>alert("'.$_GET['msg'].'")</script>';
	}
?>
<?php
$tab = $_GET['tab'];
echo"<script>
		document.getElementById($tab).classList.add('active');
</script>"?>
<?php
	$query = "SELECT * FROM cat_list";
	$result = $mysqli->query($query);
	$categories = array();
	while ($row = mysqli_fetch_assoc($result)){
		$categories[] = $row;
	}
	function showCategories($categories, $parent_id = 0, $char = '')
	{
		foreach ($categories as $key => $item)
		{
			// Nếu là chuyên mục con thì hiển thị
			if ($item['parent_id'] == $parent_id)
			{
				if($item['cat_id'] != $_GET['id']){
					echo '<option value="'.$item['cat_id'].'">';
						echo $char. $item['name'];
					echo '</option>';
				}
				// Xóa chuyên mục đã lặp
				//unset($categories[$key]);
				 
				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				//showCategories($categories, $item['cat_id'], $char.'---');
			}
		}
	}
	//--------------------------------------
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Chỉnh sửa danh mục tin tức</h4>
                            </div>
                            <div class="content">
							<?php
								$getName = $_GET['name'];
								$getId = $_GET['id'];
								if(empty($getName) || empty($getId)){
									header('location: index.php');
								}else{
									if(isset($_POST['submit'])){
										$name = $_POST['catname'];
										$parent_id = $_POST['catlist'];
										$color = $_POST['color-list'];
										$queryValid = "SELECT * FROM cat_list WHERE name = '{$name}' AND name<>(SELECT name FROM cat_list WHERE cat_id = {$getId})";
										$resultValid = $mysqli->query($queryValid);
										if(mysqli_num_rows($resultValid) > 0){
											echo '<script>alert("Tên danh mục đã tồn tại")</script>';
										}else if(empty($name)){
											echo '<script>alert("Hãy nhập danh mục")</script>';
										}else{
											$queryUpdate = "UPDATE cat_list SET name = '{$name}', parent_id = {$parent_id}, color = '{$color}' WHERE cat_id = {$getId}";
											$resultUpdate = $mysqli->query($queryUpdate);
											if($resultUpdate){
												header('location: index.php?msg=Sửa Thành Công');
											}else{
												header('location: index.php?msg=Thất bại!');
											}
										}
									}
								}
							?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tên danh mục</label>
                                                <input type="text" name="catname" class="form-control border-input" placeholder="Tên danh mục" value="<?php echo $getName; ?>">
                                            </div>
                                        </div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Danh mục cha</label>
												<select name="catlist" class="form-control border-input">
													<option value="0">Đặt làm danh mục cha</option>
													<?php
														showCategories($categories);
													?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Màu danh mục</label>
												<select name="color-list" class="form-control border-input">
													<option value="blue">Màu xanh dương</option>
													<option value="gren">Màu xanh lá cây </option>
													<option value="orn">Màu cam</option>
													<option value="pink">Màu hồng</option>
												</select>
											</div>
										</div>
                                    </div>
                                    <div class="text-center">
                                        <input name="submit" type="submit" class="btn btn-info btn-fill btn-wd" value="Thực hiện" />
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>