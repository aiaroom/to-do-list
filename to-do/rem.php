<?php
if(!isset($_GET["id"])) exit;

include_once("db_connect.php");

$query = "UPDATE `task_list` SET `rem`=true WHERE `id`=".$_GET["id"];
$res_query = mysqli_query($connection,$query);
if(!$res_query) exit("<p>ошибка</p>");

header("Location: index.php");
exit;