<?php

    require_once "konekcija.php";
        
    $upit="SELECT p.*,ROUND(AVG(o.ocena)) AS ocena FROM postovi p LEFT JOIN ocena o on p.idPosta=o.idPosta GROUP BY p.naslov";
    try{
        $data=$konekcija->query($upit)->fetchAll();
        $code=200;
    }
    catch(PDOException $e){
        $data="Server error";
        $code=500;
    }


    
echo json_encode($data);
http_response_code($code);

?>