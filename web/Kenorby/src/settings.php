<?php
require_once "includes/settings.php";
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
        <link rel="stylesheet" href="css/settings.css">
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
                <div class="member-infos">
                    <div class="details">
                        <h2>
                            Email beállítások
                        </h2>
                        <p class="email"><?php echo $user[0]["Email"]?></p>
                        <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input type="email" placeholder="E-mail cím" name="Email">
                                <input type="submit" value="Módosítás" class="btn-login" name="EmailChange">
                            </div>
                        </form> 
                    </div>
                </div>
                <div class="member-infos">
                    <div class="details">
                        <h2>
                            Felhasználó név beállítások
                        </h2>
                        <p class="name"><?php echo $user[0]["UserName"]?></p>
                        <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input type="text" placeholder="Felhasználónév" name="Name">
                                <input type="submit" value="Módosítás" class="btn-login" name="NameChange">
                            </div>
                        </form> 
                    </div>
                </div>
                <div class="member-infos">
                    <div class="details">
                        <h2>
                            Jelszó beállítások
                        </h2>
                        <p class="phone-number">jelszó</p>
                        <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input class="password" type="password" placeholder="Jelszó újra" id="SignUpPassAgain" name="Password">
                            </div>
                            <div class="input-field">
                                <input class="password" type="password" placeholder="Jelszó" id="SignUpPass" name="NewPassword">
                                <i class='bx bx-show-alt' id='show-sign-up'></i>
                                <i class='bx bx-hide' id="hide-sign-up"></i>
                                <input type="submit" value="Módosítás" class="btn-login" name="PasswordChange">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="member-infos"> 
                    <div class="details">
                        <h2>
                            Telefonszám
                        </h2>
                        <p class="phone-number">
                            <?php if($info[0]["PhoneNumber"]== ""){
                                echo 'telefonszám nincs megadva';
                            }else{
                                echo $info[0]["PhoneNumber"];
                            }?>
                        </p>
                        <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input type="text" placeholder="Telefonszám" name="Number">
                                <input type="submit" value="Módosítás" class="btn-login" name="phoneNChange">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="member-infos">
                    <div class="details">
                        <h2>
                            Cím
                        </h2>
                        <p class="address">
                            <?php if($info[0]["City"]== "" || $info[0]["Street"]== "" || $info[0]["ZipCode"]== 0){
                                echo 'cím nincs megadva';
                            }else{
                                echo $info[0]["ZipCode"]," ",$info[0]["City"],", ",$info[0]["Street"];
                            }?></p>
                         <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input type="text" placeholder="Város" name="City">
                                <input type="submit" value="Módosítás" class="btn-login" name="CityChange">  
                            </div>
                        </form>
                         <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input type="text" placeholder="Írányító szám" name="ZipCode">
                                <input type="submit" value="Módosítás" class="btn-login" name="ZipCodeChange">  
                            </div>
                        </form>
                         <form action="includes/settings.php" method=Post>
                            <div class="input-field">
                                <input type="text" placeholder="Utca" name="Street">
                                <input type="submit" value="Módosítás" class="btn-login" name="StreetChange">  
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
            <div class="menu">
                <ul class="ul-li">
                <?php 
                    if(isset($_SESSION["UserName"])){?>
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
        <script src="js/settings.js"></script>

    </body>
</html>