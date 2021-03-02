<?php
  
    require_once "konekcija.php";
    $data;
    $poruka="";

    if(isset($_GET['id'])){
        

        $receptId=$_GET['id'];
        $upit="SELECT * FROM postovi WHERE idPosta=:id";
        
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$receptId);
        try{
            $priprema->execute();
            $rezultat=$priprema->fetch();
            $code=200;
            if($priprema->rowCount()==1)
            {
                $data= $rezultat;
                $ocena=0;
                if(isset($_SESSION['korisnik'])){
                    $korisnik=$_SESSION['korisnik'];
                    $idKorisnika=$korisnik['idKorisnika'];


                    $dohvatiOcenu="SELECT o.ocena FROM ocena o INNER JOIN korisnici k ON o.idKorisnika=k.idKorisnika WHERE o.idKorisnika=:idKorisnik AND o.idPosta=:idPost";

                    $priprema2=$konekcija->prepare($dohvatiOcenu);
                    $priprema2->bindParam(":idKorisnik",$idKorisnika);
                    $priprema2->bindParam(":idPost",$receptId);
                    try{
                        $priprema2->execute();
                        $rez=$priprema2->fetch();
                        $ocena=$rez['ocena'];
                        
                    }
                    catch(PDOException $e){
                        $data="Server error";
                    }

                }
            }
            else{
                $poruka="There is no match";
                $code=404;
            }
        }
        catch(PDOException $e){
            $data="Server error";
            $code=500;
            
        }
    }
    else{
        $data="Server error";
        $code=404;
    }

    
?>