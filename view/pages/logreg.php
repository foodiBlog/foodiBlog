<main>

    <div class="naslov naslovPadding">
        <h1>Become our member</h1>
    </div>


    <div id="logreg">
        <div class="logreg">
            <h2>Register</h2>
            <form action="models/login.php" method="post">
                <input type="text" id="ime" placeholder="First name">
                <p id="greskaime"></p>
                <input type="text" id="prezime" placeholder="Last name">
                <p id="greskaprezime"></p>
                <input type="text" id="email" placeholder="E-mail">
                <p id="greskamail"></p>
                <input type="password" id="lozinka" placeholder="Password">
                <p id="greskapass"></p>
                <input type="password" id="lozinkaPonovi" placeholder="Password confirm">
                <p id="greskapassconf"></p>
                <input type="button" value="Register" id="btnReg">
                <p id="greska"></p>
            </form>
        </div>
        <div class="logreg">
            <h2>Log in</h2>
            <form action="">
                <input type="text" id="emailLog" placeholder="E-mail">
                <p id="greskaMailLog"></p>
                <input type="password" id="passLog" placeholder="Password">
                <p id="greskaMailPass"></p>
                <input type="button" value="Log in" id="btnLog">
                <p id="greskaLog"></p>

            </form>
        </div>
    </div>



</main>