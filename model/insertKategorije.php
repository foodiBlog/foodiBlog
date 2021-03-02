<?php

    require_once "konekcija.php";

    $kod=200;
    
        @$slika=$_FILES['slika'];
        $naslov=$_POST['naslov'];


        $greske=0;
        $regNaslov="/^[A-Z][a-z]+(\s[a-z]+)*$/";
        if(@!$_FILES['slika']){
            $poruka="You have to choose image";
            $greske++;
        }
        if(!preg_match($regNaslov,$naslov)){
            $poruka="Title must begin with capital letter and have 1 word minimum (other words no capital letter)";
            $greske++;
        }
        if($greske==0){
            
        $tmpName=$slika['tmp_name'];
        $size=$slika['size'];
        $tip=$slika['type'];
        $name=$slika['name'];
        //var_dump($tmpName);
        $naziv=time().$name;
        $putanja="../assets/images/$naziv";

        $rezultat=move_uploaded_file($tmpName,$putanja);
        if(!$rezultat){
            $poruka="Error";
            $kod=200;
        }
        else{
            $upit="INSERT INTO kategorije VALUES (NULL, :naziv, :slika)";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":naziv",$naslov);
            $priprema->bindParam(":slika",$naziv);
            try{
                $priprema->execute();
                $poruka="Category successfully added";
                $kod=201;
            }
            catch(PDOException $e){
                $poruka="Server error";
                $kod=500;
            }
        }

        }

    
echo json_encode($poruka);
http_response_code($kod);
?>