<?php

    require_once "konekcija.php";


    
    if(isset($_POST['dugme'])){
        $poruka="";
        $kod=200;
        @$slika=$_FILES['slika'];

        @$tmpName=$slika['tmp_name'];
        @$size=$slika['size'];
        @$tip=$slika['type'];
        @$name=$slika['name'];
        //var_dump($tmpName);
        @$naziv=time().$name;
        @$putanja="../assets/images/$naziv";


    
        $naslov= $_POST['naslov'];
        $uvod= $_POST['uvod'];
        $tekst= $_POST['tekst'];
        $kat= $_POST['kat'];
        $datum=date("Y-m-d H:i:s");

        $greske=0;

        $regNaslov="/^[A-Z][a-z]+(\s[A-Z][a-z]+)+$/";
        $regUvod=explode(" ",$uvod);
        $regTekst=explode(" ",$tekst);

        if(!preg_match($regNaslov,$naslov)){
            $poruka="Name must begin with capital letter and have 2 words minimum (every word have capital letter(only capital))";
            $greske++;
        }
        if(count($regUvod)<15){
            $poruka="Introductory text must begin with capital letter and have 15 words minimum";
            $greske++;
        }
        if(count($regTekst)<50){
            $poruka="Text must begin with capital letter and have 50 words minimum";
            $greske++;
        }
        if($kat==0){
            $poruka="You have to choose category";
            $greske++;
        }
        if(@!$_FILES['slika']){
            $poruka="You have to choose image";
            $greske++;
        }

        if($greske==0){
            
        $rezultat=move_uploaded_file($tmpName,$putanja);
        if(!$rezultat){
            $poruka="Error";
            $kod=200;
        }
        else{
            $upit="INSERT INTO postovi VALUES (null, :naslov, :tekst, :datum, :idKat, :slika, :uvod)";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam("naslov",$naslov);
            $priprema->bindParam("tekst",$tekst);
            $priprema->bindParam("datum",$datum);
            $priprema->bindParam("idKat",$kat);
            $priprema->bindParam("slika",$naziv);
            $priprema->bindParam("uvod",$uvod);
            try{
                $priprema->execute();
                $poruka="Recipe successfully added";
                $kod=201;
            }
            catch(PDOException $e){
                $poruka="Server error";
                $kod=500;
            }
        }
        }


    }
    else{
        $kod=404;
        $poruka="Sorry bit the page you are looking for does not exist, have been removed or you have to log in.";
    }


    
echo json_encode($poruka);
http_response_code($kod);
?>