<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if (isset($_POST['pass_reset_token']) && $_POST['email']) {
    require_once('../database.php');
    include('../ketnoi.php');

    $emailId = $_POST['email'];

    $result = "SELECT * FROM user WHERE email='" . $emailId . "'";

    $row = db_get_list($result);

    if ($row) {

        $token = md5($emailId) . rand(10, 9999);

        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );

        $expDate = date("Y-m-d H:i:s", $expFormat);
        $update = "UPDATE user set  matkhau='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'";

        $link = "<a href='http://localhost/LuanVan/pass_recover/reset_pass.php?key=" . $emailId . "&token=" . $token . "'>Click To Reset password</a>";

        require_once('phpmail/PHPMailerAutoload.php');


        $mail = new PHPMailer();

        $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;

        // GMAIL username
        $mail->Username = 'user@example.com';
        // GMAIL password
        $mail->Password = 'secret';
        $mail->SMTPSecure = 'none';
        // sets GMAIL as the SMTP server
        $mail->Host = 'smtp.gmail.com';
        // set the SMTP port for the GMAIL server
        $mail->Port = 465;
        $mail->From = 'your_gmail_id@gmail.com';
        $mail->FromName = 'your_name';
        $mail->AddAddress('reciever_email_id', 'reciever_name');
        $mail->Subject  =  'Reset Password';
        $mail->IsHTML(true);
        $mail->Body    = 'Click On This Link to Reset Password ' . $link . '';
        if ($mail->Send()) {
            echo "Check Your Email and Click on the link sent to your email";
        } else {
            echo "Mail Error - >" . $mail->ErrorInfo;
        }
    } else {
        echo "Invalid Email Address. Go back";
    }
}
