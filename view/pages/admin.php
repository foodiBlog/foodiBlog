<div id="adminDrzac">

    <div id="nav">
        <div>
            <p>FoodeiBlog</p>
            <a href="" data-name="home">Home page</a>
        </div>
        <ul>
            <li>
                <p>Recipes</p>
            </li>
            <li>
                <a href="" data-name="allRecipes">All recipes</a>
            </li>
            <li>
                <a href="" data-name="addNewRecipe">Add new</a>
            </li>
            <li>
                <a href="" data-name="sent">Sent</a>
            </li>
            <li>
                <p>Categories</p>
            </li>
            <li>
                <a href="" data-name="allCategories">All categories</a>
            </li>
            <li>
                <a href="" data-name="addCategories">Add categories</a>
            </li>
            <li>
                <p>Questionnaire</p>
            </li>
            <li>
                <a href="" data-name="allQuestionnaire">All questionnaires</a>
            </li>
            <li>
                <a href="" data-name="activeQuestionnaire">Active questionnaire</a>
            </li>
            <li>
                <a href="" data-name="addQuestionnaire">Add questionnaire</a>
            </li>
            <li>
                <p>Users</p>
            </li>
            <li>
                <a href="" data-name="users">All users</a>
            </li>
            <li>
                <p>Messages</p>
            </li>
            <li>
                <a href="" data-name="messages">All messages</a>
            </li>
            <li>
                <p>Comments</p>
            </li>
            <li>
                <a href="" data-name="comments">All comments</a>
            </li>
        </ul>
    </div>

    <div id="recepti" class="admin">
        <?php

            $korisnik=$_SESSION['korisnik'];
        
        ?>

        <h1>Hi <?=$korisnik['ime']?></h1>
    </div>

</div>




<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="assets/js/main.js" type="text/javascript"></script>

</body>