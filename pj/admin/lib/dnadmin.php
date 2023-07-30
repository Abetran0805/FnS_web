<?php
session_start();
require_once("./database.php");
header('Content-Type: text/html; charset=UTF-8');
if (isset($_POST['admin'])) {
    //Kết nối tới database
    include("./ketnoi.php");

    //Lấy dữ liệu nhập vào
    $userad = addslashes($_POST['txtuserad']);
    $passad = addslashes($_POST['txtpassad']);

    if (!$userad || !$passad) {
        echo "<div style='text-align: center;'>
        <img src='../../custom/pic/warn.jpg' alt=''>
        <h2>Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a></h2></div>";
        exit;
    }
    // mã hóa pasword
    // $passad = md5($passad);

    //Kiểm tra tên đăng nhập có tồn tại không
    $user_query = "SELECT * FROM admin WHERE userad='$userad'";
    $query = count(db_get_row($user_query));
    if ($query == 0) {
        echo "<div style='text-align: center;'>
        <img src='../../custom/pic/warn.jpg' alt=''>
        <h2>Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a></h2></div>";
        exit;
    }
    //Lấy mật khẩu trong database ra
    $row = db_get_row($user_query);
    $idad = $row['idad'];
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($passad != $row['passad']) {
        echo "<div style='text-align: center;'>
        <img src='../../custom/pic/warn.jpg' alt=''>
        <h2 >Mật khẩu không đúng. Vui lòng nhập lại.  <a href='javascript: history.go(-1)'>Back</a></h2></div>";
        exit;
    }
    $_SESSION['idad'] = $idad;
    $_SESSION['userad'] = $userad;
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" /><!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login Admin</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                <form action='dnadmin.php?do=login' method='POST'>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" name="txtuserad" class="form-control form-control-lg" />
                                        <label class="form-label">User-Admin</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="txtpassad" class="form-control form-control-lg" />
                                        <label class="form-label">Password</label>
                                    </div>

                                    <button type="submit" name="admin" value="admin" class="btn btn-outline-light btn-lg px-5">
                                        Login
                                    </button>
                                </form>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>