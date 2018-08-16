<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh sách người dùng</h4>
								<?php
									$tab = $_GET['tab'];
									echo"<script>
											document.getElementById($tab).classList.add('active');
									</script>"
								?>
                                <form action="" method="post">
                                	<div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input type="text" name="id" class="form-control border-input" value=""  placeholder="ID">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="fullname" class="form-control border-input" placeholder="Họ tên" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        	<div class="form-group">
		                                        <input type="submit" name="search" value="Tìm kiếm" class="is" />
		                                        <input type="submit" name="reset" value="Hủy tìm kiếm" class="is" />
	                                        </div>
                                        </div>
                                    </div>
                                    
                                </form>
                                
                                <a href="add.php?tab=3" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID người dùng</th>
                                    	<th>Username</th>
                                    	<th>Fullname</th>
										<th>Chức vụ</th>
										<th>Avatar</th>
                                    	<th>Chức năng</th>
                                    </thead>
                                    <tbody>
										<?php
											$queryDM = "";
											if(isset($_POST['search'])) {
												$tenID = $_POST['id'];
												$tenNguoiDung = $_POST['fullname'];
												if(!empty($tenNguoiDung)) {
													$queryDM = "SELECT * FROM user WHERE fullname LIKE N'%{$tenNguoiDung}%'";
												}
												if(!empty($tenID)) {
													$queryDM = "SELECT * FROM user WHERE user_id LIKE N'%{$tenID}%'";
												}
											} else if(isset($_POST['reset'])) {
												$queryDM = "SELECT * FROM user";
											} else {
												$queryDM = "SELECT * FROM user";
											}
											$resultDM = $mysqli->query($queryDM);
											while($row = mysqli_fetch_assoc($resultDM)) {
												$id = $row['user_id'];
												$username = $row['username'];
												$fullname = $row['fullname'];
												$chucvu = $row['chucvu'];
												$avatar = $row['avatar'];
										?>
                                        <tr>
                                        	<td><?php echo $id ?></td>
                                        	<td><a href="edit.html"><?php echo $username ?></a></td>
                                        	<td><?php echo $fullname ?></td>
                                        	<td><?php echo $chucvu ?></td>
											<td class="center">
												<img src="/files/<?php echo $avatar ?>" alt="" height="80px" width="100px"/>
											</td>
                                        	<td>
												<?php if($chucvu != 'admin' || $_SESSION['userinfo']['chucvu'] == 'admin' ) { ?>
                                        		<a href="update.php?tab=3&idSua=<?php echo $id ?>"><img src="/templates/admin/assets/img/edit.gif" alt=""> Sửa</a> &nbsp;||&nbsp;
												<?php } ?>
												<?php if($chucvu != 'admin') { ?>
												<a href="delete.php?tab=3&delID=<?php echo $id ?>" onclick="return confirm('Bạn có muốn xóa?')"><img src="/templates/admin/assets/img/del.gif" alt=""> Xóa</a>
												<?php } ?>
											</td>
                                        </tr>
										<?php 
											} 
										?>
                                    </tbody>
 
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
		
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>