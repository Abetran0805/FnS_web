<?php
session_start();
require_once('./database.php');
include('./ketnoi.php');

// Where maloaihang


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finding</title>
    <link rel="stylesheet" href="./custom/css/menu.css">
    <link rel="stylesheet" href="./custom/css/timkiem.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

</head>

<body>

    <?php require_once('./header.php') ?>
    <ul id="nav" style="position:absolute; z-index: 2;">
        <!-- <li><a href="./col.php?title=Men's Boots&maloaihang=10">Men Bootss</a></li> -->
        <li><a href="./index.php">Trang chủ </a></li>
        <li>
            <a href="">Khoa
                <i class="nav=arrow-down ti-angle-down"></i>
            </a>
            <ul class="subnav">
                <li><a href="./finding2.php?title=An Toàn Thông Tin &idkhoa=1">An Toàn Thông Tin</a></li>
                <li><a href="./finding2.php?title=Truyền Thông Đa Phương Tiện &idkhoa=2">Truyền Thông Đa Phương Tiện</a></li>
                <li><a href="./finding2.php?title=Khoa Học Máy Tính &idkhoa=3">Khoa Học Máy Tính</a></li>
                <li><a href="./finding2.php?title=Kỹ Thuật Máy Tính &idkhoa=4">Kỹ Thuật Máy Tính</a></li>
                <li><a href="./finding2.php?title=Mạng Máy Tính Và Truyền Thông Dữ Liệu &idkhoa=5">Mạng Máy Tính Và Truyền Thông Dữ Liệu</a></li>
                <li><a href="./finding2.php?title=Kỹ Thuật Phần Mềm &idkhoa=6">Kỹ Thuật Phần Mềm</a></li>
                <li><a href="./finding2.php?title=Hệ Thống Thông Tin &idkhoa=7">Hệ Thống Thông Tin</a></li>
                <li><a href="./finding2.php?title=Công Nghệ Thông Tin &idkhoa=8">Công Nghệ Thông Tin</a></li>
            </ul>
        </li>
        <li>
            <div class="user">
                <?php
                if (isset($_SESSION['taikhoan'])) {
                    echo '<div style="color:#000; display:flex;">
                            <h3> ' . $_SESSION['taikhoan'] . '</h3>
                            <a  href="./logout.php">Logout</a>
                            </div>';
                } else {
                    echo '<a href="./user.php" class="csw-btn-button">Đăng nhập</a>';
                }

                ?>
            </div>
        </li>
    </ul>


    <br><br><br>
    <div class="list_card ">
        <h1 style="text-align: center; font-size:40px; " class="text-animation"> Finding & Result</h1>
        <br>
        <?php
        if (isset($_REQUEST['ok'])) {
            // Gán hàm addslashes để chống sql injection
            $search = addslashes($_GET['search']);
            if (!empty($_SESSION['taikhoan'])) {
                // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
                if (empty($search)) {
                    echo "<h5 style='text-align:center; color:#FF0000'>Yeu cau nhap du lieu vao o trong</h5>";
                } else {

                    $query = "SELECT * FROM detai WHERE tendetai like '%$search%'";

                    require_once('./database.php');
                    include('./ketnoi.php');
                    // Kết nối sql
                    $sql = db_get_list($query);

                    $num = count($sql);
                    // print_r($result);
                    // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                    if ($num > 0 && $search != "") {
                        // Dùng $num để đếm số dòng trả về.
                        echo "<h5  style='padding-left:60px;'> <i style='color:lightblue;' class='fas fa-file'></i> $num Kết quả trả về với từ khóa: <b>$search</b> </h5> ";

                        echo '<table class="table table-dark  container">
                        <tr>
                            <td style="width:45%;">
                                <h4 style="text-align: center; ">Tên đề tài</h4>
                            </td>
                            <td style="width:25%;">
                                <h4 style="text-align: center;">Sinh viên</h4>
                            </td>
                            <td style="width:15%;">
                                <h4 style="text-align: center;"> Học kì  & Năm </h4>
                            </td>
                            <td style="width:20%;">
                                <h4 style="text-align: center;">Giáo viên</h4>
                            </td>
                        </tr>
                    </table>
                            ';

                        //     echo '<br>';
                        // Hàm foreach dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                        foreach ($sql as $card) {
                            //print_r($url);
                            $namhocki = 'SELECT namhoc,hocki FROM namhocki WHERE ms=' . $card['ms'] . '';
                            $nam = db_get_row($namhocki);
                            $thuchien = 'SELECT * FROM thuchien WHERE idsvth="' . $card['idsvth'] . '"';
                            $th = db_get_row($thuchien);


                            echo '<div class="card"  >
                            <table class="table table-hover container  ">
                            <tr>
                            <td  style="width:45%;">
                                <h5 class="name">' . $card['tendetai'] . '</h5>
                                <h5><a href="' . $card['urldetai'] . '">View</a></h5>
                            </td>    
                
                            <td style="width:25%;">
                                <h5   class="tensv">' . $th['tensv'] . '</h5>    
                                <h5  class="mssv">' . $th['mssv'] . '</h5>                                   
                            </td>
                
                            <td style="width:15%;">
                                <h5   class="hocki">' . $nam['hocki'] . '</h5>  
                                <h5   class="namhoc">' . $nam['namhoc'] . '</h5>                              
                            </td>
                
                            <td style="width:20%;">
                                <h5  class="giaovienhuongdan">' . $th['giaovienhuongdan'] . '</h5>                               
                            </td>
                    </tr> 
                
                    </table>
                </div>';
                        }

                        echo '</table>';
                    } else {
                        echo "<h5 style='text-align:center; color:#FF0000'> Khong tim thay ket qua!</h5>";
                    }
                }
            } else {
                // echo "<h3 style='text-align:center; color:#FF0000;'> Bạn chưa đăng nhập <a href=./dangky.php></h3> ";
                echo "<h5 style='text-align:center; color:#FF0000'> Bạn chưa đăng nhập! Hãy đăng ký nếu chưa có tài khoản <a style ='text-align:center;' href='./dangky.php';>Đăng ký</a></h5>";
            }
        } ?>
    </div>
    <?php
    if (empty($_SESSION['taikhoan'])) {
        echo "";
    } else {
        echo '<div class="container">
        <p><a class="btn btn-lg btn-success" href="./suggest.php" role="button">Các đề tài gợi ý tương tự</a></p>
    </div>';
    }
    ?>
    <?php include './footer.php'; ?>

</body>

</html>