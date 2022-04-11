<?php
include_once "includes/errors.php";
session_start();
if(isset($_SESSION["UserName"])){
    header("location: kenorby.php");  
}
$error= $_GET['error'] ?? null;
$regerror = $_GET["regerror"] ?? null;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenorby</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="login">
                <div class="logo">
                    <span class="lo">Ke</span><span class="go">Norby</span>
                </div>
                <div class="sign-in-up">
                    <form class="sign-in" method="post" action="includes/login.php">
                        <h4 class="title">Bejelentkezés</h4>
                        <?php if(!empty($error) or !(empty($regerror))){ ?>
                            <div class="<?php if($error == "none" || $error =="EmailSend"){echo "alert alert-success";}else{echo "alert alert-warning ";}?>">
                                <?php echo error($error); ?>
                                <?php if(!empty($regerror)){echo "regisztrációs hiba";}?>
                            </div>
                        <?php }?>
                        <div class="input-field">
                            <input type="text" placeholder="Felhasználónév" id="sendmail" name="Username">
                        </div>
                        <div class="input-field" id="input-field-pass">
                            <input class="password" type="password" name="password" placeholder="Jelszó" id="pass">
                            <i class='bx bx-show-alt'></i>
                            <i id="bx-hide" class='bx bx-hide'></i>
                        </div>
                        <input type="submit" value="Belépés" class="btn-login" id="Button" name="Login">
                        <p class="forget-password">
                            <span class="forget-text">Elfelejtett jelszó?</span>
                            <a class="forget-pass">Katt!</a>
                        </p>
                    </form>

                    <form class="sign-up" method="post" action="includes/regist.php">
                        <h4 class="title">Regisztráció</h4>
                        <?php if(!empty($regerror)){ ?>
                            <div class="<?php if($regerror == "none"){echo "alert alert-success";}else{echo "alert alert-warning";}?>">
                                <?php echo regerror($regerror); ?>
                            </div>
                        <?php }?>
                        <div class="input-field">
                            <input type="email" placeholder="E-mail cím" name="Email">
                        </div>
                        <div class="input-field">
                            <input type="text" placeholder="Felhasználónév" name="Username">
                        </div>
                        <div class="input-field">
                            <input class="password" type="password" placeholder="Jelszó" id="SignUpPass" name="Password">
                            <i class='bx bx-show-alt' id='show-sign-up'></i>
                            <i class='bx bx-hide' id="hide-sign-up"></i>
                        </div>
                        <input type="submit" value="Regisztráció" class="btn-login"  name="Regist">
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="left-panel-content">
                    <h3>Regisztrálj</h3>
                    <p> when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <a class="btn transparent" id="sign-in-btn"><i class='bx bx-right-arrow-alt'></i></a>
                </div>
                    <div class="img-container">
                        <img src="img/bike2.svg" class="image" alt="" />
                    </div>
            </div>
            <div class="panel right-panel">
                <div class="right-panel-content">
                    <h3>Belépés</h3>
                    <p> when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <a class="btn transparent" id="sign-up-btn"><i class='bx bx-left-arrow-alt'></i></a>
                </div>
                <div class="img-container">
                    <img src="img/bike2.svg" class="image" alt="" />
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>