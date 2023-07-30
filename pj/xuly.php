<?php
require_once('./database.php');
// Nếu không phải là sự kiện đăng ký thì không xử lý
if (!isset($_POST['txttaikhoan'])) {
    die('');
}

//Nhúng file kết nối với database
include('./ketnoi.php');

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Lấy dữ liệu từ file dangky.php
$hoten   = addslashes($_POST['txthoten']);
$username   = addslashes($_POST['txttaikhoan']);
$password  = addslashes($_POST['txtmatkhau']);
$email      = addslashes($_POST['txtemail']);
$mssv        = addslashes($_POST['txtmssv']);



//Kiểm tra người dùng đã nhập liệu đầy đủ chưa
if (!$hoten || !$username || !$password || !$email || !$mssv) {
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Mã khóa mật khẩu
$password = md5($password);
$checkuser = "SELECT taikhoan FROM user WHERE taikhoan='$username'";
//Kiểm tra tên đăng nhập này đã có người dùng chưa
if (count(db_get_row($checkuser)) > 0) {
    echo "
    <div style='text-align: center;'>
        <img src='./custom/pic/warn.jpg' alt=''>
    <h2>Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a></h2></div>";
    exit;
}


//Kiểm tra email đã có người dùng chưa
if (count(db_get_row("SELECT email FROM user WHERE email='$email'")) > 0) {
    echo "
    <div style='text-align: center;'>
        <img src='./custom/pic/warn.jpg' alt=''>
    <h2 style='color:yellow;'>Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a></h2></div>";
    exit;
}

//Lưu thông tin thành viên vào bảng
$adduser = 'INSERT INTO user (iduser,taikhoan,matkhau,hoten,email,mssv)
            VALUE ("","' . $username . '","' . $password . '","' . $hoten . '","' . $email . '","' . $mssv . '")';
//Thông báo quá trình lưu
if (db_execute($adduser))
    echo "<div style='text-align: center;'>
    <img src='./custom/pic/stick.png' alt=''>
    <h2 style= 'color:blue;'> Quá trình đăng ký thành công.  <a href='./index.php'>Về trang chủ</a></h2></div>";
else
    echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='dangky.php'>Thử lại</a>";
