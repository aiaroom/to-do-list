<?php 
include_once('config.php');
include_once("db_connect.php");
include_once("index.php");
if(session_status() == PHP_SESSION_NONE){
    @session_name("tfhgfhgfh");
    @session_start();
  }

$order="";
$status="";
//echo($_POST["order"]);
if(isset($_POST["order"])) {
    if($_POST["order"]=="DESC") $orders="ORDER BY `status` DESC";
    if($_POST["order"]=="ASC") $order="ORDER BY `status` ASC";
}
if(isset($_POST["status"])) {
    if($_POST["status"]=="status1") $status="AND `status` = 1";
    if($_POST["status"]=="status0") $status="AND `status` = 0";
    if($_POST["status"]=="date") $status="AND DATE(date_of_create)";
}

if(isset($_POST["from"]) && $_POST["from"] != "") $status=$status. " >='".$_POST["from"]."' ";
if((isset($_POST["from"]) && $_POST["from"] != "") && (isset($_POST["to"]) && $_POST["to"] != "")) $status=$status." AND DATE(date_of_create) ";
if(isset($_POST["to"]) && $_POST["to"] != "") $status= $status."<= '".$_POST["to"]."' ";

$query = "SELECT * FROM `task_list` WHERE  `user_id`=(SELECT `id` FROM `users` WHERE `uname`='".$_SESSION['user']['nick']."') ".$status." AND `rem`=false  $order ";
$res_query = mysqli_query($connection,$query);
if(!$res_query) exit("Ошибка в запросе" .$status. ' '.$order);
$rows = mysqli_num_rows($res_query);



echo("<div class='active' style='color:##444444;' >");
for ($i=0; $i < $rows; $i++){
    $row = mysqli_fetch_assoc($res_query);
    if($row["status"] < 1) {
        $status='<form action="test" method="post" ><button style= "background: #fff; border: 2px; border-color: #ff3434; border-radius: 4px; opacity: 0.6;  padding: 5px 11px; float:right; font-family:Raleway, sans-serif;" type="submit" name="completedtaskid" id="task" value="'.$row["id"].'">
        <a " style=" color: red;">Выполнить</a></button> </form>';
        $class='<div class="task">';
    }else {$status='<form action="test" method="post" ><button type="submit" style= "background: #fff; border: 2px; border-color: #ff3434; border-radius: 4px; text-decoration: none; opacity: 0.6;  padding: 5px 11px; float:right; font-family:Raleway, sans-serif;" name="restoretaskid " id="task" value="'.$row["id"].'"><a href="status.php?id='.$row["id"].' " style=" color: red; text-decoration: none;">Выполнено</a></button></form>';
        $class='<div class="task">';
    }
    echo(
        $class.
    '<form action="index.php" method="post" id="task">'.
        $status.
    '</form>'.
    '<li  style=font-family: Raleway, sans-serif; "color:#444444;">'.$row["name"].'</li>'.
    '<p id="task" style= "float:left; margin-top:20px; font-family:Raleway, sans-serif;"><a href="rem.php?id='.$row["id"].'" style="text-decoration: none; color:grey;">Удалить</a></p>'.
'</div>');}
echo("</div>");

?>