<?php


    require_once "view/fixed/head.php";

    require_once "view/fixed/header.php";

    if(!isset($_SESSION['korisnik'])){
        require_once "view/pages/logreg.php";
    }
    else{
        require_once "view/pages/error.php";
    }

    require_once "view/fixed/footer.php";


?>