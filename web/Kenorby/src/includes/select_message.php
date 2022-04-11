<?php
$pdo = require_once "db_connect_PDO.php";
require_once "function.php";
session_start();
if(isset($_SESSION["UserId"]) && isset($_SESSION['inc'])){
    $messages = SelectMassage($pdo, $_SESSION['Id'],$_SESSION["UserId"],$_SESSION['inc']);

    $text="";

    foreach($messages as $message) {
        if($_SESSION["UserId"]==$message['Outgoing']){ 
            $text .='<div class="get">
                            <p>'.$message["Msg"].'</p>
                        </div>';
        }else{
                $text .='<div class="send">
                <p>'.$message["Msg"].'</p> 
            </div>';
        }
    }
    echo $text;
}