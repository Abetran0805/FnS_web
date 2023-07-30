<?php session_start();

if (isset($_SESSION['taikhoan'])) {
    session_destroy();
    header("Location: http://localhost/LuanVan");
}
