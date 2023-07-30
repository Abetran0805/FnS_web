<?php
require_once('../lib/database.php');
if (isset($_GET['delcos'])) {
    $sql = 'DELETE FROM dogoiy';
    $tthi  = db_execute($sql);
    header("Location: ../lib/index.php");
}
