<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sửa tin tức</h4>
                            </div>
                            <div class="content">
				
                                <form role="form" action="" method="post" id="frm" enctype="multipart/form-data">
                                    <?php
										$idSua = $_GET['idSua'];
										$queryTrung = "SELECT * FROM news WHERE news_id = {$idSua}";
										$resultTrung = $mysqli->query($queryTrung);
										$temp = mysqli_fetch_assoc($resultTrung);
										if(isset($_POST['submit'])) {
											$tentin = $_POST['tentin'];
											$tendm = $_POST['tendm'];
											$moTa = $_POST['moTa'];
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
											if ($_FILES['hinhAnh']['error'] <= 0) {
												$queryDelete = "SELECT * FROM news WHERE news_id = {$idSua}";
												$resultDelete = $mysqli->query($queryDelete);
												$rowDelete = mysqli_fetch_assoc($resultDelete);
												unlink($_SERVER['DOCUMENT_ROOT']."/files/" . $rowDelete['picture']);
												$queryUpdate = "UPDATE news SET name = '{$tentin}', preview = '{$moTa}', picture = '{$tenfile}',cat_id = '{$tendm}', detail = '{$chiTiet}'
																WHERE news_id = '{$idSua}' ";
												$resultUpdate = $mysqli->query($queryUpdate);
												if( $resultUpdate ) {
													header("location:index.php?tab=4&msg=Sửa thành công!");
												} else {  
													header("location:index.php?tab=4&msg=Sửa thất bại!");
												}
											}
											else {
												$queryUpdate = "UPDATE news SET name = '{$tentin}', preview = '{$moTa}', cat_id = '{$tendm}', detail = '{$chiTiet}'
																WHERE news_id = '{$idSua}' ";
												$resultUpdate = $mysqli->query($queryUpdate);
												if( $resultUpdate ) {
													header("location:index.php?tab=4&msg=Sửa thành công!");
												} else {  
													header("location:index.php?tab=4&msg=Sửa thất bại!");
												}
											}
										}
									?>
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
											<input type="text" name="tentin" class="form-control border-input" value="<?php echo $temp['name'] ?>" >
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
                                                <input type="file" name="hinhAnh" class="form-control border-input" placeholder="Chọn ảnh" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh cũ</label>
                                                <img src="/files/<?php echo $temp['picture']?>" width="120px" alt="" /> Xóa <input type="checkbox" name="delete_picture" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                     
									<div class="form-group">
                                        <label>Mô tả</label>
										<textarea class="form-control border-input" rows="3" name="moTa" required=""><?php echo $temp['preview']?></textarea>
                                    </div>
									<div class="form-group">
                                        <label>Chi tiết</label>
										<textarea class="form-control ckeditor border-input" rows="5" name="chiTiet"><?php echo $temp['detail']?></textarea>
                                    </div>
									
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
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