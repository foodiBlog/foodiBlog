<?php

    require_once "konekcija.php";

if(isset($_POST["posaljiRecept"])){
    $kod=200;
    $naslov=$_POST["naslov"];
    $tekst=$_POST["tekst"];
    

    $regNaslov="/^[\w\s]+$/";
    $greska=0;
    if(!preg_match($regNaslov,$naslov)){
        $greska++;
        $data="Title must begin with a capital letter";
    }
    if(count($tekst)<=50){
        $greska++;
        $data="Recipe must contain more than 50 words";
    }
    if($greska==0){
        $tekst=implode(" ",$tekst);
        $insert="INSERT INTO posaljiRecept VALUES(null,:title,:tekst)";
        $priprema=$konekcija->prepare($insert);
        $priprema->bindParam(":title",$naslov);
        $priprema->bindParam(":tekst",$tekst);
        try{
            $priprema->execute();
            $poruka="Recipe sent";
            $kod=201;
        }
        catch(PDOException $e){
            $poruka="Server error";
            $kod=500;
            zabeleziGresku($e);
        }
    }
}
else{
    $kod=404;
}

echo json_encode($poruka);
http_response_code($kod);
?>