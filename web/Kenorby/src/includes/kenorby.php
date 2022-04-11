<?php
  $pdo = require_once "db_connect_PDO.php";
  require_once "function.php";
  session_start();

  $keyword = $_GET['search'] ?? null;
  $type = $_GET['type'] ?? null;
  $size = $_GET['size'] ?? null;
  $district= $_GET['district'] ?? null;
  $min = $_GET['rangeValuemin'] ?? null;
  $max= $_GET['rangeValuemax'] ?? null;
  $sorted = $_POST['sorted'] ?? null;
  $sqlText = null; $fullText=null;

  $sorted=Sorted($sorted);

  $districts = SelectDistricts($pdo);
  $sizes = SelectSizes($pdo);
  $types = SelectTypes($pdo);
  $MinPrice = SelectMinPrice($pdo);
  $MaxPrice = SelectMaxPrice($pdo);
  
  if($keyword !== null){
    $statement = $pdo->prepare("SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
    . "ON items.DistrictId = districts.Id INNER JOIN types\n"
    . "ON items.TypeId = types.Id WHERE Title Like :value $sorted");
    $statement->bindValue(":value", "%$keyword%");
    $keyword="";
  }elseif($type !== null ||  $district !== null || $size !== null){
    if($type !== null){
      $count=0; 
      $counted=count($type);
      foreach ($type as $value) {
        $count++;
        if($count<$counted){
          $sqlText .= " TypeId= $value OR";
        }else{
          $sqlText .= " TypeId = $value";
          if( $district == null && $size == null){
            $fullText.= "SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
            . "ON items.DistrictId = districts.Id INNER JOIN types\n"
            . "ON items.TypeId = types.Id WHERE $sqlText AND Price BETWEEN $min AND $max $sorted";
            $statement = $pdo->query($fullText);
          }else{
            $sqlText .= " AND ";
          }
        }
      }
    }
    if($district !== null){
      $count=0; 
      $counted=count($district);
      foreach ($district as $value) {
        $count++;
        if($count<$counted){
          $sqlText .= " DistrictId= $value OR";
        }else{
          $sqlText .= " DistrictId = $value";
          if( $type == null && $size == null){
            $fullText.= "SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
            . "ON items.DistrictId = districts.Id INNER JOIN types\n"
            . "ON items.TypeId = types.Id WHERE $sqlText AND Price BETWEEN $min AND $max $sorted";
            $statement = $pdo->query($fullText);
          }else{
            if($size != null){
              $sqlText .= " AND ";
            }
          }
        }
      }
    }
    if($size !== null){
      $count=0; 
      $counted=count($size);
      foreach ($size as $value) {
        $count++;
        if($count<$counted){
          $sqlText .= " SizeId= $value OR";
        }else{
          $sqlText .= " SizeId = $value";
          if( $district == null && $type == null){
            $fullText.= "SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
            . "ON items.DistrictId = districts.Id INNER JOIN types\n"
            . "ON items.TypeId = types.Id WHERE $sqlText AND Price BETWEEN $min AND $max $sorted";
            $statement = $pdo->query($fullText);
          }
        }
      }
    }
    if(($size && $district && $type)||($type && $district) ||($size && $district) ||($type && $size)){
      $fullText.= "SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
      . "ON items.DistrictId = districts.Id INNER JOIN types\n"
      . "ON items.TypeId = types.Id WHERE $sqlText AND Price BETWEEN $min AND $max $sorted";
      $statement = $pdo->query($fullText);
    }
  }
  else{
    if($min!=null && $max != null){
      $statement = $pdo->prepare("SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
      . "ON items.DistrictId = districts.Id INNER JOIN types\n"
      . "ON items.TypeId = types.Id AND Price BETWEEN $min AND $max $sorted");
    }else{
      $statement = $pdo->prepare("SELECT Title,Price,District,Type,Description,items.Id,Img FROM `items` INNER JOIN districts\n"
      . "ON items.DistrictId = districts.Id INNER JOIN types\n"
      . "ON items.TypeId = types.Id $sorted");
    }
  }
    $statement->execute();
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

