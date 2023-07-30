<?php
require_once('./database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-3">
        <h1 style="text-align: center;">Thêm Mới</h1>
        <br>
        <br>
        <form action="../database/db_new.php" method="POST">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Tên đề tài</th>
                        <th scope="col">Tên khoa</th>
                        <th scope="col">Năm học</th>
                        <th scope="col">Mã số sinh viên </th>
                        <th scope="col">Tên sinh viên</th>
                        <th scope="col">Giáo viên hướng dẫn</th>
                        <th scope="col">Url đề tài</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <textarea cols="40" rows="3" type="text" class="form-control" name="tendetai"></textarea>
                        </td>

                        <td>
                            <select name="idkhoa" id="mk" class="form-select" aria-label="Default select example">
                                <?php
                                $sql = 'SELECT * FROM khoa';
                                $rs = db_get_list($sql);
                                foreach ($rs as $item) {
                                    echo '<option value="' . $item['idkhoa'] . '">' . $item['tenkhoa'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <select name="ms" id="nh" class="form-select" aria-label="Default select example">
                                <?php
                                $sql1 = 'SELECT * FROM namhocki';
                                $nam = db_get_list($sql1);
                                foreach ($nam as $item1) {
                                    echo '<option value="' . $item1['ms'] . '">' . $item1['namhoc'] . ' - ' . $item1['hocki'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="text" class="form-control" name="mssv">
                        </td>

                        <td>
                            <input type="text" class="form-control" name="tensv">
                        </td>

                        <td>
                            <input type="text" class="form-control" name="giaovienhuongdan">
                        </td>

                        <td>
                            <textarea cols="50" rows="3" type="text" class="form-control" name="urldetai"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="float:right;">
                <button type="submit" class="btn btn-dark">Submit</button>
            </div>
        </form>
        <div style="float: left; " class="btn btn-dark mb-2">
            <a href="./index.php"><strong>Back</strong></a>
        </div>
    </div>

</body>

</html>