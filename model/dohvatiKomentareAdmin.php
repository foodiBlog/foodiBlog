<?php

    require_once "konekcija.php";

    $data="";
    $upit="SELECT p.naslov,k.*,ko.*,k. datum AS datumKomentara FROM komentari k INNER JOIN korisnici ko ON ko.idKorisnika=k.idKorisnika INNER JOIN postovi p on k.idPosta=p.idPosta ORDER BY p.idPosta";

    
    try{  
        $kategorije=$konekcija->query($upit)->fetchAll();
        $data=$kategorije;
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }

    
echo json_encode($data);
http_response_code($code);
?>