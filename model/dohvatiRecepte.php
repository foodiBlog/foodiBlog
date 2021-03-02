<?php
    require_once "konekcija.php";

    $data="";
    $poruka="";

    

    $idKategorije=0;
    $strana=1;
    if(isset($_GET['category'])){

        
        $idKategorije=$_GET['category'];
        
        $nazivKat="SELECT * FROM kategorije WHERE idKategorije=:id";
        $priprema3=$konekcija->prepare($nazivKat);
        $priprema3->bindParam(":id",$idKategorije);
        try{
            $priprema3->execute();
            if($priprema3->rowCount()==0){
                $poruka="There is no match";
            }
            $kategorija=$priprema3->fetch();
            $naslov=$kategorija['naziv'];
        }
        catch(PDOException $e){
            $code=500;
            $poruka="Server error";
        }
        
        $dohvatiSve="SELECT * FROM postovi WHERE idKategorije=:id";

        
        if(isset($_GET['search'])){
            $search=$_GET['search'];
            $dohvatiSve.=" AND naslov LIKE '%$search%'";

        }
        //var_dump($dohvatiSve);


        $priprema2=$konekcija->prepare($dohvatiSve);
        $priprema2->bindParam(":id",$idKategorije);
    }
    else{
        $dohvatiSve="SELECT * FROM postovi";
        if(isset($_GET['search'])!=""){
            $search=$_GET['search'];
            //$poruka=$search;
            $dohvatiSve.=" WHERE naslov LIKE '%$search%'";
        }
    }


    try{
        if(isset($_GET['category'])){
            $priprema2->execute();
            if($priprema2->rowCount()==0){
                $poruka="There is no match";
            }
            $rez=$priprema2->fetchAll();
            $ukupno=$priprema2->rowCount();  
        }
        else{
            $svi=$konekcija->query($dohvatiSve);
            $ukupno=$svi->rowCount();
            
            if($ukupno==0){
                $poruka="There is no match";
            }
            $naslov="Recipes";
        }



        
        $offset=0;
        $limit=4;

        $brojStrana=ceil($ukupno/$limit);
        

        $upit="SELECT p.*,ROUND(AVG(o.ocena)) AS ocena FROM postovi p LEFT JOIN ocena o on p.idPosta=o.idPosta ";

        

        if(isset($_GET['category'])){
            $upit.="WHERE p.idKategorije=:id";
        }
        if(isset($_GET['search'])!=""){
            $search=$_GET['search'];
            if(isset($_GET['category'])){
                $upit.="  AND naslov LIKE '%$search%'";
                $echo="TU";
                //var_dump($upit);
            }
            else{
                $upit.="WHERE naslov LIKE '%$search%'";
            }

        }
        
        $upit.=" GROUP BY p.naslov LIMIT :limitVrednost OFFSET :offsetVrednost";
        


        $priprema=$konekcija->prepare($upit);

        if(isset($_GET['category'])!=0){
            $priprema->bindParam(":id",$_GET['category']);
        }
        if(isset($_GET['page'])){
            $strana=$_GET['page']-1;
            $offset=$strana*$limit;
        }
        
        $priprema->bindParam(":limitVrednost",$limit,PDO::PARAM_INT);
        $priprema->bindParam(":offsetVrednost",$offset,PDO::PARAM_INT);


        //var_dump($upit);
        try{  
            $priprema->execute();
            $data=$priprema->fetchAll();
            if($priprema->rowCount()==0){
                $poruka="There is no match";
            }

        }
        catch(PDOException $e){
            $code=500;
            $poruka=$e;
        }
    }
    catch(PDOException $e){
        $poruka=$e;
        $code=500;
    }



    
?>