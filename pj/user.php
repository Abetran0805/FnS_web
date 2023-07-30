<?php
//Khai báo sử dụng session
session_start();
require_once('./database.php');
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
    //Kết nối tới database
    include('./ketnoi.php');

    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txttaikhoan']);
    $password = addslashes($_POST['txtmatkhau']);

    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo "<div style='text-align: center;'>
        <img src='./custom/pic/warn.jpg' alt=''>
        <h2>Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a></h2></div>";
        exit;
    }

    // mã hóa pasword
    $password = md5($password);

    //Kiểm tra tên đăng nhập có tồn tại không
    $user_query = "SELECT * FROM user WHERE taikhoan='$username'";
    $query = count(db_get_row($user_query));
    if ($query == 0) {
        echo "<div style='text-align: center;'>
        <img src='./custom/pic/warn.jpg' alt=''>
        <h2>Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a></h2></div>";
        exit;
    }

    //Lấy mật khẩu trong database ra
    $row = db_get_row($user_query);
    $id = $row['iduser'];
    // echo $row['matkhau'];
    // echo $password;
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['matkhau']) {
        echo "<div style='text-align: center;'>
        <img src='./custom/pic/warn.jpg' alt=''>
        <h2 >Mật khẩu không đúng. Vui lòng nhập lại.  <a href='javascript: history.go(-1)'>Back</a></h2></div>";
        exit;
    }

    //Lưu tên đăng nhập
    $_SESSION['iduser'] = $id;
    $_SESSION['taikhoan'] = $username;
    header("Location: ./index.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -50px;
            }

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right" style="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(30px);">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">Login </h2>
                            <form action='user.php?do=login' method='POST'>

                                <!-- User input -->
                                <div class="form-outline mb-4">

                                    <input type="text" name="txttaikhoan" id="form3Example3" class="form-control" />
                                    <label class="form-label" for="form3Example3">Username</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">

                                    <input type="text" name="txtmatkhau" id="form3Example4" class="form-control" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                                    <label class="form-check-label" for="form2Example33">
                                        Remember me!
                                    </label>
                                </div>

                                <!-- Submit button -->

                                <button type="submit" name="dangnhap" value="Login" class="btn btn-primary btn-block mb-2">
                                    Login
                                </button>

                                <a href="./pass_recover/forget_pass.php">Forgot Password</a>
                                <div class="text-center">
                                    <p>Not a member? <a href="./dangky.php">Register</a></p>
                                </div>
                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>or sign up with:</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="./custom/pic/pic_user1.jpg" class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
</body>

</html>