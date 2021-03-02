<?php

    require_once "konekcija.php";

        $data="";

        $id=$_POST['id'];

        $upit="UPDATE anketa SET aktivna=0";
        
        try{  
            $konekcija->query($upit);
            $postaviAktivnu="UPDATE anketa SET aktivna=:akt WHERE idAnkete=:id";
            $aktivna=1;
            $priprema=$konekcija->prepare($postaviAktivnu);
            $priprema->bindParam(":id",$id);
            $priprema->bindParam(":akt",$aktivna);
            try{
                $priprema->execute();
                $data="Changed active questionnaire";
                $code=200;
            }
            catch(PDOException $e){
                $data="Server error";
                $code=500;
            }
        }
        catch(PDOException $e){
            $code=500;
            $data="Server error";
        }

    
echo json_encode($data);
http_response_code($code);
?>
