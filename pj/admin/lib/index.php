<?php
require_once('./database.php');
$sql = 'SELECT * FROM detai ORDER BY iddt DESC ';
$result = db_get_list($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->

</head>

<body>
    <div class="container mt-5">
        <h1>Admin</h1>
        <div>
            <a href="./newdetai.php" class="btn btn-dark mb-2">+ Thêm Mới</a>
            <a href="./qlkhoa.php" class="btn btn-dark mb-2">Quản Lý Khoa</a>
            <a href="./qlsv.php" class="btn btn-dark mb-2">Quản Lý Sinh Viên</a>
            <a href="./danhgia.php" class="btn btn-dark mb-2">Đánh Giá Hệ Thống</a>
            <a style="float:right;" href="../../index.php" class="btn btn-dark mb-2">Trang chủ</a>
            <button style="float:right; background-color:green;" type="delcos" value="delcos" class="btn btn-dark mb-2">Xóa data gợi ý </button>
        </div>
        <table class="table table-dark ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên đề tài</th>
                    <th scope="col">Tên khoa</th>
                    <th scope="col">Năm học</th>
                    <th scope="col">Học kì</th>
                    <th scope="col">Mã số sinh viên </th>
                    <th scope="col">Tên sinh viên</th>
                    <th scope="col">Giáo viên hướng dẫn</th>
                    <th scope="col">Url đề tài</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $item) {
                    $sql_1 = 'SELECT * FROM thuchien WHERE idsvth =' . $item['idsvth'];
                    $sql1 = db_get_row($sql_1);
                    $sql_2 =  'SELECT * FROM namhocki WHERE ms =' . $item['ms'];
                    $sql2 = db_get_row($sql_2);
                    $sql_3 =  'SELECT * FROM khoa WHERE idkhoa =' . $item['idkhoa'];
                    $sql3 = db_get_row($sql_3);
                    echo '<tr>
                <th scope="row">' . ($i + 1) . '</th>
                    <td>' . $item['tendetai'] . '</td>
                    <td>' . $sql3['tenkhoa'] . '</td>  
                    <td>' . $sql2['namhoc'] . '</td>
                    <td>' . $sql2['hocki'] . '</td>
                    <td>' . $sql1['mssv'] . '</td>
                    <td>' . $sql1['tensv'] . '</td>
                    <td>' . $sql1['giaovienhuongdan'] . '</td>
                    <td>' . $item['urldetai'] . '</td>
                    <td><a href="./update.php?iddt=' . $item['iddt'] . '" class="btn btn-danger">Sửa</a></td>
                    <td><a href="../database/db_xoa.php?iddt=' . $item['iddt'] . '" class="btn btn-danger">Xóa</a></td>
                    
                </tr> ';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


</html>