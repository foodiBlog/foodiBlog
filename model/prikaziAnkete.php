<?php

    require_once "konekcija.php";

        $data="";


        $upit="SELECT a.pitanje,o.tekstOdgovora,COUNT(oa.idOdgovora) AS broj from odgovori o LEFT JOIN odgovorianketa oa on o.idOdgovora=oa.idOdgovora INNER JOIN anketa a on o.idAnkete=a.idAnkete GROUP BY o.idOdgovora";
        
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
