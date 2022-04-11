<?php
function error($error){
    if($error == "emptyInput"){
        return "Üres Mező(k)";
        exit;
    }
    if($error == "invalidInputUsername"){
        return "Nem megfelelő felhaszánlónév";
        exit;
    }
    if($error == "invalidinputPassword"){
        return "Nem megfelelő jelszó";
        exit;
    }
    if($error == "invalidInputEmail"){
        return "Nem megfelelő email cím";
        exit;
    }
    if($error == "UserNotExist"){
        return "Nem létezik ilyen felhasználó";
        exit;
    }
    if($error == "stmntfailed"){
        return "Hiba történt probáld ujra";
        exit;
    }
    if($error == "none"){
        return "Sikeres Regisztráció";
        exit;
    }
    if($error == "LoginDate"){
        return "";
        exit;
    }
    if($error == "EmailUpdate"){
        return "";
        exit;
    }
    if($error == "PhoneUpdate"){
        return "";
        exit;
    }
    if($error == "CityUpdate"){
        return "";
        exit;
    }
    if($error == "ZipCode"){
        return "";
        exit;
    }
    if($error == "Street"){
        return "";
        exit;
    }
    if($error == "Password"){
        return "";
        exit;
    }
    if($error == "LoginError"){
        return "Hibás adat";
        exit;
    }
    if($error == "LoginErrorWP"){
        return "Hibás adat";
        exit;
    }
    if($error == "UserBlocked"){
        return "Felhaszánló Blockolva";
        exit;
    }
    if($error == "EmailSend"){
        return "Email sikeresen elküldve";
        exit;
    }
    if($error == "emptySelect"){
        return "Nincs kiválasztva adat a lenyíló listában";
        exit;
    }
    if($error == "emptyInput"){
        return "Üres Mező(k)";
        exit;
    }
    if($error == "UserExist"){
        return "Létezik ilyen felhasználó";
        exit;
    }
    if($error == "notLongEnough"){
        return "Nem elég hosszú";
        exit;
    }
    if($error == "UserAllreadyExist"){
        return "Létezik ilyen felhasználó";
        exit;
    }
    if($error == "passNotMatch"){
        return "A jelszó nem egyezik";
        exit;
    }
    if($error == "InvalidString"){
        return "Nem megfeleő formátum";
        exit;
    }
    if($error == "InvalidInt"){
        return "Nem megfeleő formátum";
        exit;
    }
    if($error == "EmailSendFail"){
        return "Email elküldése sikertelen";
        exit;
    }
    if($error){
        return "Nem kezelt hiba üzenet";
        exit;
    }
    
}
function regerror($error){
    if($error == "emptyInput"){
        return "Üres Mező(k)";
        exit;
    }
    if($error == "invalidInputUsername"){
        return "Nem megfelelő felhaszánlónév";
        exit;
    }
    if($error == "invalidinputPassword"){
        return "Nem megfelelő jelszó";
        exit;
    }
    if($error == "invalidInputEmail"){
        return "Nem megfelelő email cím";
        exit;
    }
    if($error == "UserExist"){
        return "Létezik ilyen felhasználó";
        exit;
    }
    if($error == "notLongEnough"){
        return "Nem megfelelő jelszó";
        exit;
    }
    if($error){
        return "Nem kezelt hiba üzenet";
        exit;
    }
}