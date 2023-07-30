<?php
require_once('./database.php');
include('./ketnoi.php');
if (isset($_GET['iddt'])) {
    $id = $_GET['iddt'];
    $sql = 'SELECT * FROM detai WHERE iddt=' . $id;
    $ket_qua = db_get_row($sql);
    // print_r($ket_qua);
    while ($row = $ket_qua) {
        $tendetai       = $row['tendetai'];
        $idkhoa        = $row['idkhoa'];
        $nam            = $row['ms'];
        $sv         = $row['idsvth'];
        $url        = $row['urldetai'];


?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update</title>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
            <!-- MDB -->
        </head>

        <body>
            <div>
                <h1 style="text-align: center;">Update</h1>
                <div style="float: right; font-size:25px; " class="btn btn-dark mb-2">
                    <a href="./index.php"><strong>Back</strong></a>
                </div>
            </div>
            <br>
            <div>
                <form action="../database/db_update.php" method="POST">
                    <table class="container">
                        <tr>
                            <th>ID:</th>
                            <td><input type="hidden" name="iddt" value="<?php echo $id ?>"><?php echo $id ?></td>
                        </tr>
                        <tr>
                            <th>Tên đề tài:</th>
                            <td>
                                <textarea cols="40" rows="3" type="text" class="form-control" name="tendetai"><?php echo $tendetai ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>Khoa:</th>
                            <td>
                                <select name="idkhoa" id="mk" class="form-select" aria-label="Default select example">
                                    <option value="<?php echo $idkhoa ?>">--- Select ---</option>
                                    <?php
                                    $sql = 'SELECT * FROM khoa ';
                                    $rs = db_get_list($sql);
                                    foreach ($rs as $item) {
                                    ?>
                                        <option value="<?php echo $item['idkhoa']; ?>">
                                            <?php echo $item['tenkhoa']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Năm & Học kì :</th>
                            <td>
                                <select name="ms" id="mk" class="form-select" aria-label="Default select example">
                                    <option value="<?php echo $nam ?>">--- Select ---</option>
                                    <?php
                                    $sql = 'SELECT * FROM namhocki ';
                                    $rs = db_get_list($sql);
                                    foreach ($rs as $item1) {
                                    ?>s
                                    <option value="<?php echo $item1['ms']; ?>">
                                        <?php echo  $item1['namhoc'] . " - " . $item1['hocki'];
                                        ?>
                                    </option>
                                <?php
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>MSSV :</th>
                            <td>
                                <?php
                                $sql2 = 'SELECT * FROM thuchien WHERE idsvth=' . $sv;
                                $th = db_get_row($sql2);
                                ?>
                                <input type="text" class="form-control" name="mssv" value="<?php echo $th['mssv'] ?>">

                            </td>
                        </tr>
                        <tr>
                            <th>Tên sinh viên :</th>
                            <td>

                                <input type="text" class="form-control" name="tensv" value="<?php echo $th['tensv'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Giáo viên hướng dẫn :</th>
                            <td>
                                <input type="text" class="form-control" name="giaovienhuongdan" value="<?php echo $th['giaovienhuongdan'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Url đề tài :</th>
                            <td>
                                <textarea cols="50" rows="3" type="text" class="form-control" name="urldetai"><?php echo $url ?></textarea>
                            </td>
                        </tr>

                    </table>
                    <br>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-dark" name="update" id="update" value="update"> Update </button>
                    </div>
                </form>

        <?php
        break;
    }
}

        ?>
            </div>
        </body>

        </html>