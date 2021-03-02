<?php
session_start();
    require_once "konekcija.php";
    if(isset($_POST['klik'])){
        if(isset($_SESSION['korisnik'])){
            $ocena=$_POST['ocena'];
            $korisnik=$_SESSION['korisnik'];
            $idKorisnik=$korisnik['idKorisnika'];
            $recept=$_POST['recept'];
            $upit="SELECT * FROM ocena WHERE idKorisnika=:id AND idPosta=:idpo";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":id",$idKorisnik);
            $priprema->bindParam(":idpo",$recept);
            try{
                $priprema->execute();
                $rezultat=$priprema->fetch();
                if($rezultat){
                    $update="UPDATE ocena SET ocena=:ocena WHERE idKorisnika=:id AND idPosta=:idpo";
                    $priprema2=$konekcija->prepare($update);
                    $priprema2->bindParam(":ocena",$ocena);
                    $priprema2->bindParam(":id",$idKorisnik);
                    $priprema2->bindParam(":idpo",$recept);
                    try{
                        $priprema2->execute();
                        $poruka='Thanks for rating';
                        $kod=204;
                    }
                    catch(PDOException $e){
                        $poruka="Server error";
                        $kod=500;
                    }
                }
                else{
                    //insert
                    $insert="INSERT INTO ocena VALUES(null,:idpo,:idkor,:ocena)";
                    $priprema3=$konekcija->prepare($insert);
                    $priprema3->bindParam(":ocena",$ocena);
                    $priprema3->bindParam(":idkor",$idKorisnik);
                    $priprema3->bindParam(":idpo",$recept);
                    try{
                        $priprema3->execute();
                        $poruka='Thanks for rating';
                        $kod=201;
                    }
                    catch(PDOException $e){
                        $poruka="Server error";
                        $kod=500;
                    }
                }
            }
            catch(PDOException $e){
                $poruka="Server error";
                $kod=500;
                zabeleziGresku($e);
            }
        }
        else{
            $poruka="Log in to rate";
            $kod=200;
        }
    }



echo json_encode($poruka);
http_response_code($kod);
?>