<?php
require_once('./database.php');
include('./ketnoi.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh Giá</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h1 style="text-align:center;"> <strong>Đánh Giá Hệ Thống</strong></h1>
        <div style="float: right; font-size:25px; " class="btn btn-dark mb-2">
            <a href="./index.php"><strong>Back</strong></a>
        </div>
        <br><br>
        <div>
            <table>
                <?php
                $sql = 'SELECT * FROM user';
                $dg = count(db_get_list($sql));
                $sql1 = 'SELECT * FROM dogoiy';
                $dg1 = count(db_get_list($sql1));
                ?>
                <tr>
                    <td>
                        <h3>Số lượng người dùng tương tác với hệ thống : <?php echo $dg ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Số lượng đề tài đã được tính độ tương tự: <?php echo $dg1 ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Đánh giá hệ thống theo phương thức Given-1 ( người dùng ): 48%</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Đánh giá hệ thống theo phương thức Given-1 ( tài liệu ): 70% </h3>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <?php
        $sql1 = 'SELECT * FROM dogoiy';
        $dg1 = db_get_list($sql1);
        foreach ($dg1 as $log) {
            echo
            '<h5>Logs: de tai ' . $log['id'] . ' có độ tương tự với các đề tài ' . $log['madetaigoiy'] . '</h5>';
        }
        ?>
</body>

</html>