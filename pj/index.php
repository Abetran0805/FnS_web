<?php
session_start();
require_once('./database.php');
include('./ketnoi.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finding & Suggest </title>
    <link rel="stylesheet" href="./custom/css/menu.css">
    <link rel="stylesheet" href="./custom/css/timkiem.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
</head>

<body>
    <main>
        <?php require_once('./header.php') ?>
        <ul id="nav">
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
                <div style="font-size: larger;" class="user">
                    <?php
                    if (isset($_SESSION['taikhoan'])) {
                        echo '<div style="color:#000; display:flex;">
                            <h4> ' . $_SESSION['taikhoan'] . '</h4>
                           <a  href="./logout.php">Logout </a> 
                            </div>';
                    } else {
                        echo '<a href="./user.php" class="csw-btn-button">Đăng nhập</a>';
                    }

                    ?>
                </div>
            </li>
            <li>
                <div style="font-size: larger;" class="admin">
                    <a href="./admin/lib/dnadmin.php" rel="stylesheet">Admin</a>

                </div>
            </li>
        </ul>
        <h1 style="text-align: center;" class="text-animation"> Finding & Suggest</h1>

        <h1 style="text-align: center;" class="text-animation"> Luận Văn Khoa Công Nghệ Thông Tin Và Truyền Thông</h1>


        <div style=" display: flex; justify-content: center;" class="cennter">
            <img style="width:500px;" src="./custom/pic/book.gif" alt="">
        </div>

        <div class="container">
            <form action="search.php" class="search" method="GET">
                <input type="text" name="search" class="searchTerm" placeholder="Bạn muốn tìm đề tài gì?">
                <button type="submit" name="ok" value="search" class="searchButton">
                    Submit
                </button>
            </form>
        </div>

    </main>
    <?php include './footer.php'; ?>
</body>

</html>