<?php

    require_once "konekcija.php";


        $id=$_POST['id'];
        $naslov=$_POST['naslov'];

        $code=200;

        $greske=0;
        $regNaslov="/^[A-Z][a-z]+(\s[a-z]+)*$/";
        if(!preg_match($regNaslov,$naslov)){
            $data="Title must begin with capital letter and have 1 word minimum";
            $greske++;
        }
        if($id==0){
            $data="You must select which category you want to change";
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
                    $upit="UPDATE kategorije SET naziv=:naziv,slikasrc=:slika WHERE idKategorije=:id";
                    $priprema=$konekcija->prepare($upit);
                    $priprema->bindParam(":slika",$naziv);
                }
                
            }
            else{
                $upit="UPDATE kategorije SET naziv=:naziv WHERE idKategorije=:id";
                $priprema=$konekcija->prepare($upit);
            }
    
            $priprema->bindParam(":id",$id);
            $priprema->bindParam(":naziv",$naslov);
    
            try{  
                $priprema->execute();
                $data="Updated successfully, refresh page to see update";
                $code=200;
            }
            catch(PDOException $e){
                $code=500;
                $data="Server error";
            }
    
        }

    
echo json_encode($data);
http_response_code($code);
?>
