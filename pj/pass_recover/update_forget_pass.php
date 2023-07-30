<?php
if (isset($_POST['matkhau']) && $_POST['reset_link_token'] && $_POST['email']) {
    require_once('../database.php');
    include('../ketnoi.php');
    $emailId = $_POST['email'];
    $token = $_POST['reset_link_token'];
    $password = md5($_POST['matkhau']);
    $query =  "SELECT * FROM `user` WHERE `reset_link_token`='" . $token . "' and `email`='" . $emailId . "'";
    $row = db_get_row($query);
    if ($row) {
        mysqli_query($conn, "UPDATE user set  password='" . $password . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
        echo '<p>Congratulations! Your password has been updated successfully.</p>';
    } else {
        echo "<p>Something goes wrong. Please try again</p>";
    }
}
