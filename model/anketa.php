<?php
    require_once "konekcija.php";

    $upit="SELECT * FROM anketa WHERE aktivna=1";

    
    $idOdg=0;

    try{  
        $rez=$konekcija->query($upit);
        $anketa=$rez->fetch();
        $code=200;
        $idAnkete=$anketa['idAnkete'];
        $odgovori="SELECT * FROM odgovori WHERE idAnkete=:id";
        $priprema=$konekcija->prepare($odgovori);
        $priprema->bindParam(":id",$idAnkete);
        try{
            $priprema->execute();
            $odg=$priprema->fetchAll();
            if(isset($_SESSION['korisnik'])){
                $korisnik=$_SESSION['korisnik'];
                $idKorisnika=$korisnik['idKorisnika'];
                $odgovor="SELECT * FROM odgovoriAnketa WHERE idKorisnika=:id AND idAnkete=:idAnketa";
                $priprema2=$konekcija->prepare($odgovor);
                $priprema2->bindParam(":id",$idKorisnika);
                $priprema2->bindParam(":idAnketa",$idAnkete);
                try{
                    $priprema2->execute();
                    if($priprema2->rowCount()==1){
                        $red=$priprema2->fetch();
                        $idOdg=$red['idOdgovora'];
                    }
                }
                catch(PDOException $e){
                    echo "Server error";
                }
            }

        }
        catch(PDOException $e){
            echo "Server error";
        }
    }
    catch(PDOException $e){
        $code=500;
        echo "Server error";
    }
    


?>