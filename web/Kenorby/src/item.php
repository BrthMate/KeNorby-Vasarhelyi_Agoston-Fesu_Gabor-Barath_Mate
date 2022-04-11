<?php
require_once "includes/item.php";
if($_SESSION["UserName"] == null){
    header("location: index.php"); 
}
$_SESSION["Allow"] = CheckAllow($pdo,$_SESSION["UserName"])["Allow"];
if($_SESSION["Allow"] == 1){
    require_once "includes/logout_mainPage.php";
}
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
        <link rel="stylesheet" href="css/item.css">
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
            <div class="container">
                <div class="container-item">
                    <div class="big-image">
                        <?php foreach ($item as $key => $value){?>
                            <img class="bannner-img" src="<?php echo $value["Img"];?>" alt="<?php echo $value["Img"];?>">
                        <?php }?>
                    </div>
                    <div class="images-container-outer">
                        <div class="images-container-inner">
                            <div class="images">
                            <?php foreach ($imgs as $key => $value){?>
                                <img class="other-images" src="<?php echo $value["Img"];?>" alt="<?php echo $value["Img"];?>">
                            <?php }?>
                            </div>
                        </div>
                        <i class='bx bxs-right-arrow'></i>
                    </div>
                </div>
                <div class="container-item-details">
                <?php foreach ($item as $key => $value){?>
                    <div class="seller">
                        <h2>Kapcsolat felvétel</h2>
                        <div class="seller-details">
                            <div class="name">
                                <p><?php echo $value["UserName"]?></p>
                            </div>
                            <div class="active">
                                <span>Legutoljára aktív:<?php echo $value["Date"]?></span>
                            </div>
                            <div class="phone">
                                <p>Telefonszám: <?php echo $value["PhoneNumber"]?></p>
                            </div>
                        </div>
                        <h2>Üzenetet írok</h2>
                        <div class="text-box">
                            <form action="" method="post">
                            <textarea name="mail" id="mail" value="<?php echo $description ?>"></textarea>
                                <input type="submit" name="SendMessage" value="Elküld" class="btn-login">
                            </form>
                        </div>
                    </div>
                <?php }?>
                    <div class="items">
                    <?php foreach ($item as $key => $value){?>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Hírdetés neve    
                                </h2>
                                <p><?php echo $value["Title"]?></p>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Kategoria
                                </h2>
                                <table class="table">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Típus</th>
                                        <td><?php echo $value["Type"]?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Méret</th>
                                        <td><?php echo $value["Size"]?> cm</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Hely</th>
                                        <td><?php echo $value["District"]?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Állapot</th>
                                        <td><?php echo $value["Conditions"]?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Márka</th>
                                        <td><?php echo $value["Brand"]?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Leírás
                                </h2>
                                <p class="text"><?php echo $value["Description"]?></p>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Ár
                                </h2>
                                <p class="price"><?php echo $value["Price"]?> Ft</p>
                            </div>
                        </div>
                        <div class="item-infos">
                            <div class="details">
                                <h2>
                                    Helyszín
                                </h2>
                                <iframe src="<?php echo $value["Map"]?>" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    <?php }?>
                    </div>
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
        <script src="js/item.js"></script>
</body>
</html>