<?php
require_once "includes/kenorby.php";
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
    <link rel="stylesheet" href="css/kenorby.css">
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
            <div class="search">
                <form action="" method="get">
                    <div class="search-items">
                        <div class="input-field">
                            <input type="text" placeholder="Keres" name="search" value="<?php echo $keyword ?>"><button type="submit"><i class='bx bx-search'></i></button>
                        </div>
                    </div>
                </form>
                <div class="search-rest">
                    <form action="" method="get">
                        <div class="category">
                            <h4>Kategória</h4>
                            <div class="check-boxs">
                                <?php foreach ($types as $item) {?>  
                                    <label class="container"><?php echo $item["Type"] ?>
                                        <input type="checkbox" name="type[]" value="<?php echo $item["Id"]?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="size">
                            <h4>Méret</h4>
                            <div class="check-boxs">
                                <?php foreach ($sizes as $item) {?>  
                                    <label class="container"><?php echo $item["Size"] ?> cm
                                        <input type="checkbox" name="size[]" value="<?php echo $item["Id"]?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="price">
                            <h4>Ár</h4>
                                <div class="multi-range-slider">
                                    <input type="range" id="input-left" min="<?php echo $MinPrice[0]["Price"];?>" max= "<?php echo $MaxPrice[0]["Price"];?>" value="<?php echo $MinPrice[0]["Price"];?>" step="1" onChange="setLeftValue(this.value)" onmousemove="setLeftValue(this.value)">
                                    <input type="range" id="input-right" min="<?php echo $MinPrice[0]["Price"];?>" max="<?php echo $MaxPrice[0]["Price"];?>" value="<?php echo $MaxPrice[0]["Price"];?>" step="1" onChange="setRightValue(this.value)" onmousemove="setRightValue(this.value)">
                            
                                    <div class="slider">
                                        <div class="track"></div>
                                        <div class="range"></div>
                                        <div class="thumb left"></div>
                                        <div class="thumb right"></div>
                                    </div>
                                </div>
                                <div class="rangeValue">
                                    <input  id="rangeValuemin" name="rangeValuemin"/>
                                    <input  id="rangeValuemax" name="rangeValuemax"/>
                                </div>
                                
                        </div>
                        <div class="where">
                            <h4>Hol</h4>
                            <div class="check-boxs">
                                <?php foreach ($districts as $item) {?>  
                                    <label class="container"><?php echo $item["District"]?>
                                        <input type="checkbox"name="district[]" value="<?php echo $item["Id"]?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?php } ?>
                            </div>
                            <div class="button">
                                <button type="submit">Keres</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                    <button type="submit" class="filter"><i class='bx bxs-filter-alt' ></i></button>
                </div>
                <div class="items">
                    <div class="container">
                        <div class="row">
                            <?php foreach ($items as $key => $value) {?>
                                <div class="col-12 col-xl-3 mb-3 col-md-4   ">
                                    <div class="card">
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
                <!--<li><a href="#">Bejelentkezés</a></li>--->
            </ul>
        </div>
    </main>
    <script src="js/kenorby.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>