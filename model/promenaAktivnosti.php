<?php

    require_once "konekcija.php";

        $data="";


        $upit="SELECT * FROM anketa";
        
        try{  
            $rez=$konekcija->query($upit)->fetchAll();
            $data=$rez;
            $code=200;
        }
        catch(PDOException $e){
            $code=500;
            $data="Server error";
        }

    
echo json_encode($data);
http_response_code($code);
?>
