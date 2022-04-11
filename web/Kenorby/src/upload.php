<?php require_once "includes/upload.php";
if($_SESSION["UserName"] == null){
    header("location: index.php"); 
}
$_SESSION["Allow"] = CheckAllow($pdo,$_SESSION["UserName"])["Allow"];
if($_SESSION["Allow"] == 1){
    require_once "includes/logout_mainPage.php";
}
$error= $_GET['error'] ?? null;
include_once "includes/errors.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kenorby</title>
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/upload.css">
    </head>
<body>
        <header>
            <div class="logo">
                <div class="logo-container"><span class="lo">Ke</span><span class="go">Norby</span></div>
            </div>
            <div class="menu-btn">
                <div class="menu-btn__burger"></div>
            </div>
        </header>
        <main>
        <?php if(!empty($error) or !(empty($regerror))){ ?>
                 <div class="<?php if($error == "none" || $error =="EmailSend"){echo "alert alert-success";}else{echo "alert alert-warning";}?>" style="position: absolute; left: 0; width: 100%; text-align:center">
                    <?php echo error($error); ?>
                    <?php if(!empty($regerror)){echo "regisztrációs hiba";}?>
                </div>
        <?php }?>
            <div class="container">
                <form action="" method="POST"  enctype="multipart/form-data">
                    <div class="item-infos">
                        <div class="details">
                            <h2>
                                Hírdetés neve    
                            </h2>
                            <div class="input-field">
                                <input type="Text" name="title" placeholder="Ezen a néven lesz kereshető a termék">
                            </div>
                        </div>
                    </div>
                    <div class="item-infos">
                        <div class="details">
                            <h2>
                                Képek
                            </h2>
                            <div class="input-field" id="pics">
                                <input type="submit" value="Feltöltött képek" class="btn-login" id="showPics" >
                                <input accept="image/*" type="file" name="files[]"  id="upload-button" hidden onchange="view()" multiple />
                                <label for="upload-button">Fájl feltöltése</label>
                                
                            </div>
                            <div class="pics-container">
                                <i class='bx bx-left-arrow-alt' id="hide"></i>
                                <div class="pics">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-infos">
                        <div class="details">
                            <h2>
                                Kategoria
                            </h2>
                            <div class="type">                           
                                <select name="type" id="type">
                                    <option value="base">Tipus</option>
                                    <?php foreach ($types as $i => $type) { ?>  
                                        <option value="<?php echo $type['Id']; ?>"><?php echo $type['Type'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="size">                           
                                <select name="size" id="size">
                                    <option value="base">Méret</option>
                                    <?php foreach ($sizes as $i => $size) { ?>  
                                        <option value="<?php echo $size['Id']; ?>"><?php echo $size['Size'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>  
                            <div class="where">                           
                                <select name="where" id="where">
                                    <option value="base">Hol</option>
                                    <?php foreach ($districts as $i => $district) { ?>  
                                        <option value="<?php echo $district['Id']; ?>"><?php echo $district['District'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>  
                        </div>
                    </div>
                    <div class="item-infos"> 
                        <div class="details">
                            <h2>
                                Tulajdonságok
                            </h2>
                            <select name="condition" id="condition">
                                <option value="base">Állapot</option>
                                <?php foreach ($conditions as $i => $condition) { ?>  
                                        <option value="<?php echo $condition['Id']; ?>"><?php echo $condition['Conditions'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-field">
                                <input type="text" name="brand" placeholder="Márka">
                            </div>
                        </div>
                    </div>
                    <div class="item-infos">
                        <div class="details">
                            <h2>
                                Leírás
                            </h2>
                                <textarea name="desc" type="text"></textarea>
                        </div>
                    </div>
                    <div class="item-infos">
                        <div class="details">
                            <h2>
                                Ár
                            </h2>
                            <div class="input-field">
                                <input type="number" name="price" min="0" placeholder="Ár">
                                
                            </div>
                        </div>
                    </div>
                    <div class="item-infos">
                        <div class="details">
                            <input type="submit" value="Feltölt" class="btn-login" name="upload">
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="menu">
                <ul class="ul-li">
                <?php if(isset($_SESSION["UserName"])){?>
                    <li><a href="index.php"><?php echo $_SESSION["UserName"] ?></a></li> 
                    <li><a href="watch.php">Hírdetéseim</a></li>
                    <li><a href="upload.php">Feladás</a></li>
                    <li><a href="message.php">Üzenetek</a></li>
                    <li><a href="settings.php">Beállítások</a></li>
                    <li><a  href="includes/logout.php">Kilépés</a></li>
                <?php }?>
                </ul>
            </div>
        </main>
        <script src="js/upload.js"></script>
</body>
</html>