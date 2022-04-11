<?php
    $pdo = require_once "db_connect_PDO.php";
    require_once "function.php";
    session_start();
    $id = $_GET['id'] ?? null;
    if ($id == null){
        header("location:index.php");
    }
    $item = SelectItem($pdo,$id);
    $imgs = SelectImgs($pdo,$id);

    if(isset($_POST['SendMessage'])) {

        $description = $_POST['mail'] ?? null;

        if(EmptyInput($description) !== false){
            header("location: item.php?id=".$id."error=emptyInput");
            exit(); 
        }        
        foreach ($item as $i => $date) { 
            SendEmail($pdo,$_SESSION["UserId"],$date['SellerId'],$description,$id,$id."_".$_SESSION["UserId"]);
        }
    }