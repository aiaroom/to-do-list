<?php



@session_name("tfhgfhgfh");
@session_start();

include_once('config.php');

include_once("db_connect.php");

$login = $_POST['name'];

$password = $_POST['password'];

// $md5_password = md5($password);

$query = mysqli_query($connection, "SELECT * FROM `users` WHERE `uname`='".$login."' AND `password`='".$password."'");

if (mysqli_num_rows($query) == 1) {

    $_SESSION['user'] = ['nick' => $login];
    setcookie("user", $login);

    header("Location: index.php");
    require_once('index.php');
    //echo("авторизация");

} 
 
else {

    echo("Ошибка: Данный логин или пароль неправильны.");

}