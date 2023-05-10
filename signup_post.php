<?php 
session_start();
$name = $_POST['name_error'];
$email = $_POST['email_error'];
$password = $_POST['password_error'];
$confirm_password = $_POST['confirm_password_error'];
$flag = false;
$preg_maa = preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password);


if ($name) {
    $flag = true;
    $_SESSION['old_name'] = "$name";
}
else{
    $_SESSION['name_error'] = "Name is missing";
}
if ($email) {
    $flag = true;
        $_SESSION['old_email'] = "$email";
}
else{
    $_SESSION['email_error'] = "Email is missing";
}
if ($password) {
    $flag = true;
    $_SESSION['old_password'] = "$password";
}
else{
    $_SESSION['password_error'] = "Password is missing";
}
// if (strlen($password < 8)) {
//     echo "Yoyr pas $password";
// }
// else{
//     $_SESSION['password_len_error'] = "Password must be minimum 8 characters length*";
// }
if ($confirm_password) {
    $flag = true;
}
else{
    $_SESSION['confirm_password_error'] = "Confirm Password is missing";
}
if ($password != $confirm_password) {
    $flag = true;
    $_SESSION['confirm_password_match_error'] = "Password and Confirm Password is Not Matched";
}
else{
    if ($preg_maa !=1) {
        $_SESSION['password_pregma_matching']= "Password must be minimum 8 characters length*";
    }
}

if ($flag!=1) {
    header('location: signup.php');
}
else{
    $encrepted_pass = md5($password);
    $db_connect = mysqli_connect('localhost', 'root', '', 'class_fifteen');
    $query_insertt = "INSERT INTO users(name,email,password) VALUES('$name','$email','$encrepted_pass')";
    mysqli_query($db_connect, $query_insertt);
    $_SESSION['login_success']= "Mr./Ms. $name You have successfully login to Naptune";
    header('location: login.php');
}
?>

