<?php
    $pdo = require_once "db_connect_PDO.php";
    require_once "function.php";

    session_start();
    $types = SelectTypes($pdo);
    $sizes = SelectSizes($pdo);
    $districts = SelectDistricts($pdo);
    $conditions = SelectConditions($pdo);

    if(isset($_POST["upload"])){

        $title = $_POST['title'];
        $imagePath = '';

        $type = $_POST['type'];
        $size = $_POST['size']; 
        $where = $_POST['where'];
        $condition = $_POST['condition'];
        $brand = $_POST['brand'];
        $desc = $_POST["desc"];
        $price = $_POST["price"];

        if (!is_dir('image')) {
            mkdir('image');
        }
        if(EmptyInput($title) !== false){
            header("location: upload.php?error=emptyInput");
            exit(); 
        }
        if(EmptyInput($brand) !== false){
            header("location: upload.php?error=emptyInput");
            exit(); 
        }
        if(EmptyInput($price) !== false){
            header("location: upload.php?error=emptyInput");
            exit(); 
        }
        if(NotSelect($type) !== false){
            header("location: upload.php?error=emptySelect");
            exit(); 
        }
        if(NotSelect($size) !== false){
            header("location: upload.php?error=emptySelect");
            exit(); 
        }
        if(NotSelect($where) !== false){
            header("location: upload.php?error=emptySelect");
            exit(); 
        }
        if(NotSelect($condition) !== false){
            header("location: upload.php?error=emptySelect");
            exit(); 
        }

        $Path= randomString(8); 
        $Image = 'image/' .$Path . '/' . $_FILES['files']['name'][0];   
        insertIntoItems($pdo,$title,$Image,$price,$desc,$type,$size,$Path,$_SESSION["UserId"],$where,$condition,$brand);
        $proid = itemId($pdo);
        
        $fileNames = array_filter($_FILES['files']['name']); 
        if(!empty($fileNames)){ 
            foreach($_FILES['files']['name'] as $key=>$val){   
                $fileName = basename($_FILES['files']['name'][$key]); 
                $imagePaths = 'image/' .$Path .'/'. $fileName;
                if (!file_exists('image/' .$Path)) {
                    mkdir(dirname($imagePaths)); 
                }
                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $imagePaths);
                foreach( $proid as $i){ 
                    InsertImgs($pdo,$imagePaths,$i['maxid']);
                }
            }
        }
        header("location: upload.php?");
    }