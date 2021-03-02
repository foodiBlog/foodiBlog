<?php

    require_once "model/anketa.php";

?>

<main>

    <div class="naslov naslovPadding">
        <h1>Contact</h1>
    </div>


    <div id="logreg">
        <div id="forma">
            <h2>Get in touch</h2>
            <form action="models/poruka.php" method="post">
                <input type="text" id="email" placeholder="E-mail">
                <p id="greskaMail"></p>
                <input type="text" id="naslov" placeholder="Title">
                <p id="greskaNaslov"></p>
                <textarea id="poruka" placeholder="Message" ></textarea>
                <p id="greskaTekst"></p>
                <input type="button" value="Send" id="btnPoruka">
                <p id="greskaPoruka"></p>
            </form>
        </div>
        <div id="anketa">
            <h2>Questionnaire</h2>
            <h3><?=$anketa['pitanje']?></h3>

            <div>
                <form action="">
                    <input type="hidden" id="idAnkete" value="<?=$anketa['idAnkete']?>">
            <?php
                foreach($odg as $o):
            ?>
            <br>
                <input type="radio" name="odgvori" value="<?=$o['idOdgovora']?>"
                
                <?php
                    if($o['idOdgovora']==$idOdg){
                        echo "checked=true";
                    }
                    if($idOdg!=0){
                        echo "disabled=true";
                    }
                ?>
                > <?=$o['tekstOdgovora']?>

                <br>
            <?php
                endforeach;
            ?>
            <br>
            <input type="button" value="Submit" id="glasaj"
                <?php
                    if($idOdg!=0){
                        echo "disabled=true";
                    }
                ?>
            >
            <input type="button" value="Results" id="rezultatiAnkete">
            <p id="greskaAnketa">

                <?php
                    if($idOdg!=0){
                        echo "You have already voted, look results";
                    }
                ?>

            </p>
            </form>
            </div>
            <div id="ispisRezultata">
            
            </div>
        </div>
    </div>



</main>