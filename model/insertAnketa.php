<?php

    require_once "konekcija.php";

        $odg=$_POST['odg'];
        $pitanje=$_POST['pitanje'];

        $data="";
        $code=200;
        $aktivna=0;
        $greske=0;
        $br=1;
        $regPitanje="/^[A-Z][a-z]+\s[a-z]+$/";
        $regOdg="/^[A-Z][a-z]+\s[a-z]+$/";

        if(!preg_match($regPitanje,$pitanje)){
            $data="Question must begin with capital letter and have minimum 2 words(only words)";
            $greske++;
        }
        foreach($odg as $o){
            if(!preg_match($regPitanje,$o)){
                $data="Answer must begin with capital letter and have minimum 2 words, answer <span class='crveno'> $br </span> is not well formated (only words)";
                $greske++;
            }
            $br++;
        }

        if($greske==0){

            $upit="INSERT INTO anketa VALUES (null,:pitanje,:aktivna)";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":pitanje",$pitanje);
            $priprema->bindParam(":aktivna",$aktivna);
            
            try{  
                $priprema->execute();
                $id=$konekcija->lastInsertId();
                foreach($odg as $o){
                    $upit2="INSERT INTO odgovori VALUES (null,:tekst,:idAnkete)";
                    $priprema2=$konekcija->prepare($upit2);
                    $priprema2->bindParam(":tekst",$o);
                    $priprema2->bindParam(":idAnkete",$id);
                    try{
                        $priprema2->execute();
                        $data="Questionnaire added";
                        $code=201;
                    }
                    catch(PDOException $e){
                        $code=500;
                        $data="Server error";
                    }
                }
            }
            catch(PDOException $e){
                $code=500;
                $data="Server error";
            }
        }

    
echo json_encode($data);
http_response_code($code);
?>
