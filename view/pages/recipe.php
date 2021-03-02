<main>

    <?php
        include "model/dohvatiRecept.php";
        include "model/dohvatiKomentare.php";

    ?>
        <div class="naslov naslovPadding">
        <h1>
        <?php
            if($poruka!=""){
                echo $poruka;
            }
            else{
                echo $data['naslov'];
            }
        ?>
        </h1>
        </div>
    
    <?php
        if($poruka==""):
    ?>
    <div id="receptJedan">
        
        <div class="blok">
            <img src="assets/images/<?=$data['slikasrc']?>" alt="<?=$data['naslov']?>">
        </div>
        
        <div class="blok tekst">
            <p><?=$data['pocetniTekst']?></p>
            <h2>Prepare:</h2>
            <p><?=$data['tekst']?></p>
        </div>
    </div>
    <div id="komentariOcene">
        <div id="komentari">
            <h2>Comments</h2>
            <?php
            if($komentar!=''):
                foreach($komentar as $k):
            ?>
                <div class="komentar">
                    <h3><?=$k['ime']?> <?=$k['prezime']?></h3>
                    <p><?=$k['tekst']?></p>
                    <p><?=$k['datumKomentara']?></p>
                </div>
            <?php
               endforeach;
            else:
            ?>
            <p>No comments yet!</p>
            <?php
            endif;
            ?>
            <div>
                <?php
                    if(isset($_SESSION['korisnik'])):
                ?>
                <h3>Your comment:</h3>
                <form action="">
                    <textarea id="komentarTekst"></textarea>
                    <input type="hidden" id="idRecepta" value="<?=$_GET['id']?>">
                    <input type="button" value="Send" id="sendBtn">
                </form>
                <p id="porukaKomentar" class="crveno"></p>
                <?php
                    else:
                ?>
                    <h3 class="crveno comm">Sign in to post a comment!</h3>
                <?php
                    endif
                ?>
            </div>
        </div>
        <div id="oceni">
            <?php
                if(isset($_SESSION['korisnik'])):
            ?>
                <h2>Your rate</h2>
            <?php
                else:
            ?>
                <h2>Log in to rate</h2>
            <?php
                endif;
            ?>

            <?php
                for($i=0;$i<5;$i++):
                    if($i<$ocena):
            ?>
                    <i class="fas fa-star" data-recept="<?=$data['idPosta']?>" data-ocena="<?=$i+1?>"></i>
            <?php
                    else:
            ?>
                    <i class="far fa-star" data-recept="<?=$data['idPosta']?>" data-ocena="<?=$i+1?>"></i>
            <?php
                    endif;
                endfor;
            ?>
            <p id="greskaOcena"></p>
        </div>
    </div>
    <?php
        endif;
    ?>
</main>