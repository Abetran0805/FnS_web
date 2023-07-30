<?php
require_once('./database.php');
$sql = 'SELECT * FROM `khoa` ORDER BY idkhoa DESC ';
$result = db_get_list($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí Khoa</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h1 style="text-align:center;"> <strong>Quản Lý Khoa </strong></h1>
        <div style="float: right; font-size:25px; " class="btn btn-dark mb-2">
            <a href="./index.php"><strong>Back</strong></a>
        </div>
        <br>
        <table class="table table-dark table-striped">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Khoa</th>
                    <th scope="col">Tên Khoa</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $item) {
                    echo '<tr>
                <th scope="row">' . ($i + 1) . '</th>
                    <td>' . $item['idkhoa'] . '</td>
                    <td>' . $item['tenkhoa'] . '</td>  
                
                </tr> ';
                    $i++;
                }
                ?>
        </table>

    </div>
</body>

</html>