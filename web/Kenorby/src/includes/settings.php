<?php
    $pdo = require_once "db_connect_PDO.php";
    require_once "db_connect_MySQLi.php";
    require_once "function.php";

    session_start();

    $statement = $pdo->prepare("SELECT * FROM `settings` WHERE Userid = :UserId ORDER BY Id ASC");
    $statement-> bindValue(":UserId",$_SESSION["UserId"]);
    $statement->execute();
    $info = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement = $pdo->prepare("SELECT * FROM `authentication` WHERE Id = :UserId ORDER BY Id ASC");
    $statement-> bindValue(":UserId",$_SESSION["UserId"]);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if(isset($_POST["EmailChange"])){
        $Email = $_POST["Email"];

        if(EmptyInput($Email) !== false){
            header("location: ../settings.php?error=emptyInput");
            exit(); 
        }
        if(InvalidInputEmail($Email) !== false ){
            header("location: ../settings.php?error=invalidInputEmail");
            exit();
        }        
        if(UserExistEmail($conn,$Email) !== false ){
            header("location: ../settings.php?error=UserExist");
            exit();
        }
        EmailUpdate($conn,$_SESSION["UserId"],$Email);
        header("location: ../settings.php?");
        exit();
    }
    if(isset($_POST["NameChange"])){
        $Name=$_POST["Name"];

        if(EmptyInput($Name) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }
        if(InvalidInputUsername($Name) !== false ){
            header("location: ../settings.php?error=invalidInputUsername");
            exit();
        }
        if(NotLongEnoughUsername($Name) !== false ){
            header("location: ../settings.php?error=notLongEnough");
            exit();
        }
        if(UserExistLogin($conn,$Name) !== false){
            header("location: ../settings.php?error=UserAllreadyExist");
            exit();
        }
        NameUpdate($conn,$_SESSION["UserId"],$Name);
        header("location: ../settings.php?");
        exit();
    }
    if(isset($_POST["PasswordChange"])){
        $Password=$_POST["Password"];
        $NewPassword=$_POST["NewPassword"];

        if(InvalidInputPassword($Password) !== false ){
            header("location: ../index.php?error=invalidinputPassword");
            exit();
        }
        if(InvalidInputPassword($NewPassword) !== false ){
            header("location: ../index.php?error=invalidinputPassword");
            exit();
        }
        if(EmptyInput($Password) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }
        if(EmptyInput($NewPassword) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }
        if(MatchPass($Password,$NewPassword) === false ){
            header("location: ../settings.php?error=passNotMatch");
            exit();
        }
        if(NotLongEnoughUsername($Password) !== false ){
            header("location: ../settings.php?error=notLongEnough");
            exit();
        }
        PasswordUpdate($conn,$_SESSION["UserName"],$Password);
        header("location: ../settings.php?");
        exit();
    }
    if(isset($_POST["phoneNChange"])){
        $Number=$_POST["Number"];

        if(EmptyInput($Number) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }
        if(PhoneLength($Number) !== false ){
            header("location: ../settings.php?error=notLongEnough");
            exit();
        }
        if(InvalidInt($Number) !== false ){
            header("location: ../settings.php?error=invalidPhone");
            exit();
        }
        PhoneUpdate($conn,$_SESSION["UserId"],$Number);
        header("location: ../settings.php?");
        exit();
    }
    if(isset($_POST["CityChange"])){
        $City=$_POST["City"];

        if(EmptyInput($City) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }
        if(InvalidString($City) !== false ){
            header("location: ../settings.php?error=InvalidString");
            exit();
        }
        CityUpdate($conn,$_SESSION["UserId"],$City);
        header("location: ../settings.php?");
        exit();
    }
    if(isset($_POST["ZipCodeChange"])){
        $ZipCode=$_POST["ZipCode"];

        if(EmptyInput($ZipCode) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }
        if(InvalidInt($ZipCode) !== false ){
            header("location: ../settings.php?error=InvalidInt");
            exit();
        }if(ZipCodeLength($ZipCode) !== false ){
            header("location: ../settings.php?error=notLongEnough");
            exit();
        }

        ZipCodeUpdate($conn,$_SESSION["UserId"],$ZipCode);
        header("location: ../settings.php?");
        exit();
    }
    if(isset($_POST["StreetChange"])){
        $Street=$_POST["Street"];

        if(EmptyInput($Street) !== false ){
            header("location: ../settings.php?error=emptyInput");
            exit();
        }

        StreetUpdate($conn,$_SESSION["UserId"],$Street);
        header("location: ../settings.php?");
        exit();
    }
