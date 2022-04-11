<?php
 function EmptyInputsRegist($Username,$Password,$Email){
     $result;
     if(empty($Username) ||  empty($Password) || empty($Email)){
       $result = true;  
     }else{
        $result = false;
     }
     return $result;
}
function EmptyInputsLogin($Username,$Password){
    $result;
    if(empty($Username) ||  empty($Password)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}

function EmptyInput($var){
    $result;
    if(empty($var)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function InvalidInputUsername($Username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$Username)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function InvalidInputPassword($Password){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$Password)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function InvalidString($String){
    $result;
    if(!preg_match("/^[a-zA-Z]*$/",$String)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function InvalidInt($Number){
    $result;
    if(!preg_match("/^[0-9]*$/",$Number)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function PhoneLength($Number){
    $result;
    if(strlen($Number)<11 || strlen($Number)>11){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function InvalidInputEmail($Email){
    $result;
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function NotLongEnough($Username,$Password){
    $result;
    if(strlen($Username)<8 || strlen($Password) <8){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function NotLongEnoughUsername($Username){
    $result;
    if(strlen($Username)<8){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function ZipCodeLength($Code){
    $result;
    if(strlen($Code)!=4){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function MatchPass($Pass,$NewPassword){
    $result;
    if($Pass === $NewPassword){
      $result = true;  
    }else{
       $result = false;
    }
    return $result;
}
function UserExistLogin($conn,$Username){
    $sql = "SELECT * FROM authentication WHERE  UserName = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $Username );
    mysqli_stmt_execute($stmt);

    $resultDate = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultDate)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function UserExist($conn,$Username,$Email){
    $sql = "SELECT Email, UserName FROM authentication WHERE  Email = ? OR UserName = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss', $Email, $Username );
    mysqli_stmt_execute($stmt);

    $resultDate = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultDate)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function UserExistEmail($conn,$Email){
    $sql = "SELECT Email, UserName FROM authentication WHERE  Email = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $Email, );
    mysqli_stmt_execute($stmt);

    $resultDate = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultDate)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function UserExistLoginUserName($conn,$Username){
    $sql = "SELECT * FROM authentication WHERE  UserName = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $Username );
    mysqli_stmt_execute($stmt);

    $resultDate = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultDate)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function UserExistForgetPass($conn,$Email){
    $sql = "SELECT * FROM authentication WHERE  Email = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $Email );
    mysqli_stmt_execute($stmt);

    $resultDate = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultDate)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $Username,$Password,$Email){
    $sql = "INSERT INTO authentication (UserName, Email, UserPass)  VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    $hashed_pass = password_hash($Password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,'sss', $Username, $Email,$hashed_pass );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    /*
    $resultDate = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultDate)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    */
}
function addSettings($conn,$Email){
    $sql = "SELECT Id FROM `authentication` WHERE `Email`= ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $Email);
    mysqli_stmt_execute($stmt);
    $resultDate = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultDate);
    createMobil($conn,$row);
    createSettings($conn,$row);
    mysqli_stmt_close($stmt);
    exit();
}
function createSettings($conn,$row){
    $sql = "INSERT INTO `settings`(`UserId`) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $row['Id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function createMobil($conn,$row){
    $sql = "INSERT INTO `mobil`(`UserId`) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s', $row['Id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function loginDate($conn,$name){
    $sql = "UPDATE authentication SET Date = NOW() WHERE UserName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=LoginDate");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s',$name );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function EmailUpdate($conn,$Id,$NewEmail){
    $sql = "UPDATE authentication SET Email = ? WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=EmailUpdate");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$NewEmail,$Id );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION["Email"]=$NewEmail;  
}
function PhoneUpdate($conn,$Name,$Phone){
    $sql = "UPDATE settings SET PhoneNumber = ? WHERE UserId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=PhoneUpdate");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$Phone,$Name );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function CityUpdate($conn,$Name,$City){
    $sql = "UPDATE settings SET City = ? WHERE UserId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=CityUpdate");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$City,$Name );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function ZipCodeUpdate($conn,$Name,$ZipCode){
    $sql = "UPDATE settings SET ZipCode = ? WHERE UserId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=ZipCode");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$ZipCode,$Name );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function NameUpdate($conn,$Id,$NewName){
    $sql = "UPDATE authentication SET UserName = ? WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=Username");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$NewName,$Id );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION["UserName"]=$NewName;  
}
function StreetUpdate($conn,$Name,$Street){
    $sql = "UPDATE settings SET Street = ? WHERE UserId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=Street");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$Street,$Name );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function PasswordUpdate($conn,$Username,$Password){
    $sql = "UPDATE authentication SET UserPass = ?, FPass = ? WHERE UserName = ?;";
    $stmt = mysqli_stmt_init($conn);
    $empty="";
    $hashed_pass = password_hash($Password, PASSWORD_DEFAULT);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../settings.php?error=Password");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'sss',$hashed_pass,$empty,$Username );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function loginUser($conn, $name, $pass){
    $userExists =  UserExistLogin($conn, $name);

    if($userExists === false){
        header("location: ../index.php?error=LoginError");
        exit();
    }else{
        $hashed_pass = $userExists["UserPass"];
        $Forget_Pass = $userExists["FPass"];

        $check_Fpass = password_verify($pass,$Forget_Pass);
        $check_pass = password_verify($pass,$hashed_pass);

        if($check_pass === false && $check_Fpass === false){
            header("location: ../index.php?error=LoginErrorWP");
            exit();
        }elseif ($check_pass === true || $check_Fpass === true){
            if($userExists["Allow"] == 1){
                header("location: ../index.php?error=UserBlocked");
                exit();
            }
            loginDate($conn,$name);
            header("location: ../kenorby.php");
            session_start();
            $_SESSION["UserName"] = $userExists["UserName"];
            $_SESSION["UserId"] = $userExists["Id"];
            $_SESSION["UserEmail"] = $userExists["Email"];
            $_SESSION["Allow"] = $userExists["Allow"];
        }
    }
}
function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}
function sendMail($conn,$Email){
    $sql = "UPDATE authentication SET FPass = ? WHERE Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmntfailed");
        exit();
    }
    $pass = randomString(13);
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,'ss',$hashed_pass, $Email );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $data = UserExistEmail($conn,$Email);
    $username=$data["UserName"];
    SendMailReal($Email,$pass,$username);
    
}
function SendMailReal($Email,$pass,$username){
    $OurEmail = "kenorbyecom@gmail.com";
    $MailtTo = $Email;
    $Subject = "Új Jelszó igénylés";
    $Text = "Emailcím: " .$MailtTo. "\nFelhasználó név: " . $username . " \nIdeiglenes jelszó: ". $pass;
    $Headers ="From: ".$OurEmail;
    if(mail($MailtTo, $Subject, $Text, $Headers)){
        header("location: ../index.php?error=EmailSend");
    }else{
        header("location: ../index.php?error=EmailSendFail");
    }
}
function SendEmail($pdo,$income,$outgoing,$msg,$id,$inc){
    $statement = $pdo->prepare("INSERT INTO messages (Incoming, Outgoing, Msg, ItemId,inc)
                VALUES ( :income, :outgoing, :msg ,:id , :in)");
    $statement->bindValue(':income',$income);
    $statement->bindValue(':outgoing',$outgoing);
    $statement->bindValue(':msg',$msg);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':in',$inc);
    $statement->execute();;
}
function SelectItem($pdo,$id){
    $statement = $pdo->prepare("SELECT items.Id,Title,CreateDate,Img,Price,Description,Brand,District,Type,Conditions,Size,UserName,Date,PhoneNumber,City,ZipCode,Street,Map,SellerId,FolderName FROM `items` INNER JOIN districts\n"
    . "ON items.DistrictId = districts.Id INNER JOIN types\n"
    . "ON items.TypeId = types.Id INNER JOIN conditions\n"
    . "ON items.ConId = conditions.Id INNER JOIN sizes\n"
    . "ON items.SizeId = sizes.Id  INNER JOIN authentication \n"
    . "ON items.SellerId = authentication.Id INNER JOIN settings \n"
    . "ON items.SellerId = settings.UserId WHERE items.Id = :value");
    $statement->bindValue(":value", "$id");
    $statement->execute();
    return $item = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectImgs($pdo,$id){
    $statement = $pdo->prepare("SELECT  Img FROM imgs WHERE ItemId= :value");
    $statement->bindValue(":value", "$id");
    $statement->execute();
    return $imgs = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectDistricts($pdo){
    $statement = $pdo->prepare("SELECT * FROM `districts` ORDER BY Id ASC");
    $statement->execute();
    return $districts = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectSizes($pdo){
    $statement = $pdo->prepare("SELECT * FROM `sizes` ORDER BY Id ASC");
    $statement->execute();
    return $sizes = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectTypes($pdo){
    $statement = $pdo->prepare("SELECT * FROM `types` ORDER BY Id ASC");
    $statement->execute();
    return $types = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectMinPrice($pdo){
    $statement = $pdo->prepare("SELECT Min(Price) as Price FROM `items`");
    $statement->execute();
    return $MinPrice = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectMaxPrice($pdo){
    $statement = $pdo->prepare("SELECT Max(Price) as Price FROM `items`");
    $statement->execute();
    return $MaxPrice = $statement->fetchAll(PDO::FETCH_ASSOC);  
}
function SelectConditions($pdo){
    $statement = $pdo->prepare("SELECT * FROM `Conditions` ORDER BY Id ASC");
    $statement->execute();
    return $conditions = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectWatchItem($pdo,$var,$sorted){
    $statement = $pdo->prepare("SELECT items.Id,Title,Img,Price,Description,Type,District FROM `items` INNER JOIN districts\n"
    . "ON items.DistrictId = districts.Id INNER JOIN types\n"
    . "ON items.TypeId = types.Id WHERE sellerId =:value $sorted");
    $statement->bindValue(":value", $var);
    $statement->execute();
    return $items = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function Sorted($sorted){
    if($sorted == "priceAsc"){return $sorted = "ORDER BY Price ASC";}
    if($sorted == "priceDesc"){return $sorted = "ORDER BY Price Desc";}
    if($sorted == "dateAsc"){return $sorted = "ORDER BY CreateDate ASC";}
    if($sorted == "dateDesc"){return $sorted = "ORDER BY CreateDate Desc";}
    //if($sorted == "popularity"){return $sorted = "ORDER BY Popular Desc";}
    if($sorted == "popularity"){return $sorted = "";}
}
function SelectMassage($pdo,$id,$var,$inc){
    $statement = $pdo->prepare("SELECT * FROM messages WHERE ItemId =:pid AND  inc=:inc  AND (Outgoing = :id OR Incoming = :id);");
    $statement->bindValue(':pid', $id);
    $statement->bindValue(':id', $var);
    $statement->bindValue(':inc', $inc);
    $statement->execute();
    return $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function SelectItemsMes($pdo,$var) {
    $statement = $pdo->prepare("SELECT Title,Price,District,Type,Description,items.Id,Img,SellerId,Incoming,Outgoing,inc FROM `items` INNER JOIN districts\n"
    . "ON items.DistrictId = districts.Id INNER JOIN types\n"
    . "ON items.TypeId = types.Id  INNER JOIN messages\n"
    . "ON items.Id = messages.ItemId WHERE Outgoing = :id or Incoming = :id GROUP BY inc ORDER BY CreateDate");
    $statement->bindValue(':id',$var);
    $statement->execute();
    return $items = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function NotSelect($var){
    if ($var == "base"){
        return true;
    }
    else{
        return false;
    }
}
function insertIntoItems($pdo,$title,$Path,$price,$desc,$type,$size,$FolderPath,$var,$where,$condition,$brand){
    $statement = $pdo->prepare("INSERT INTO items (Title,CreateDate,Img,Price,Description,TypeId,SizeId,FolderName,SellerId,DistrictId,ConId,Brand)
                VALUES (:Title, NOW(), :Img, :Price, :Description, :TypeId ,:SizeId, :FolderName, :SellerId,:DistrictId,:ConId,:Brand)");
    $statement->bindValue(':Title', $title);
    $statement->bindValue(':Img', $Path);
    $statement->bindValue(':Price', $price);
    $statement->bindValue(':Description', $desc);
    $statement->bindValue(':TypeId', $type);
    $statement->bindValue(':SizeId', $size);
    $statement->bindValue(':FolderName', $FolderPath);
    $statement->bindValue(':SellerId', $var);
    $statement->bindValue(':DistrictId', $where);
    $statement->bindValue(':ConId', $condition);
    $statement->bindValue(':Brand', $brand);
    $statement->execute();
}
function itemId($pdo){
    $statement=$pdo->prepare("SELECT max(Id) as maxid FROM items");
    $statement->execute();
    return $proid = $statement->fetchAll(PDO::FETCH_ASSOC);
}
function InsertImgs($pdo,$imagePaths,$var){
    $statement=$pdo->prepare("INSERT INTO imgs (Img, ItemId) VALUES (:img, :id)");
    $statement->bindValue(':img', $imagePaths);
    $statement->bindValue(':id',intval($var));
    $statement->execute();
}
function selItem($pdo,$id){
    $statement = $pdo->prepare('SELECT * FROM items WHERE Id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    return $product = $statement->fetch(PDO::FETCH_ASSOC);
}
function delItem($pdo,$id){
    $statement = $pdo->prepare('DELETE FROM items WHERE Id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
}
function delImg($pdo,$id){
    $statement = $pdo->prepare('DELETE FROM imgs WHERE ItemId = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
}
function updateIntoItems($pdo,$title,$Path,$price,$desc,$type,$size,$FolderPath,$var,$where,$condition,$brand,$Id){
    $statement = $pdo->prepare("UPDATE items Set Title = :Title,CreateDate = NOW() ,Img =  :Img,Price = :Price,Description=:Description,TypeId = :TypeId ,SizeId = :SizeId,FolderName = :FolderName,SellerId= :SellerId,DistrictId=:DistrictId,ConId=:ConId,Brand=:Brand WHERE Id=:id");
    $statement->bindValue(':Title', $title);
    $statement->bindValue(':Img', $Path);
    $statement->bindValue(':Price', $price);
    $statement->bindValue(':Description', $desc);
    $statement->bindValue(':TypeId', $type);
    $statement->bindValue(':SizeId', $size);
    $statement->bindValue(':FolderName', $FolderPath);
    $statement->bindValue(':SellerId', $var);
    $statement->bindValue(':DistrictId', $where);
    $statement->bindValue(':ConId', $condition);
    $statement->bindValue(':Brand', $brand);
    $statement->bindValue(':id', $Id);
    $statement->execute();
}
function CheckAllow($pdo,$user){
    $statement = $pdo->prepare("SELECT Allow FROM authentication WHERE  UserName = :id ;");
    $statement->bindValue(':id', $user);
    $statement->execute();
    return $allow = $statement->fetch(PDO::FETCH_ASSOC);
}

