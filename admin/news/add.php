<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Thêm tin tức</h4>
                            </div>
                            <div class="content">
                                <form role="form" action="" method="post" id="frm" enctype="multipart/form-data">
                                    <div class="row">
									<?php
										$tab = $_GET['tab'];
										echo"<script>
												document.getElementById($tab).classList.add('active');
										</script>"
									?>
									<?php
										if(isset($_GET['msg'])) {
									?>
									<h4> <?php echo $_GET['msg'] ?> </h4>
									<?php } ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tên tin</label>
                                                <input type="text" name="tentin" class="form-control border-input" placeholder="Nhập tên tin">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Danh mục</label>
                                                <select class="form-control border-input" name="tendm" required="">
												<?php
													$queryCombo = "SELECT * FROM cat_list";
													$resultCombo = $mysqli->query($queryCombo);
													while($row = mysqli_fetch_assoc($resultCombo)) {
														$name = $row['name'];
														$cat_id = $row['cat_id'];
														if($cat_id == $temp['cat_id']) {
														?>
														<option selected value="<?php echo $cat_id ?>"><?php echo $name ?></option>
														<?php
														} else {
												?>
													<option value="<?php echo $cat_id ?>"><?php echo $name ?></option>
														<?php }
													} ?>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                    
									<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
                                                <input type="file" name="hinhAnh" class="form-control" placeholder="Chọn ảnh" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ID Người đăng</label>
                                                <input type="text" name="nguoidang" class="form-control border-input" value="<?php echo $_SESSION['userinfo']['user_id'] ?>" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label>Mô tả</label>
										<textarea class="form-control border-input" rows="3" name="moTa" required="" placeholder="Nhập mô tả"></textarea>
                                    </div>
									<div class="form-group">
                                        <label>Chi tiết</label>
										<textarea id="chiTiet" class="form-control border-input" rows="5" name="chiTiet" placeholder="Nhập chi tiết"></textarea>
                                    </div>
									
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                    </div>
                                    <div class="clearfix"></div>
									<?php
										if(isset($_POST['submit'])) {
											$tentin = $_POST['tentin'];
											$tendm = $_POST['tendm'];
											$moTa = $_POST['moTa'];
											$nguoidang = $_POST['nguoidang'];
											$chiTiet = $_POST['chiTiet'];
											$hinhAnh = $_FILES['hinhAnh'];
											$tenHinhAnh = $hinhAnh['name'];
											if($hinhAnh != '') {
												$nametmp = explode('.',$tenHinhAnh);
												$duoifile = end($nametmp);
												$tenfile = 'HinhAnh-'.time().'.'.$duoifile;
												$tmp_name = $hinhAnh['tmp_name'];
												$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenfile;
												move_uploaded_file($tmp_name,$path_upload);
											}
											if (empty($tentin)) {
												echo "<h3 style='color:red'>Vui lòng nhập tên của tin!</h3>";
											} else if (empty($moTa)) {
												echo "<h3 style='color:red'>Vui lòng nhập mô tả!</h3>";
											} else if (empty($chiTiet)) {
												echo "<h3 style='color:red'>Vui lòng nhập chi tiết!</h3>";
											} else {
												$queryAdd = "INSERT INTO news(name, cat_id, picture, preview, detail, user_id) VALUES ('{$tentin}','{$tendm}','{$tenfile}','{$moTa}','{$chiTiet}','{$nguoidang}')";
												$resultAdd = $mysqli->query($queryAdd);
												if ( $resultAdd ) {
												header("location:index.php?tab=4&msg=Thêm thành công!");
												} else {  
												header("location:index.php?tab=4&msg=Thêm thất bại!");
												}
											}
										}
									?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
	CKEDITOR.replace( 'chiTiet',
	{
		filebrowserBrowseUrl : 'http://shareit.me:81/templates/admin/assets/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : 'http://shareit.me:81/templates/admin/assets/ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl : 'http://shareit.me:81/templates/admin/assets/ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl : 'http://shareit.me:81/templates/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : 'http://shareit.me:81/templates/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : 'http://shareit.me:81/templates/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	});
</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>