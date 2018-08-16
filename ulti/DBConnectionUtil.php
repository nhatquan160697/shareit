<?php
//khởi tạo đối tượng mysqli
$mysqli = new mysqli("localhost", "root", "", "shareit");
//$mysqli = new mysqli("sql213.byethost31.com", "b31_22420589", "quan12345", "b31_22420589_shareit");
//thiết lập font chữ utf8
$mysqli->set_charset("utf8");
//thông báo lỗi nếu kết nối sai
if (mysqli_connect_errno()){
	echo "Lỗi kết nối database: " . mysqli_connect_error();
	exit();
}
?>
