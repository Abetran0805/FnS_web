<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once("./database.php");
include("./ketnoi.php");
$sql = 'SELECT * FROM test WHERE id';
$result = db_get_list($sql);
$num = count($result);

$time = date('H');
//echo $time;
if ($num >= 0 && $time = 9) {
    $result = 'DELETE FROM test';
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'http://127.0.0.1:5000/tinhgoiy'
    ]);
    curl_exec($curl);
    //var_dump($data);
    curl_close($curl);
}
