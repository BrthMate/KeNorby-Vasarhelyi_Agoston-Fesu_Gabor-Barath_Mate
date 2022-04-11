<?php

if(isset($_POST["Regist"])){
   $Username = $_POST["Username"];
   $Password = $_POST["Password"];
   $Email = $_POST["Email"];
   require_once "db_connect_MySQLi.php";
   require_once "function.php";

   if(EmptyInputsRegist($Username,$Password,$Email) !== false ){
    header("location: ../index.php?regerror=emptyInput");
    exit();
   }
   if(InvalidInputUsername($Username) !== false ){
    header("location: ../index.php?regerror=invalidInputUsername");
    exit();
   }
   if(InvalidInputPassword($Password) !== false ){
    header("location: ../index.php?regerror=invalidInputPassword");
    exit();
   }
   if(InvalidInputEmail($Email) !== false ){
    header("location: ../index.php?regerror=invalidInputEmail");
    exit();
   }
   if(NotLongEnough($Username,$Password) !== false ){
    header("location: ../index.php?regerror=notLongEnough");
    exit();
   }
   if(UserExist($conn,$Username,$Email) !== false ){
    header("location: ../index.php?regerror=UserExist");
    exit();
   }
   createUser($conn,$Username,$Password,$Email);
   addSettings($conn,$Email);
}
else{
    header("location: ../index.php");
}