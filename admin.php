<?php


    require_once "view/fixed/head.php";


    if(isset($_SESSION['korisnik'])){
        $korisnik=$_SESSION['korisnik'];
        if($korisnik['idUloge']=="1"){
            include "view/pages/admin.php";
        }
        else{
            include "error.php";
        }
    }
    else{
        include "error.php";
    }


?>

