<?php
require_once('../lib/database.php');
include('../lib/ketnoi.php');

if (isset($_POST['update'])) {
    $id          = $_POST['iddt'];
    $tendetai     = $_POST['tendetai'];
    $idkhoa       = $_POST['idkhoa'];
    $nam        = $_POST['ms'];
    $url        = $_POST['urldetai'];
    $sv            = $_POST['idsvth'];
    $mssv            = $_POST['mssv'];
    $tensv             = $_POST['tensv'];
    $gv              = $_POST['giaovienhuongdan'];
    $sql1 = "UPDATE detai SET detai.tendetai= '$tendetai' , detai.idkhoa= '$idkhoa', detai.ms= '$nam', detai.urldetai=  '$url'  WHERE iddt =   $id";
    $ttt = db_execute($sql1);

    //Nếu kết quả kết nối thành công, trở về trang view.
    if ($ttt  = true) {

        header("Location: ../lib/index.php");
    }
}
