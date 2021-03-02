<?php
  
    require_once "konekcija.php";
    $komentar='';

    if(isset($_GET['id'])){
        
        $receptId=$_GET['id'];
        $upit="SELECT k.*,ko.*,k. datum AS datumKomentara FROM komentari k INNER JOIN korisnici ko ON ko.idKorisnika=k.idKorisnika WHERE k.idPosta=:id";


        $priprema=$konekcija->prepare($upit);

        $priprema->bindParam(":id",$receptId);
        try{
            $priprema->execute();
            $rezultat=$priprema->fetchAll();
            if($priprema->rowCount()!=0){
                $komentar= $rezultat;
                $kod=200;
            }
            else{
                $kod=404;
            }
        }
        catch(PDOException $e){
            $kod=500;
            
        }
    }
    else{
        $kod=404;
    }

    
?>