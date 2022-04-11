<?php
    $pdo = require_once "db_connect_PDO.php";
    require_once "function.php";

    $id = $_GET['id'] ?? null;
    if ($id == null){
        header("location:watch.php");
    }

    session_start();
    $types = SelectTypes($pdo);
    $sizes = SelectSizes($pdo);
    $districts = SelectDistricts($pdo);
    $conditions = SelectConditions($pdo);
    $item = SelectItem($pdo,$id);

    $title= $item[0]["Title"];
    $desc= $item[0]["Description"];
    $price= $item[0]["Price"];
    $brand= $item[0]["Brand"];
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
            header("location: modification.php?error=emptyInput");
            exit(); 
        }
        if(EmptyInput($brand) !== false){
            header("location: modification.php?error=emptyInput");
            exit(); 
        }
        if(EmptyInput($price) !== false){
            header("location: modification.php?error=emptyInput");
            exit(); 
        }
        if(NotSelect($type) !== false){
            header("location: modification.php?error=emptySelect");
            exit(); 
        }
        if(NotSelect($size) !== false){
            header("location: modification.php?error=emptySelect");
            exit(); 
        }
        if(NotSelect($where) !== false){
            header("location: modification.php?error=emptySelect");
            exit(); 
        }
        if(NotSelect($condition) !== false){
            header("location: modification.php?error=emptySelect");
            exit(); 
        }
        if (!is_dir('image')) {
            mkdir('image');
        }
        $folder = $item[0]['FolderName'];
        $files = glob("image/".$folder . '/*');
        foreach($files as $file){
            if(is_file($file)){
                unlink($file);
            }
        }
        rmdir("image/".$item[0]['FolderName']);
        delImg($pdo,$id);

        $Path= randomString(8); 
        $Image = 'image/' .$Path . '/' . $_FILES['files']['name'][0];   
        UpdateIntoItems($pdo,$title,$Image,$price,$desc,$type,$size,$Path,$_SESSION["UserId"],$where,$condition,$brand,$id);
        
        $fileNames = array_filter($_FILES['files']['name']); 
        if(!empty($fileNames)){ 
            foreach($_FILES['files']['name'] as $key=>$val){   
                $fileName = basename($_FILES['files']['name'][$key]); 
                $imagePaths = 'image/' .$Path .'/'. $fileName;
                if (!file_exists('image/' .$Path)) {
                    mkdir(dirname($imagePaths)); 
                }
                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $imagePaths);
                InsertImgs($pdo,$imagePaths,$id);
            }
        }
        header("location: watch.php?");
    }
    