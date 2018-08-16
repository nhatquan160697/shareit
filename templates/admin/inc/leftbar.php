<div class="sidebar" data-background-color="white" data-active-color="danger">
    	<?php
			$queryDM = "SELECT * FROM user";
			$resultDM = $mysqli->query($queryDM);
			$row = mysqli_fetch_assoc($resultDM)
		?>
		<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://vinaenter.edu.vn" class="simple-text">AdminCP</a>
            </div>
			
            <ul class="nav">
				<li id="0">
                    <a href="/admin/index.php?tab=0" >
                        <i class="ti-home" ></i>
                        <p>TRANG CHỦ ADMIN</p>
                    </a>
                </li>
				<?php 
				if($row['chucvu'] != 'admin' || $_SESSION['userinfo']['chucvu'] == 'admin' ) {
				?>
            	<li id="1">
                    <a href="/admin/category/index.php?tab=1" >
                        <i class="ti-map" ></i>
                        <p>QUẢN LÝ DANH MỤC</p>
                    </a>
                </li>
				<?php 
				}
				?>
            	<li id="2" >
                    <a href="/admin/news/index.php?tab=2" >
                        <i class="ti-view-list-alt"></i>
                        <p>QUẢN LÝ TIN TỨC</p>
                    </a>
                </li>
				<?php 
				if($row['chucvu'] != 'admin' || $_SESSION['userinfo']['chucvu'] == 'admin' ) {
				?>
                <li id="3">
                    <a href="/admin/user/index.php?tab=3" >
                        <i class="ti-user"></i>
                        <p>QUẢN LÝ NGƯỜI DÙNG</p>
                    </a>
                </li>
				<?php 
				}
				?>
                <li id="4">
                    <a href="/admin/comment/index.php?tab=4" >
                        <i class="ti-comment-alt"></i>
                        <p>QUẢN LÝ BÌNH LUẬN</p>
                    </a>
                </li>
				<li id="5">
                    <a href="/admin/slide/index.php?tab=5" >
                        <i class="ti-layout-slider"></i>
                        <p>QUẢN LÝ SLIDE</p>
                    </a>
                </li>
				<li id="6">
                    <a href="/admin/contact/index.php?tab=6" >
                        <i class="ti-layout-slider"></i>
                        <p>QUẢN LÝ LIÊN HỆ</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>