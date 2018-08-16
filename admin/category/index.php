<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
$tab = $_GET['tab'];
echo"<script>
		document.getElementById($tab).classList.add('active');
</script>"?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh mục tin tức</h4>
                                <?php
									if(isset($_GET['msg'])){
										?>
										<p class="category success">
										<?php echo $_GET['msg']; ?>
										</p>
										<?php
									}
								?>
                                <form action="" method="post">
                                	<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control border-input" placeholder="Tên danh mục" value="">
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
                                
                                <a href="add.php?tab=1" class="addtop"><img src="/template/admin/assets/img/add.png" alt="" /> Thêm</a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Tên danh mục</th>
                                    	<th>Chức năng</th>
                                    </thead>
                                    <tbody>
										<?php
											$query = "SELECT * FROM cat_list WHERE parent_id = 0 ORDER BY cat_id DESC";
											if(isset($_POST['search'])){
												if(isset($_POST['name'])){
													$search = $_POST['name'];
													$query = "SELECT * FROM cat_list WHERE name LIKE '%".$search."%' OR cat_id LIKE '%".$search."%'";
												}
											}
											$result = $mysqli->query($query);
											// LẤY RA thằng cha
											while($row = mysqli_fetch_assoc($result)){
												$id = $row['cat_id'];
												$name = $row['name'];
												$parent_id = $row['parent_id'];
										?>
                                        <tr>
                                        	<td><?php echo $id; ?></td>
											<td>
												<?php 
													echo $name;
													//Tra lai tat ca cac Menu cha
												?>
												<ul>
												<?php
													$queryCatCon ="SELECT * FROM cat_list WHERE parent_id = {$id}"; 
													$resultCatCon = $mysqli->query($queryCatCon);
													// Loop thằng con
													while($rowCatCon = mysqli_fetch_assoc($resultCatCon)){
												?>
													<li style="list-style-type: circle;"><a href=""><?php echo $rowCatCon['name'] ?></a>
													<a href="update.php?tab=1&id=<?php echo $rowCatCon['cat_id'] ?>&name=<?php echo $rowCatCon['name']?>">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;||&nbsp;
													<a href="delete.php?tab=1&id=<?php echo $rowCatCon['cat_id'] ?>" onclick="return confirm('Bạn có muốn xóa?')"><i class="fa fa-trash"></i></a>
													</li>
												<?php	
													}
												?>
												</ul>
												
											</td>
                                        	<td>
                                        		<a href="update.php?tab=1&id=<?php echo $id ?>&name=<?php echo $name ?>"><img src="/templates/admin/assets/img/edit.gif" alt=""> Sửa</a> &nbsp;||&nbsp;
                                        		<a href="delete.php?tab=1&id=<?php echo $id ?>" onclick="return confirm('Bạn có muốn xóa?')"><img src="/templates/admin/assets/img/del.gif" alt=""> Xóa</a>
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