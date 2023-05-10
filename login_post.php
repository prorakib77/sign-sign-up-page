<?php
session_start();
$email = $_POST['login_email'];
$password = md5($_POST['login_password']);
$flag = false;

$db_connect = mysqli_connect('localhost', 'root', '', 'class_fifteen');
$count_query = "SELECT COUNT(*) AS 'result' FROM users WHERE email='$email' AND password='$password'";

$final_slesction = mysqli_query($db_connect,$count_query);
$after_assoc = mysqli_fetch_assoc($final_slesction)['result'];


if ($email) {
    $flag = true;
    $_SESSION['old_email'] = "$email";
}
else{
    $_SESSION['login_email'] = "Email is missing";
}
if ($password) {
    $flag = true;
}
else{
    $_SESSION['login_password'] = "Password is missing";
}
if ($flag!=1) {
    header('location: login.php');
}
else{
    if ($after_assoc==1) {
        $flag = true;
        header('location: dashbord.php');
    }
    else{
        $_SESSION['login_success_error'] = "This email and password is not exist please sign-up a new account.";
    }
}




?>
