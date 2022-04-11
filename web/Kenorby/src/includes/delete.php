<?php

$pdo = require_once "db_connect_PDO.php";
require_once "function.php";

$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: ../watch.php');
    exit();
}
$product= selItem($pdo,$id);

$folder = $product['FolderName'];
    $files = glob("../image/".$folder . '/*');
    foreach($files as $file){
        if(is_file($file)){
            unlink($file);
        }
    }
    rmdir("../image/".$product['FolderName']);

delItem($pdo,$id);
delImg($pdo,$id);
header('Location: ../watch.php');



