<?php
require_once("./database.php");
include("./ketnoi.php");
// Where maloaihang
$sql = 'SELECT * FROM dogoiy WHERE id <= 61';
$result = db_get_list($sql);
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các đề tài gợi ý</title>
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
    <ul id="nav" style="position:absolute; z-index:2;">
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
    <div class="list_card " style="padding-left: 60px;">
        <h1 style="text-align: center; font-size:40px;" class="text-animation"> Suggest & Result</h1>
        <br>
        <!-- code -->
        <?php
        $num = count($result);
        echo " <h5 style='padding-left:60px;'> <i style='color:lightblue;' class=' far fa-bell'></i> Có $num đề tài gợi ý tương tự:</h5> ";
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
                    </table>';
        foreach ($result as $card) {
            //print_r($url);
            $query = 'SELECT * FROM detai WHERE iddt=' . $card['madetaigoiy'] . '';
            $sql1 = db_get_row($query);
            $query1 = 'SELECT * FROM thuchien WHERE idsvth=' . $sql1['idsvth'];
            $sql2 = db_get_row(($query1));
            $query2 = 'SELECT * FROM namhocki WHERE ms=' . $sql1['ms'];
            $sql3 = db_get_row($query2);
            echo '<div class="card ">
                <table class="table table-hover container">
                <tr>
                <td  style="width:45%;">
                        <h5 class="name">' . $sql1['tendetai'] . '</h5>
                        <h5><a href="' . $sql1['urldetai'] . '">View</a></h5>
                    </td>  
                    <td style="width:25%;">
                    <h5   class="tensv">' . $sql2['tensv'] . '</h5>    
                    <h5  class="mssv">' . $sql2['mssv'] . '</h5>                                   
                </td>
    
                <td style="width:15%;">
                    <h5   class="hocki">' . $sql3['hocki'] . '</h5>  
                    <h5   class="namhoc">' . $sql3['namhoc'] . '</h5>                              
                </td>
    
                <td style="width:20%;">
                    <h5  class="giaovienhuongdan">' . $sql2['giaovienhuongdan'] . '</h5>                               
                </td>
                </tr>          
                </table>
                </div>';
        }

        ?>

        <footer style="padding-top: 300px;" class="text-center text-lg-start bg-white text-muted">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="https://www.facebook.com/profile.php?id=100027037933096" class="me-4 link-secondary">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/abe_tran/" class="me-4 link-secondary">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://github.com/Abetran0805" class="me-4 link-secondary">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3 text-secondary"></i>Finding & Suggest
                            </h6>
                            <p>
                                Trang Web được tạo ra để giúp các bạn sinh viên tìm kiếm và tham khảo các đề tài luận văn dễ dàng hơn. Ngoài ra còn gợi ý cho sinh viên được những đề tài luận văn tương tự.
                                <br>
                                English : The Web site was created to help students find and refer to dissertation topics more easily. In addition, students are also suggested to have similar thesis topics.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Products
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Searching</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Suggest</a>
                            </p>
                            <p>
                                <img style="height:200px;" src="./custom/pic/3.png" alt="">
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Useful links
                            </h6>
                            <p>
                                <a href="https://www.facebook.com/profile.php?id=100027037933096" class="text-reset">Facebook</a>
                            </p>
                            <p>
                                <a href="https://www.instagram.com/abe_tran/" class="text-reset">Instagram</a>
                            </p>
                            <p>
                                <a href="https://github.com/Abetran0805" class="text-reset">Github</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                            <p><i class="fas fa-home me-3 text-secondary"></i> Đại Học Cần Thơ</p>
                            <p>
                                <i class="fas fa-envelope me-3 text-secondary"></i>
                                tinb1812312@student.ctu.edu.vn
                            </p>
                            <p><i class="fas fa-phone me-3 text-secondary"></i> 0913306193</p>

                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
                © 2021 CTU:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Đại Học Cần Thơ</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
</body>

</html>