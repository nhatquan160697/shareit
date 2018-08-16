<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sửa người dùng</h4>
                            </div>
                            <div class="content">
				
                                <form role="form" action="" method="post" id="frm" enctype="multipart/form-data">
                                    <?php
										$idSua = $_GET['idSua'];
										$queryTrung = "SELECT * FROM user WHERE user_id = {$idSua}";
										$resultTrung = $mysqli->query($queryTrung);
										$temp = mysqli_fetch_assoc($resultTrung);
										if($temp['username'] == 'admin' && $_SESSION['userinfo']['username'] != 'admin') {
											header("location:index.php?msg=Bạn không có quyền sửa admin");
										}
										if(isset($_POST['submit'])) {
											$username = $_POST['username'];
											$fullname = $_POST['fullname'];
											$chucvu = $_POST['chucvu'];
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
												$queryDelete = "SELECT * FROM user WHERE user_id = {$idSua}";
												$resultDelete = $mysqli->query($queryDelete);
												$rowDelete = mysqli_fetch_assoc($resultDelete);
												unlink($_SERVER['DOCUMENT_ROOT']."/files/" . $rowDelete['avatar']);
												$queryUpdate = "UPDATE user SET username = '{$username}', fullname='{$fullname}', avatar='{$tenfile}', chucvu='{$chucvu}' WHERE user_id = '{$idSua}' ";
												$resultUpdate = $mysqli->query($queryUpdate);
												if( $resultUpdate ) {
													header("location:index.php?tab=4&msg=Sửa thành công!");
												} else {  
													header("location:index.php?tab=4&msg=Sửa thất bại!");
												}
											}
											else {
												$queryUpdate = "UPDATE user SET username = '{$username}',fullname='{$fullname}', chucvu='{$chucvu}' WHERE user_id = '{$idSua}' ";
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
											<label>Username:</label>
											<input type="text" name="username" class="form-control border-input" placeholder="Nhập tên người dùng" value="<?php echo $temp['username'] ?>" >
										</div>
									</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password:</label>
                                                <input type="password" name="password" readonly="readonly" value="<?php echo $temp['password'] ?>" class="form-control border-input" placeholder="Nhập mật khẩu" >
                                            </div>
                                        </div>
                                    </div>
                                    
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Fullname:</label>
                                                <input type="text" name="fullname" value="<?php echo $temp['fullname'] ?>" class="form-control border-input" placeholder="Nhập họ tên" >
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
												<img src="/files/<?php echo $temp['avatar']?>" alt="" width="200px" height="200px"/> 
                                                <input type="file" name="hinhAnh" class="form-control" placeholder="Chọn ảnh" />
                                            </div>
                                        </div>
                                    </div>
                                     
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chức vụ</label>
												<select class="form-control border-input" name="chucvu" required="">
													<option selected>admin</option>
													<option>mod<option>
												</select>
                                            </div>
                                        </div>
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