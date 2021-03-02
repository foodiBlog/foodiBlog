<?php

    require_once "konekcija.php";

    if(isset($_POST['rez'])){
        $idAnkete=$_POST['anketa'];
        $upit="SELECT o.tekstOdgovora,COUNT(oa.idOdgovora) AS broj from odgovori o INNER JOIN odgovorianketa oa on o.idOdgovora=oa.idOdgovora WHERE o.idAnkete=:id GROUP BY o.tekstOdgovora";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$idAnkete);
        try{
            $priprema->execute();
            if($priprema->rowCount()!=0){
                $data=$priprema->fetchAll();
                $code=200;
            }
        }
        catch(PDOException $e){
            $code=500;
            $data="Server error";
        }
    }
    else{
        $data="Error";
        $code=404;
    }

    
echo json_encode($data);
http_response_code($code);
?>