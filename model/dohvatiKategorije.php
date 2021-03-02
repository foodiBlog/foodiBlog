<?php

    require_once "konekcija.php";

    $data="";
    $upit="SELECT * FROM kategorije";

    
    try{  
        $kategorije=$konekcija->query($upit)->fetchAll();
        $data=$kategorije;
        $code=200;
    }
    catch(PDOException $e){
        $data="Server error";
        $code=500;
    }

    
echo json_encode($data);
http_response_code($code);
?>