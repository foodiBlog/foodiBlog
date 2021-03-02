<?php

    require_once "konekcija.php";

    $data="";
    $upit="SELECT * FROM postovi ORDER BY datum DESC LIMIT 2";

    
    try{  
        $postovi=$konekcija->query($upit)->fetchAll();
        $data=$postovi;
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }

    
echo json_encode($data);
http_response_code($code);
?>