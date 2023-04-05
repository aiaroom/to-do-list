<?php
include_once('config.php');
include_once("db_connect.php");

if(session_status() == PHP_SESSION_NONE){
  @session_name("tfhgfhgfh");
  @session_start();
}
if(!isset($_COOKIE["user"])){
  header("Location: av.html");
  exit;
}
include_once("db_connect.php");
    //echo"11";
    if(isset($_POST["completedtaskid"])){
        $query = "UPDATE `task_list` SET `status`=true WHERE `id`=".$_POST["completedtaskid"];
        $res_query = mysqli_query($connection,$query);
        if(!$res_query) exit("<p>Задание не найдено!</p>");
        header("Location: index.php");
        exit;
    }
    if(isset($_POST["restoretaskid"])){
        $query = "UPDATE `task_list` SET `status`=false WHERE `id`=".$_POST["restoretaskid"];
        $res_query = mysqli_query($connection,$query);
        if(!$res_query) exit("<p>Задание не найдено!</p>");
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>

<html>

 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>to-do list from lis</title>

  <link rel="stylesheet" type="text/css" href="to-do.css">

 </head>

 <body>
 <div class="exit">
    <form action="av.html" method="get" id="exit"><button type="submit" name="extbtn" style="background-color: #ff3434; color: #fff; border:1px solid #fff; border-radius: 5px; font-size: 14px; margin:10px; width: 70px;
    height: 30px; float:left;">Выйти</button></form>
    </div>
    <div class="text-title">To-Do List from Lis</div>

    <div class="username">
        <span><?php echo( "[".$_SESSION['user']['nick']."]"); ?>
        </span></div>

     <div class="wrapper">

        <div class="task-input">

          <ion-icon name="create-outline"></ion-icon>
          <form action="add.php" method="post" enctype="multipart/form-data" >
          <input type="text" placeholder="Добавить задание + Enter" name="title" id="title" required/>
          </form>
          
        </div>

        <div class="controls">

          <div class="filters">
           <form action="index.php" method="post" id="filters">
                <select name="status" style="border-radius:5px;">
                        <option value="" style="display: none;">Фильтр</option>
                        <option value="status1">Выполненные</option>
                        <option value="status0">Невыполненные</option>
                        <option value="date">По дате создания</option>
                        <option value="">Все</option>
                 </select>
                 <select name="order" style="border-radius:5px;">
                        <option value="" style="display: none;">Сортировка</option>
                        <option value="DESC">Сначала выполненные</option>
                        <option value="ASC">Сначала невыполненные</option>
                 </select>
                 <div style="display:flex; gap:15px; ">
                 <div class="date" style="margin-top:10px; ">
                    <label for="from" style="font-size: 15px;">От:</label>
                    <input type="date" name="from">
                </div>
                <div class="date" style="margin-top:10px; ">
                    <label  for="to" style="font-size: 15px;">До:</label>
                    <input type="date" name="to">
                </div>
                </div>
                <button type="submit" style= "background: #ff0000; border: none; border-radius: 4px; opacity: 0.6;  padding: 5px 11px; color:#fff; margin-top: 15px;">Показать</button>
                <button type="reset" style= "background: #ff0000; border: none; border-radius: 4px; opacity: 0.6;  padding: 5px 11px; color:#fff; margin-top: 15px;" >Сбросить</button>
          </form>


          </div>

          <!-- <button class="clear-btn">Clear All</button> -->

        </div>

        <div class="task-box">
          <div>
            <?php include "show.php"?>
          </div>
        </div>

      </div>
 </body>
</html>