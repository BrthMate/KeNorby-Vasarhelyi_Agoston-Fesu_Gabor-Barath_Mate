<?php
    $pdo = require_once "db_connect_PDO.php";
    require_once "function.php";

    session_start();

    $sorted = $_POST['sorted'] ?? null;
    $sorted=Sorted($sorted);
    $items = SelectWatchItem($pdo, $_SESSION["UserId"],$sorted);


