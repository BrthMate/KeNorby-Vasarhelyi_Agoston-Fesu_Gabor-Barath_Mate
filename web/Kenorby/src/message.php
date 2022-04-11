<?php
    require_once "includes/message.php";
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
        <link rel="stylesheet" href="css/message.css">
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
                        </div>
                        <div class="main-section">
                            <div class="items">
                                <div class="container">
                                    <div class="row">
                                    <?php foreach ($items as $value) {?>
                                        <form action="" method= "post" >
                                            <div class="col-12">
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
                                                            <input  type="hidden" name="Incoming" class="hidden" value="<?php echo $value['Incoming']; ?>">
                                                            <input  type="hidden" name="inc" class="hidden" value="<?php echo $value['inc']; ?>">
                                                            <input  type="hidden" name="id" class="hidden" value="<?php echo $value["Id"]; ?>">
                                                            <input  type="hidden" name="Title" class="hidden" value="<?php echo $value["Title"]; ?>">
                                                            <input  type="hidden" name="SellerId" class="hidden" value="<?php echo $value["SellerId"];; ?>">
                                                            <button class="card-btn" name="show">Megtekint</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="message-container">
                            <form action="" method="post" class="form" autocomplete="off" onsubmit="return false;">
                                <div class="title">
                                    <h2><?php if(isset($title)){echo $title;}else{echo "Chat";}?></h2>
                                </div>
                                    <div id="textarea">
                                    <?php if(isset($messages)) {?>
                                    <?php foreach($messages as $message) {?>
                                        <?php if($_SESSION["UserId"]==$message['Outgoing']){ ?>
                                            <div class="get">
                                                <p><?php echo $message["Msg"]; ?></p>
                                            </div>
                                            <?php }else{?>
                                            <div class="send">
                                                <p><?php echo $message["Msg"]; ?></p>
                                            </div>
                                            <?php }?>
                                        <?php } ?>
                                    <?php } ?>                                     
                                    </div>
                                <div class="send-message">
                                    <div class="input-field">
                                        <input type="text" class="sendMessageInput" name="description" placeholder="Üzenet" >
                                    </div>
                                    <button type="submit" name="sendmessage" class="btn-login card-btn"><i class='bx bx-send' ></i></button>
                                </div>  
                            </form>  
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
        <script src="js/message.js"></script>
        <script src="js/messageSend.js"></script>
        <script src="js/messageGet.js"></script>

</body>
</html>