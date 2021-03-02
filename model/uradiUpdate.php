<?php

    require_once "konekcija.php";

    if(isset($_POST['dugme2'])){


        $id=$_POST['id'];
        $naslov=$_POST['naslov'];
        $uvod=$_POST['uvod'];
        $tekst=$_POST['tekst'];

        $code=200;
        $greske=0;

        $regNaslov="/^[A-Z][a-z]+\s[A-Z][a-z]+$/";
        $regUvod=explode(" ",$uvod);
        $regTekst=explode(" ",$tekst);

        if(!preg_match($regNaslov,$naslov)){
            $data['poruka']="Name must begin with capital letter and have 2 words minimum";
            $greske++;
        }
        if(count($regUvod)<15){
            $data['poruka']="Introductory text must begin with capital letter and have 15 words minimum";
            $greske++;
        }
        if(count($regTekst)<50){
            $data['poruka']="Text must begin with capital letter and have 50 words minimum";
            $greske++;
        }

        if($greske==0){
            

            if(@$_FILES['slika']!=NULL){
                $slika=$_FILES['slika'];
                $tmpName=$slika['tmp_name'];
                $size=$slika['size'];
                $tip=$slika['type'];
                $name=$slika['name'];
                //var_dump($tmpName);
                $naziv=time().$name;
                $putanja="../assets/images/$naziv";

        
                $rezultat=move_uploaded_file($tmpName,$putanja);

                if($rezultat){
                    $upit="UPDATE postovi SET naslov=:naslov,slikasrc=:slika,tekst=:tekst,pocetniTekst=:pocetni WHERE idPosta=:id";
                    $priprema=$konekcija->prepare($upit);
                    $priprema->bindParam(":slika",$naziv);
                    $data['slika']=$naziv;
                }
                
            }
            else{
                $upit="UPDATE postovi SET naslov=:naslov,tekst=:tekst,pocetniTekst=:pocetni WHERE idPosta=:id";
                $priprema=$konekcija->prepare($upit);
                $data['slika']=$_POST['slikaSrc'];
            }
            $priprema->bindParam(":id",$id);
            $priprema->bindParam(":naslov",$naslov);
            $priprema->bindParam(":tekst",$tekst);
            $priprema->bindParam(":pocetni",$uvod);

            try{  
                $priprema->execute();
                $data['poruka']="Updated successfully";
                $code=200;
            }
            catch(PDOException $e){
                $code=500;
                $data="Server error";
            }
        }


    }
    else{
        $data="Error";
        $code=404;
    }

    
echo json_encode($data);
http_response_code($code);
?>
