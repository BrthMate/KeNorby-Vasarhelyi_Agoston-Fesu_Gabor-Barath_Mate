<?php
$pdo = require_once "db_connect_PDO.php";
require_once "function.php";
session_start();

$items = SelectItemsMes($pdo,$_SESSION["UserId"]);

if(isset($_POST['show'])) {
  
    $Incoming = $_POST['Incoming'] ?? null;
    $inc = $_POST['inc'] ?? null;
    $id =  $_POST['id'] ?? null;
    $sellerId =  $_POST['SellerId'] ?? null;
    $title = $_POST['Title'] ?? null;
    $_SESSION['Id'] = $id;
    $_SESSION['inc']= $inc;
    $_SESSION['SellerId'] = $sellerId;
    $_SESSION['Incoming'] = $Incoming;
    $messages = SelectMassage($pdo,$id,$_SESSION["UserId"],$inc);
}


