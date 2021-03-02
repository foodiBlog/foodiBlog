<?php

    include "model/dohvatiRecepte.php";
?>

<main>

    <div class="naslov naslovPadding">
        <h1><?=$naslov?></h1>
    </div>
    
    <div id="drzacSearch">
        <form action="<?php

        $url=$_SERVER['PHP_SELF'];


        if(isset($_GET['page'])){
            $url.="?page=".$_GET['page'];
        }
        if(isset($_GET['category'])){
            $url.="&category=".$_GET['category'];
        }

        echo $url;
        
        ?>" method="get">

       
            <input type="text" name="search" placeholder="Search" 
            <?php
        
            if(isset($_GET['search'])):
        
            ?>
               value="<?=$_GET['search']?>"
            <?php
                endif;
            ?>
            >
        <?php
            if(isset($_GET['page'])):
                    $page=1;
        ?>
            <input type='hidden' name='page' value='<?=$page?>'>
        <?php
            endif;

            if(isset($_GET['category'])):
        ?>
            <input type='hidden' name='category' value='<?=$_GET['category']?>'>
        <?php
            endif;
        ?>


            <button type="submit" id="btnSearch"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div id="recepti">

    <?php
        if($poruka):
    ?>
        <h2><?=$poruka?></h2>
    <?php
        else:
        foreach($data as $d):
    ?>
        <div class='recept'>
            <div class="slikaRecept"><img src="assets/images/<?=$d['slikasrc']?>" alt="<?=$d['naslov']?>"/></div>
            <div class='tekst'>
                <h3><?=$d['naslov']?></h3>
                <div class='zvezdice'>
            <?php
                $ocena=$d['ocena'];
                for($i=0;$i<5;$i++):
                    if($i<$ocena):
                ?>
                    <i class="fas fa-star"></i>
                <?php
                    else:
                ?>
                    <i class="far fa-star"></i>
                <?php
                    endif;
                endfor;
            ?>
                </div>
                
            <a class="receptLink" href="recipe.php?id=<?=$d['idPosta']?>" data-id=<?=$d['idPosta']?>>Look recipe</a>
            </div>
        </div>
    <?php
        endforeach;
    endif;
    ?>

    <?php
        if(!$poruka):
    ?>

    <div id="stranicenje">
    <?php
        if(isset($_GET['page'])){
            $trenutna=$_GET['page'];
        }
        else{
            $trenutna=1;
        }
        
        $sledeca=$trenutna+1;
        $prethodna=$trenutna-1;



        if($trenutna==$brojStrana && $brojStrana!=1):
    ?>
        

        <a href="<?php
        $dodatak="";
        if(isset($_GET['category'])){
            $dodatak.='&category='.$_GET['category'];
        }
        if(isset($_GET['search'])){
            $dodatak.='&search='.$_GET['search'];
        }
        
        echo $_SERVER['PHP_SELF']."?page=".$prethodna.$dodatak;

        ?>">Previous</a>

        
        <?php
            $br=0;
            for($i=0;$i<$brojStrana;$i++):
                $br=$i+1

        ?>
            <a href="<?php

            $dodatak="";
            if(isset($_GET['category'])){
                $dodatak.='&category='.$_GET['category'];
            }
            if(isset($_GET['search'])){
                $dodatak.='&search='.$_GET['search'];
            }

            echo $_SERVER['PHP_SELF']."?page=".$br.$dodatak;

            ?>"
            <?php
                if($br==$trenutna){
                    echo "class='trenutna'";
                }
            ?>
            ><?=$i+1?></a>
        <?php
            endfor;
        ?>


    <?php
        elseif($trenutna==1 && $brojStrana!=1):
    ?>
        
        <?php
            $br=0;
            for($i=0;$i<$brojStrana;$i++):
                $br=$i+1
        ?>
            <a href="<?php
            
                $dodatak="";
                if(isset($_GET['category'])){
                    $dodatak.='&category='.$_GET['category'];
                }
                if(isset($_GET['search'])){
                    $dodatak.='&search='.$_GET['search'];
                }
                
                echo $_SERVER['PHP_SELF']."?page=".$br.$dodatak;

            ?>"
            <?php
                if($br==$trenutna){
                    echo "class='trenutna'";
                }
            ?>
            ><?=$i+1?></a>
        <?php
            endfor;
        ?>
        
        <a href="<?php

        $dodatak="";
        if(isset($_GET['category'])){
            $dodatak.='&category='.$_GET['category'];
        }
        if(isset($_GET['search'])){
            $dodatak.='&search='.$_GET['search'];
        }

        echo $_SERVER['PHP_SELF']."?page=".$sledeca.$dodatak;

        ?>">Next</a>

        




    <?php
        elseif($trenutna!=1):
    ?>

        <a href="<?php
        $dodatak="";
        if(isset($_GET['category'])){
            $dodatak.='&category='.$_GET['category'];
        }
        if(isset($_GET['search'])){
            $dodatak.='&search='.$_GET['search'];
        }
        
        echo $_SERVER['PHP_SELF']."?page=".$prethodna.$dodatak;
        ?>">Previous</a>


        <?php
            $br=0;
            for($i=0;$i<$brojStrana;$i++):
                $br=$i+1
        ?>
            <a href="<?php

                            
                $dodatak="";
                if(isset($_GET['category'])){
                    $dodatak.='&category='.$_GET['category'];
                }
                if(isset($_GET['search'])){
                    $dodatak.='&search='.$_GET['search'];
                }

                echo $_SERVER['PHP_SELF']."?page=".$br.$dodatak;


            ?>"
            <?php
                if($br==$trenutna){
                    echo "class='trenutna'";
                }
            ?>
            
            ><?=$i+1?></a>
        <?php
            endfor;
        ?>

        <a href="<?php
        $dodatak="";
        if(isset($_GET['category'])){
            $dodatak.='&category='.$_GET['category'];
        }
        if(isset($_GET['search'])){
            $dodatak.='&search='.$_GET['search'];
        }
        
        echo $_SERVER['PHP_SELF']."?page=".$sledeca.$dodatak;
        ?>">Next</a>  

    <?php
        endif;


    ?>




<?php
        if($brojStrana==1):
    ?>


        <?php
            $br=0;
            for($i=0;$i<$brojStrana;$i++):
                $br=$i+1
        ?>
            <span>Page</span>
            <a href="<?php

                $dodatak="";
                if(isset($_GET['category'])){
                    $dodatak.='&category='.$_GET['category'];
                }
                if(isset($_GET['search'])){
                    $dodatak.='&search='.$_GET['search'];
                }
                
                echo $_SERVER['PHP_SELF']."?page=".$br.$dodatak;

            ?>"
            <?php
                if($br==$trenutna){
                    echo "class='trenutna'";
                }
            ?>
            
            ><?=$i+1?></a>
        <?php
            endfor;
        ?>

    <?php
        endif;


    ?>
    </div>

    <?php
        endif;
    ?>

</main>