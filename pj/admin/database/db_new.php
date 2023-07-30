<?php
require_once('../lib/database.php');
if (isset($_POST['tendetai'])) {
    $ten = $_POST['tendetai'];
    $idkhoa = $_POST['idkhoa'];
    $mssv = $_POST['mssv'];
    $tensv = $_POST['tensv'];
    $giaovien = $_POST['giaovienhuongdan'];
    $namhocki = $_POST['ms'];
    $url = $_POST['urldetai'];

    $sql_sv = 'INSERT INTO thuchien (idsvth,mssv,tensv,giaovienhuongdan)
    VALUES ("","' . $mssv . '","' . $tensv . '","' . $giaovien . '")';
    $thucthi1 = db_execute($sql_sv);

    $id = mysqli_insert_id($conn);
    $sql = 'INSERT INTO detai (iddt, tendetai,idkhoa,ms,idsvth, urldetai)
    VALUES ("", "' . $ten . '","' . $idkhoa . '" ,"' . $namhocki . '","' . $id . '","' . $url . '");';
    $thucthi = db_execute($sql);
    //echo $sqlsv;



    if ($thucthi && $thucthi1) {

        header("Location: ../lib/index.php");
    }
}
