<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Thêm người dùng</h4>
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
                                                <label>Username:</label>
                                                <input type="text" name="username" class="form-control border-input" placeholder="Nhập tên người dùng">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password:</label>
                                                <input type="password" name="password" class="form-control border-input" placeholder="Nhập mật khẩu" >
                                            </div>
                                        </div>
                                    </div>
                                    
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Fullname:</label>
                                                <input type="text" name="fullname" class="form-control border-input" placeholder="Nhập họ tên" >
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
                                                <label>Danh mục truyện</label>
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
									<?php
										if(isset($_POST['submit'])) {
											$username = $_POST['username'];
											$password = $_POST['password'];
											$fullname = $_POST['fullname'];
											$hinhAnh = $_FILES['hinhAnh'];
											$chucvu = $_POST['chucvu'];
											$tenHinhAnh = $hinhAnh['name'];
											if($hinhAnh != '') {
												$nametmp = explode('.',$tenHinhAnh);
												$duoifile = end($nametmp);
												$tenfile = 'HinhAnh-'.time().'.'.$duoifile;
												$tmp_name = $hinhAnh['tmp_name'];
												$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenfile;
												move_uploaded_file($tmp_name,$path_upload);
											}
											$queryCheck = "SELECT username FROM user WHERE username = '{$username}'";
											$resultCheck = $mysqli->query($queryCheck);
											$arCheck = mysqli_fetch_assoc($resultCheck);
											if(empty($username)) {
												echo "<h3 style='color:red'>Vui lòng nhập username!</h3>";
											} else if (empty($password)) {
												echo "<h3 style='color:red'>Vui lòng nhập password!</h3>";
											} else if (empty($fullname)) {
												echo "<h3 style='color:red'>Vui lòng nhập fullname!</h3>";
											} else if (count($arCheck) > 0) {
												echo "<h3 style='color:red'>Đã có username này rồi. Vui lòng chọn username khác</h3>";
											} else {
												$queryAdd = "INSERT INTO user(username,password,fullname,avatar,chucvu) VALUES ('{$username}','{$password}','{$fullname}','{$tenfile}','{$chucvu}')";
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>