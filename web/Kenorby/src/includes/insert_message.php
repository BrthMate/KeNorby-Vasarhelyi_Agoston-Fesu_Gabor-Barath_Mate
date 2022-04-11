<?php
$pdo = require_once "db_connect_PDO.php";
require_once "function.php";
session_start();
    $description = $_POST['description']; 
    
    if(EmptyInput($description) !== false){
      
    }
    else{
      if($_SESSION['SellerId']!=$_SESSION["UserId"]){
        $inc=$_SESSION['Id']."_".$_SESSION["UserId"];
        $Incoming = $_POST['Incoming'] ?? null;
        $statement = $pdo->prepare("INSERT INTO messages (Incoming, Outgoing, Msg, ItemId, inc)
              VALUES ( :Incoming, :outgoing, :msg ,:id,:inc )");
        $statement->bindValue(':Incoming', $_SESSION["UserId"]);
        $statement->bindValue(':outgoing',$_SESSION['SellerId']);
        $statement->bindValue(':msg', $description);
        $statement->bindValue(':id', $_SESSION['Id']);
        $statement->bindValue(':inc', $inc);
        $statement->execute();
        $description=null;
      }
      else{
        $inc=$_SESSION['Id']."_".$_SESSION["Incoming"];
        $statement = $pdo->prepare("INSERT INTO messages (Incoming, Outgoing, Msg, ItemId, inc)
              VALUES ( :Incoming, :outgoing, :msg ,:id,:inc )");
        $statement->bindValue(':Incoming', $_SESSION["UserId"]);
        $statement->bindValue(':outgoing',$_SESSION['Incoming']);
        $statement->bindValue(':msg', $description);
        $statement->bindValue(':id', $_SESSION['Id']);
        $statement->bindValue(':inc', $inc);
        $statement->execute();
        $description=null;
      }
    } 