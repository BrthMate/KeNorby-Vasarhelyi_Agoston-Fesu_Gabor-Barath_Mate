<?php require_once "includes/watch.php";
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
        <link rel="stylesheet" href="css/watch.css">
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
                    <div class="items-container">
                        <div class="sorted">
                            <button type="submit" class="view"><i class='bx bxs-grid' ></i></button>
                            <div class="sorted-container">
                                <button type="submit" class="sort"><i class='bx bxs-sort-alt'></i></button>
                                <ul id=sorted-items class="sorted-items">
                                    <form action="" method="post" class="sorted-option">
                                        <button name="sorted" value="priceAsc"><li>Ár szerint növekvő</li></button>
                                        <button name="sorted" value="priceDesc"><li>Ár szerint csökkenő</li></button>
                                        <button name="sorted" value="dateAsc"><li>Dátum szerint növekvő</li></button>
                                        <button name="sorted" value="dateDesc"><li>Dátum szerint csökkenő</li></button>
                                        <button name="sorted" value="popularity"><li>Népszerűség szerint</li></button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                        <div class="items">
                            <div class="container">
                                <div class="row">
                                    <?php foreach ($items as $key => $value) {?>
                                        <div class="col-12 col-xl-3 mb-3 col-md-4   ">
                                            <div class="card">
                                            <div class="trash">
                                                <form action="includes/delete.php" method="Post">
                                                    <input  type="hidden" name="id" value="<?php echo $value['Id'] ?>"/>
                                                    <button ><i class='bx bxs-trash'></i></button>
                                                </form>
                                            </div>
                                                <img src="<?php echo $value['Img'] ?>" class="card-img-top" alt="<?php echo $value['Img'] ?>">
                                                <div class="card-body">
                                                <h5 class="card-title"><?php echo $value['Title'] ?></h5>
                                                <div class="card-text">
                                                    <div class="card-text-main">
                                                        <p><?php echo $value['Price'] ?>Ft</p>
                                                        <p><?php echo $value['District'] ?></p>
                                                    </div>
                                                    <?php echo $value['Type'] ?>
                                                    <div class="text"><?php echo $value['Description'] ?></div>
                                                    
                                                </div>
                                                <a href="item.php?id=<?php echo $value['Id'] ?>" class="card-btn">Megtekint</a>
                                                <a href="modification.php?id=<?php echo $value['Id'] ?>" class="card-btn">Módosít</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
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
        <script src="js/watch.js"></script>

</body>
</html>