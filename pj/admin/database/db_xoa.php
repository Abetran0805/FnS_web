<?php
require_once('../lib/database.php');
if (isset($_GET['iddt'])) {
    $id = $_GET['iddt'];
    $sql = 'DELETE FROM detai WHERE iddt = ' . $id;
    $tthi  = db_execute($sql);
    header("Location: ../lib/index.php");
}
