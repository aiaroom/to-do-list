<?php 
header("Location: index.php");
 if(isset($_POST["title"]) && $_POST["title"] != ""){
    include_once('config.php');
    include_once("db_connect.php");
    include_once("index.php");
    
	$title = $_POST['title'];
    $query= "INSERT INTO `task_list` (`name`, `user_id`) VALUES ('".$title."', (SELECT `id` FROM `users` WHERE `uname`='".$_SESSION['user']['nick']."'))";
	$res_query = mysqli_query($connection,$query);
    if(!$res_query) exit("Ошибка в запросе");

    exit;
 }
 
?>
