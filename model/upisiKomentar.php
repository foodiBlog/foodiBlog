<?php
session_start();
    require_once "konekcija.php";

    if(isset($_POST['postavi'])){
        $idPosta=$_POST['idPosta'];
        $komentar=$_POST['komentar'];
        $poruka= $idPosta;

        $korisnik=$_SESSION['korisnik'];
        $korisnikId=$korisnik['idKorisnika'];

        
        if(count($komentar)<=4){
            $poruka="Comment must contain more than 5 words";
            $kod=200;
        }
        else{

            $insert="INSERT INTO komentari VALUES (NULL,:tekst,:datum,:idKorisnika,:idPosta)";

            $datum=date("Y-m-d H:i:s");
            $komentar=implode($komentar," ");
            $priprema=$konekcija->prepare($insert);
            $priprema->bindParam(":tekst",$komentar);
            $priprema->bindParam(":datum",$datum);
            $priprema->bindParam(":idKorisnika",$korisnikId);
            $priprema->bindParam(":idPosta",$idPosta);
    
            try{
                $priprema->execute();
                $poruka="Success";
                $kod=201;
            }
            catch(PDOException $e){
                $poruka="Server error";
                $kod=500;
            }
        }


    }
    else{
        $kod=404;
        $poruka="Error";
    }



    
echo json_encode($poruka);
http_response_code($kod);
?>