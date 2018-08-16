<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	// tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM comment";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$tongSoDong = $arTmp['TSD'];
	// số truyện trên 1 trang
	$row_count = ROW_COUNT;
	// Tổng số trang
	$tongSoTrang = ceil($tongSoDong/$row_count);
	// trang hiện tại
	$current_page = 1;
	if(isset($_GET['page'])) {
		$current_page = $_GET['page'];
	}
	// offset
	$offset = ($current_page - 1) * $row_count;
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh sách comment</h4>
								<?php
									$tab = $_GET['tab'];
									echo"<script>
											document.getElementById($tab).classList.add('active');
									</script>"
								?>
                                <form action="" method="post">
                                	<div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="fullname" class="form-control border-input" placeholder="Tên tin" value="">
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
                                
                                <a href="edit.html" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
								
                            </div>
							<?php
								if(isset($_POST['save'])){
									$checkbox = $_POST['check'];
									for($i=0;$i<count($checkbox);$i++){
										$del_id = $checkbox[$i];
										$queryCB = "DELETE FROM comment WHERE comment_id = '{$del_id}'";
										$resultCB = $mysqli->query($queryCB);
										$msg = "Data deleted successfully !";
									}
								}
								$query = "SELECT * FROM comment";
								$result = $mysqli->query($query);
							?>
							<form method="post" action="" id="frm">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID bình luận</th>
                                    	<th>Tên Tin</th>
                                    	<th>Người bình luận</th>
                                    	<th>Nội dung</th>
                                    	<th>Banned</th>
                                    	<th width="160px"><input type="checkbox" id="checkAl"> Chọn tất cả </th>
                                    </thead>
                                    <tbody>
										<?php
											$queryTin = "";
											if(isset($_POST['search'])){
												$tenTin = $_POST['fullname'];
												$queryTin = "SELECT c.*, n.name AS nname
															FROM comment AS c INNER JOIN news AS n
															ON c.news_id = n.news_id
															WHERE nname LIKE N'%{$tenTin}%'
															LIMIT {$offset},{$row_count}
															";
											}else{
											$queryTin = "SELECT c.*, n.name AS nname
															FROM comment AS c INNER JOIN news AS n
															ON c.news_id = n.news_id 
															LIMIT {$offset},{$row_count}
															";
											}
											$resultTin = $mysqli->query($queryTin);
											while($row = mysqli_fetch_assoc($resultTin)) {
												$id = $row['comment_id'];
												$content = $row['content'];
												$nname = $row['nname'];
												$email = $row['email'];
												$content = $row['content'];
												$status = $row['status'];
										?>
                                        <tr>
                                        	<td><?php echo $id ?></td>
											<td><?php echo $nname ?></td>
											<td><?php echo $email ?></td>
                                        	<td><?php echo $content ?></td>
											<td class="<?php echo $id?>">
												<a href="javascript:void(0)" onclick="return setStatus(<?php echo $status; ?>, '<?php echo $id?>')">
													<?php
													if ($status == 1) {
														$pic = 'active.gif';
													} else {
														$pic = 'deactive.gif';
													}
													?>
													<img src="/templates/admin/assets/img/<?php echo $pic?>" alt="" />
												</a>
											</td>
                                        	<td class="center">
												<input type="checkbox" id="checkItem" name="check[]" value="<?php echo $id ?>">
											</td>
                                        </tr>
                                        <?php 
											} 
										?>                   
                                    </tbody>
 
                                </table>
								<script>
									function setStatus(status, cl){
										$.ajax({
											url: 'ajax/status.php',
											type: 'POST',
											cache: false,
											data: {astatus: status, acl:cl},
											success: function(data){
												$('.' + cl).html(data);
											},
											error: function (){
												alert('Có lỗi xảy ra');
											}
										});
										return false;
									}
								</script>
								<div class="row">
									<div class="col-sm-6">
										<div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ <?php echo $current_page; ?> đến <?php echo $tongSoTrang ?> của <?php echo $tongSoDong ?> tin</div>
									</div>
									<div class="col-sm-6" style="text-align: right;">
										<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
											<ul class="pagination">
												<?php
												 for($i = 1; $i <= $tongSoTrang; $i++) {
													 $active = '';
													 if($i == $current_page) {
														 $active = 'active';
													 }
												?>
												<li class="paginate_button <?php echo $active ?>" ><a href="index.php?tab=3&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
												<?php
												 }
												?>
											</ul>
										</div>
									</div>
								</div>
							<button type="submit" onclick="return confirm('Bạn có muốn xóa?')" class="btn btn-danger" name="save">Xóa</button>
                            </div>
							</form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
		
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
<script>
	$("#checkAl").click(function () {
	$('input:checkbox').not(this).prop('checked', this.checked);
	});
</script>