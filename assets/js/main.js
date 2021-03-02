$(document).ready(function(){

    var url=location.href;

    

    dohvatiMeni();

    if(url.indexOf("index.php")!=-1){

        dohvatiKategorije();
    
        dohvatiNajnovije();

        dohvatiKomentare();
    }
    if(url.indexOf("recipe.php")!=-1){
        $("#sendBtn").click(posaljiKomentar)
        $("#oceni i").click(oceni)
    }
    if(url.indexOf("logreg.php")!=-1){
        $("#btnReg").click(registruj)
        $("#btnLog").click(uloguj)
    }
    if(url.indexOf("contact.php")!=-1){
        $("#btnPoruka").click(posalji)
        $("#glasaj").click(glasaj)
        $("#rezultatiAnkete").click(rezultati)
    }
    if(url.indexOf("send.php")!=-1){
        $("#btnReceptSend").click(posaljiRecept)
    }
    if(url.indexOf("admin.php")!=-1){
        admin()
    }



})




function dohvatiMeni(){
    $.ajax({
        url:"model/dohvatiMeni.php",
        method:"get",
        dataType:"json",
        success:function(data){
            ispisMeni(data)
        },
        error:function(xhr){
            $("nav").html(JSON.parse(xhr.responseText))
        }
    })
}

function ispisMeni(data){
    let ispis=''
    for (let d of data) {
        ispis+=`<li>
            <a href="${d.putanja}">${d.naziv}</a>
        </li>`
    }
    $("header nav ul").html(ispis)

}



function dohvatiKategorije(){
    $.ajax({
        url:"model/dohvatiKategorije.php",
        method:"get",
        dataType:"json",
        success:function(data){
            ispisiKategorije(data)
        },
        error:function(xhr){
                $("#kategorije").html(JSON.parse(xhr.responseText))
        }
    })
}

function ispisiKategorije(data){
    let ispis=''
    for(let d of data){
        ispis+=`<div class="kategorije">
            <a href="recipes.php?page=1&category=${d.idKategorije}">
            <img src="assets/images/${d.slikasrc}" alt="${d.naziv}">
            <h3>${d.naziv}</h3>
            </a>
        </div>`
    }

    $("#kategorije").html(ispis)
}

function dohvatiNajnovije(){
    $.ajax({
        url:"model/dohvatiNajnovije.php",
        method:"get",
        dataType:"json",
        success:function(data){
            ispisiNajnovije(data)
        },
        error:function(xhr){
                $("#najnovijiPostovi").html(JSON.parse(xhr.responseText))
            
        }
    })
}

function ispisiNajnovije(data){
    console.log(data)
    let ispis=''
    for(let d of data){
        ispis+=`<div class="post">
            <div>
                <img src='assets/images/${d.slikasrc}' alt="${d.naslov}">
            </div>
            <div>
                <h3>${d.naslov}</h3>
            </div>
            <p>${d.pocetniTekst}</p>

            <a href="recipe.php?id=${d.idPosta}">Look recipe</a>
        </div>`
    }

    document.getElementById("najnovijiPostovi").innerHTML+=ispis
}
function dohvatiKomentare(){
    $.ajax({
        url:"model/dohvatiRandomKomentare.php",
        method:"get",
        dataType:"json",
        success:function(kom){
            ispisiKomentare(kom)
        },
        error:function(xhr){
                $("#randomKomentari").html(JSON.parse(xhr.responseText))
            
        }
    })
}

function ispisiKomentare(kom){
    let ispis=''
    for(k of kom){
        ispis+=`<p>${k.tekst}</p>`
    }
    document.getElementById("randomKomentari").innerHTML+=ispis
}

function posaljiKomentar(){
    var idPosta=$("#idRecepta").val()
    var komentar=$("#komentarTekst").val()

    
    komentar=komentar.split(" ")
    if(komentar.length<=4){
        $("#porukaKomentar").html("Comment must have 5 words minimum");
        return false
    }


    $.ajax({
        url:"model/upisiKomentar.php",
        method:"post",
        dataType:"json",
        data:{
            "idPosta":idPosta,
            "komentar":komentar,
            "postavi":true
        },
        success:function(data){
            console.log(data)
            if(data!="Success"){
                ("#porukaKomentar").data
            }
            location.reload()
        },
        error:function(xhr){
            $("#porukaKomentar").html(JSON.parse(xhr.responseText))
            
        }
    })
}

function registruj(){
    var ime=document.getElementById("ime").value;
    var prezime=document.getElementById("prezime").value;
    var mail=document.getElementById("email").value;
    var pass=document.getElementById("lozinka").value;
    var passConf=document.getElementById("lozinkaPonovi").value;

    var regIme=/^[A-Z][a-z]{2,29}$/;
    var regPrezime=/^[A-Z][a-z]{2,39}$/;
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;


    
    var greske=0;
    if(!regIme.test(ime)){
        $("#greskaime").html("First name must begin with a capital letter (maximum 30 characters)");
        greske++;
        
    }
    else{
        $("#greskaime").html("");
    }
    if(!regPrezime.test(prezime)){
        $("#greskaprezime").html("Last name must begin with a capital letter (maximum 40 characters)");
        greske++;
    }
    else{
        $("#greskaprezime").html("");
    }
    if(!regEmail.test(mail)){
        $("#greskamail").html("E-mail format: kristina.mladenovic.5.19@ict.edu.rs or milica@gmail.com");
        greske++;
    }
    else{
        $("#greskamail").html("");
    }
    if(!regPass.test(pass)){
        $("#greskapass").html("Password must be at least 8 characters long");
        greske++;
    }
    else{
        $("#greskapass").html("");
    }
    if(passConf!=pass){
        $("#greskapassconf").html("Passwords do not match");
        greske++;
    }
    else{
        $("#greskapassconf").html("");
    }
    if(greske==0){
        
        $.ajax({
            url:"model/registracija.php",
            method:"post",
            dataType:"json",
            data:{
                ime:ime,
                prezime:prezime,
                email:mail,
                pass:pass,
                passConf:passConf,
                dugme:true
            },
            success:function(data){
                if(data=="There is already a user with that email address"){
                    $("#email").val("")
                    $("#greskamail").html(data)
                }
                else{
                    $("input[type='text']").val("")
                    $("input[type='password']").val("")
                    $("#greska").html(data)
                }
            },
            error:function(xhr){
                if(xhr.status==422){
                    greske=JSON.parse(xhr.responseText)
                    console.log(greske)
                    if(greske.greskaime!=""){
                        $("#greskaime").html(greske.greskaime)
                    }
                    if(greske.greskaime!=""){
                        $("#greskaprezime").html(greske.greskaprezime)
                    }
                    if(greske.greskaime!=""){
                        $("#greskamail").html(greske.greskamail)
                    }
                    if(greske.greskaime!=""){
                        $("#greskapass").html(greske.greskapss)
                    }
                    if(greske.greskaime!=""){
                        $("#greskapassconf").html(greske.greskapassconf)
                    }
                }
                else{
                    $("#greska").html(JSON.parse(xhr.responseText))
                }
            }
        })
    }
}

function uloguj(){
    var mail=document.getElementById("emailLog").value;
    var pass=document.getElementById("passLog").value;

    
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;

    
    if(!regEmail.test(mail)){
        document.getElementById("greskaMailLog").innerHTML="E-mail format: kristina.mladenovic.5.19@ict.edu.rs or milica@gmail.com"
        return false
    }
    else{
        document.getElementById("greskaMailLog").innerHTML=""
    }
    if(!regPass.test(pass)){
        document.getElementById("greskaMailPass").innerHTML="Password must be at least 8 characters long"
        return false
    }
    else{
        document.getElementById("greskaMailPass").innerHTML=""
    }
    $.ajax({
        url:'model/logovanje.php',
        method:"POST",
        dataType:"json",
        data:{
            "mail":mail,
            "pass":pass,
            "dugmeLog":true
        },
        success:function(data){
            if(data==201){
                location.href="index.php"
            }
            else{
                $("#greskaLog").html(data)
            }
        },
        error:function(xhr){
            $("#greskaLog").html(JSON.parse(xhr.responseText))
        }
    })
}


function oceni(){
    var ocena=this.dataset.ocena
    var recept=this.dataset.recept
    $.ajax({
        url:'model/oceni.php',
        method:"POST",
        dataType:"json",
        data:{
            "ocena":ocena,
            "recept":recept,
            "klik":true
        },
        success:function(data){
            if(data!="Log in to rate"){
                location.reload()
                
            }
            $("#greskaOcena").html(data)
        },
        error:function(xhr){
            $("#greskaOcena").html(JSON.parse(xhr.responseText))
        }
    })
}
function posalji(){
    
    var mail=$("#email").val();
    var naslov=$("#naslov").val()
    var poruka=$("#poruka").val()

    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regNaslov=/^[\w\s]+$/;
    var greska=0;
    if(!regEmail.test(mail)){
        $("#greskaMail").html("E-mail format: kristina.mladenovic.5.19@ict.edu.rs or milica@gmail.com");
        greska++;
    }
    else{
        $("#greskaMail").html("")
    }
    if(!regNaslov.test(naslov)){
        $("#greskaNaslov").html("You have to write title");
        greska++;
    }
    else{
        $("#greskaNaslov").html("")
    }
    poruka=poruka.split(" ")
    if(poruka.length<=9){
        $("#greskaTekst").html("Message mus have 10 words minimum");
        greska++;
    }
    else{
        $("#greskaTekst").html("")
    }
    if(greska==0){
        $.ajax({
            url:'model/unesiPoruku.php',
            method:"POST",
            dataType:"json",
            data:{
                "mail":mail,
                "poruka":poruka,
                "naslov":naslov,
                "unesiPitanje":true
            },
            success:function(data){
                $("#greskaPoruka").html(data);
                document.getElementById("email").value=""
                document.getElementById("naslov").value=""
                document.getElementById("poruka").value=""

            },
            error:function(xhr){
                $("#greskaPoruka").html(JSON.parse(xhr.responseText))
            }
        })
    }
}


function posaljiRecept(){
    
    var title=$("#title").val();
    var tekst=$("#tekst").val()

    var regTitle=/^[\w\s]+$/;
    var greska=0;

    if(!regTitle.test(title)){
        $("#greskaNaziv").html("Title must begin with a capital letter");
        greska++;
    }
    else{
        $("#greskaNaziv").html("")
    }
    tekst=tekst.split(" ")
    if(tekst.length<=50){
        $("#greskaTekst").html("Recipe must contain more than 50 words");
        greska++;
    }
    else{
        $("#greskaTekst").html("")
    }
    if(greska==0){
        $.ajax({
            url:'model/posaljiRecept.php',
            method:"POST",
            dataType:"json",
            data:{
                "naslov":title,
                "tekst":tekst,
                "posaljiRecept":true
            },
            success:function(data){
                $("#greskaRecept").html(data);
                document.getElementById("title").value=""
                document.getElementById("tekst").value=""

            },
            error:function(xhr){
                $("#greskaRecept").html(JSON.parse(xhr.responseText))
            }
        })
    }
}

function glasaj(){
    var cb=$('input[name="odgvori"]:checked')
    var idAnkete=$("#idAnkete").val()
    var izbor=cb.val()

    if(izbor!=undefined){
        console.log(idAnkete)
        $("#greskaAnketa").html("Thank you for answer")
        $.ajax({
            url:'model/popuniAnketu.php',
            method:"POST",
            dataType:"json",
            data:{
                "izbor":izbor,
                "anketa":idAnkete,
                "send":true
            },
            success:function(data){
                $("#greskaAnketa").html(data)
                $('input[name="odgvori"]').attr("disabled",true)
                rezultati()
            },
            error:function(xhr){
                $("#greskaAnketa").html(JSON.parse(xhr.responseText))
            }
        })
    }
    else{
        $("#greskaAnketa").html("You didn't shoose answer")
    }
}

function rezultati(){
    var idAnkete=$("#idAnkete").val()
    $.ajax({
        url:'model/rezultatiAnkete.php',
        method:"POST",
        dataType:"json",
        data:{
            "anketa":idAnkete,
            "rez":true
        },
        success:function(data){
            let ispis=''
            for(let d of data){
                ispis+=`<p>${d.tekstOdgovora}: ${d.broj} votes</p>`
            }
            $("#ispisRezultata").html(ispis);

        },
        error:function(xhr){
            $("#ispisRezultata").html(JSON.parse(xhr.responseText))
        }
    })
}

function admin(){
    prikaziSveRecepte()
    $("#nav a").click(function(e){
        console.log(this.dataset.name)
        e.preventDefault()
        var izbor=this.dataset.name
        if(izbor=="allRecipes"){
            prikaziSveRecepte()
        }
        if(izbor=="addNewRecipe"){
            formaDodajRecept()
        }
        if(izbor=="sent"){
            poslatiRecepti()
        }
        if(izbor=="users"){
            prikaziKorisnike()
        }
        if(izbor=="messages"){
            prikaziPoruke()
        }
        if(izbor=="comments"){
            komentari()
        }
        if(izbor=="home"){
            location.href="index.php"
        }
        if(izbor=="allQuestionnaire"){
            prikaziAnkete()
        }
        if(izbor=="activeQuestionnaire"){
            promenaAktivnosti()
        }
        if(izbor=="addQuestionnaire"){
            dodajAnketu()
        }
        if(izbor=="allCategories"){
            sveKategorije()
        }
        if(izbor=="addCategories"){
            dodajKategoriju()
        }
        
        
    })
}

function prikaziSveRecepte(){
    $.ajax({
        url:'model/prikaziSveRecepte.php',
        method:"POST",
        dataType:"json",
        success:function(data){
            let ispis='<h2>All recipes</h2>'
            for(let d of data){
                
        ispis+=`<div class='recept adminRecept'>
        <div class="slikaRecept"><img src="assets/images/${d.slikasrc}" alt="${d.naslov}"/></div>
        <div class='tekst'>
            <h3>${d.naslov}</h3>
            <div class='zvezdice'>`
            var ocena=d.ocena
            for(let i=0;i<5;i++){
                if(i<ocena){
                    ispis+=`<i class="fas fa-star"></i>`
                }
                else{
                    ispis+=`<i class="far fa-star"></i>`
                }
            }
            
            ispis+=`
            
            
            </div>
            
        <div class="buttonsAdmin">
            <a class="receptDelete" href="#" data-id="${d.idPosta}">Delete</a>
            <a class="receptUpdate" href="#" data-id="${d.idPosta}">Update</a>
        </div>
        </div>
        </div>`
            }

            $("#recepti").html(ispis)

            $(".receptDelete").click(obrisiRecept)
            $(".receptUpdate").click(updateRecept)
        },
        error:function(xhr){
            $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}
function updateRecept(e){
    e.preventDefault()
    var idPosta=this.dataset.id

    $.ajax({
        url:'model/updateRecept.php',
        method:"POST",
        dataType:"json",
        data:{
            "dugme":true,
            "id":idPosta
        },
        success:function(data){
            let ispis=''
            ispis+=`
            <div class="slikeUpdate">
            <h2>Update ${data['naslov']}</h2>
            <div class="zaSliku">
            <img id="slikaUpdatePromena" alt="${data['naslov']}" src="assets/images/${data['slikasrc']}"/></div>
            
            <div id="posaljiRecept">
                <form enctype="multipart/form-data" action="#">
                    <input type="hidden" id="idPr" value="${data['idPosta']}"/>

                    <input value="${data['naslov']}" type="text" placeholder="Name" id="naslovDodaj">

                    
                    <input type="file" id="slikaReceptUpdate">
                    
                    <input type="hidden" id="slikaStara" value="${data['slikasrc']}">
                    
                    <textarea placeholder="Introductory text" id="uvodniTekstDodaj">${data['pocetniTekst']}</textarea>
    
                    <textarea placeholder="Text" id="tekstDodaj">${data['tekst']}</textarea>
    
                    <input type="button" value="Update" id="updateRecept"/>
                    <div id="greskaAdmin"></div>
                </form>
            </div>
            </div>
            `
            $("#recepti").html(ispis)

            $("#updateRecept").click(uradiUpdate)

        },
        error:function(xhr){
                divClass.html(JSON.parse(xhr.responseText))
        }
    })

}

function uradiUpdate(){
    var id=document.getElementById("idPr").value
    var naslov=document.getElementById("naslovDodaj").value
    var uvod=document.getElementById("uvodniTekstDodaj").value
    var tekst=document.getElementById("tekstDodaj").value
    var slika=document.getElementById("slikaReceptUpdate").files[0]


    var slikaSrc=document.getElementById("slikaStara").value
    console.log(slikaSrc)

    var podaciZaSlanje=new FormData()
    

    podaciZaSlanje.append("id",id)
    podaciZaSlanje.append("naslov",naslov)
    podaciZaSlanje.append("uvod",uvod)
    podaciZaSlanje.append("tekst",tekst)
    podaciZaSlanje.append("slika",slika)
    podaciZaSlanje.append("slikaSrc",slikaSrc)
    podaciZaSlanje.append("dugme2",true)



    $.ajax({
        url:"model/uradiUpdate.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#greskaAdmin").html(data['poruka'])
            if(data['slika']==undefined){
                $(".zaSliku").html("<img src='assets/images/"+slikaSrc+"' alt='"+naslov+"'/>")
            }
            else{
                $(".zaSliku").html("<img src='assets/images/"+data['slika']+"' alt='"+naslov+"'/>")
            }
        },
        error:function(xhr){
            $("#greskaAdmin").html(JSON.parse(xhr.responseText))
        }
    })


}
function obrisiRecept(e){
    e.preventDefault()
    var idPosta=this.dataset.id

    var divClass=$(this).parent().parent().parent()

    $.ajax({
        url:'model/obrisiRecept.php',
        method:"POST",
        dataType:"json",
        data:{
            "dugme":true,
            "id":idPosta
        },
        success:function(data){
            divClass.html("<p>"+data+"</p>");

        },
        error:function(xhr){
                divClass.html(JSON.parse(xhr.responseText))
        }
    })
}

function formaDodajRecept(){
    $.ajax({
        url:"model/dohvatiKategorije.php",
        method:"get",
        dataType:"json",
        success:function(kat){
            var forma=''
    forma+=`
        <h2>Add recipe</h2>
        <div id="posaljiRecept">
            <form>
                <input type="text" placeholder="Name" id="naslovDodaj">
                
                
                <textarea placeholder="Introductory text" id="uvodniTekstDodaj"></textarea>

                <textarea placeholder="Text" id="tekstDodaj"></textarea>

                <input type="file" id="slika">
                <select id="izaberiKategoriju">
                    <option value="0">Choose</option>`
                for(let k of kat){
                    forma+=`<option value="${k.idKategorije}">${k.naziv}</option>`
                }
                forma+=`</select> 
                <input type="button" value="Add recipe" id="dodajNoviRecept"/>
                <div id="greskaAdmin"></div>
            </form>
        </div>`

        $("#recepti").html(forma)

        $("#dodajNoviRecept").click(dodajPost)
        },
        error:function(xhr){
                $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}

function dodajPost(){
    var fajl=document.getElementById("slika").files[0]
            var naslov=document.getElementById("naslovDodaj").value
            var uvod=document.getElementById("uvodniTekstDodaj").value
            var tekst=document.getElementById("tekstDodaj").value
            var kat=document.getElementById("izaberiKategoriju").value

            var podaciZaSlanje= new FormData();


            podaciZaSlanje.append("slika",fajl)
            podaciZaSlanje.append("naslov",naslov)
            podaciZaSlanje.append("uvod",uvod)
            podaciZaSlanje.append("tekst",tekst)
            podaciZaSlanje.append("kat",kat)

            podaciZaSlanje.append("dugme","true")

            
            $.ajax({
                url:"model/dodajRecept.php",
                method:"post",
                dataType:"json",
                processData:false,
                contentType:false,
                data:podaciZaSlanje,
                success:function(data){
                    $("#greskaAdmin").html(data)
                },
                error:function(xhr){
                    $("#greskaAdmin").html(JSON.parse(xhr.responseText))
                }
            })
}
function poslatiRecepti(){
    $.ajax({
        url:'model/poslatiRecepti.php',
        method:"POST",
        dataType:"json",
        success:function(recepti){
            let ispis=''
            ispis+=`<div id="tabela"><h2>Sent recipes</h2>
            <table><thead><tr><th>Title</th><th>Text</th></tr></thead>`
            for(let r of recepti){
                ispis+=`
                <tr><td>${r.title}</td><td>${r.tekst}</td></tr>
                `
            }
            ispis+=`</table></div>`
            $("#recepti").html(ispis);

        },
        error:function(xhr){
            $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}


function prikaziKorisnike(){
    $.ajax({
        url:"model/dohvatiKorisnike.php",
        method:"get",
        dataType:"json",
        success:function(user){
            let ispis=''
            ispis+=`<div id="tabela"><h2>Users</h2><table><thead><tr><th>First name</th><th>Last Name</th><th>E-mail</th></tr></thead>`
            for(let u of user){
                ispis+=`
                <tr><td>${u.ime}</td><td>${u.prezime}</td><td>${u.email}</td></tr>
                `
            }
            ispis+=`</table></div>`
            $("#recepti").html(ispis);
        },
        error:function(xhr){
                $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}

function prikaziPoruke(){
    $.ajax({
        url:"model/dohvatiPoruke.php",
        method:"get",
        dataType:"json",
        success:function(message){
            let ispis=''
            ispis+=`<div id="tabela"><h2>Messages</h2><table><thead><tr><th>E-mail</th><th>Subject</th><th>Message</th><th>Date</th><th>Read</th></tr></thead>`
            for(let m of message){
                ispis+=`
                <tr><td>${m.email}</td><td>${m.naslov}</td><td>${m.tekst}</td>
                <td>${m.datum}</td><td><a class="brisiPoruku" data-id="${m.idPoruke}" href="#">Delete</a></td>
                </tr>
                `
            }
            ispis+=`</table></div>`
            $("#recepti").html(ispis);

            $(".brisiPoruku").click(obrisiPoruku)
        },
        error:function(xhr){
                $(".brisiPoruku").html(JSON.parse(xhr.responseText))
        }
    })
}

function obrisiPoruku(e){
    e.preventDefault()
    var id=this.dataset.id
    var red=$(this).parent().parent();
    $(this).parent().parent().remove()

    $.ajax({
        url:"model/obrisiPoruku.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id,
            "dugme":true
        },
        success:function(data){
            red.remove()
        },
        error:function(xhr){
            red.html(JSON.parse(xhr.responseText))
        }
    })
}

function komentari(){
    $.ajax({
        url:"model/dohvatiKomentareAdmin.php",
        method:"get",
        dataType:"json",
        success:function(comments){
            let ispis=''
            ispis+=`<div id="tabela"><h2>Comments</h2><table><thead><tr><th>E-mail</th><th>Subject</th><th>Comment</th><th>Date</th><th>Delete</th></tr></thead>`
            for(let c of comments){
                ispis+=`
                <tr><td>${c.ime} ${c.prezime}</td><td>${c.naslov}</td><td>${c.tekst}</td><td>${c.datum}</td><td><a href="#" class="linkBrisiKomentar" data-id="${c.idKomentar}">Delete</a></td>
                </tr>
                `
            }
            ispis+=`</table></div>`
            $("#recepti").html(ispis);

            $(".linkBrisiKomentar").click(obrisiKomentar)
        },
        error:function(xhr){
                $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}

function obrisiKomentar(e){
    e.preventDefault()
    var id=this.dataset.id
    var red=$(this).parent().parent();
    $(this).parent().parent().remove()

    $.ajax({
        url:"model/obrisiKomentar.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id,
            "dugme":true
        },
        success:function(data){
            red.remove()
        },
        error:function(xhr){
                $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}

function prikaziAnkete(){
    $.ajax({
        url:"model/prikaziAnkete.php",
        method:"post",
        dataType:"json",
        success:function(anketa){
            let ispis=''
            ispis+=`<div id="tabela"><h2>Questionnaire</h2><ul>`
            for(let a of anketa){
                ispis+=`<li>${a.pitanje} ${a.tekstOdgovora} (${a.broj} votes)</li>`
            }

            ispis+="</ul></div>"
            $("#recepti").html(ispis);
        },
        error:function(xhr){
            $("#recepti").html(xhr)
        }
    })
}
function promenaAktivnosti(){
    $.ajax({
        url:"model/promenaAktivnosti.php",
        method:"post",
        dataType:"json",
        success:function(anketa){
            let ispis=''
            ispis+=`<div id="tabela"><h2>Active questionnaire</h2>
            <form><select id="aktivnaAnketa">`
            for(let a of anketa){
                ispis+=`<option value="${a.idAnkete}"`
                
                if(a.aktivna==1){
                    ispis+=`selected`
                }
                
                ispis+=`>${a.pitanje}</option>`
            }

            ispis+="</select></form><div id='greskaAdmin'></div></div>"
            $("#recepti").html(ispis);

            $("#aktivnaAnketa").change(promeniAktivnu)
        },
        error:function(xhr){
            $("#recepti").html(xhr)
        }
    })
}

function promeniAktivnu(){
    var id=this.value
    console.log(id)
    $.ajax({
        url:"model/updateAnketa.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(anketa){
            $("#greskaAdmin").html(anketa);
        },
        error:function(xhr){
            $("#greskaAdmin").html(xhr)
        }
    })
}

function dodajAnketu(){
    let ispis=`<div id="table"><h2>Add Questionnaire</h2>
    <div id="posaljiRecept">
        <form>

            <input type="text" placeholder="Question" id="pitanje">

            <input type="text" name="odg[]" placeholder="Answer 1">
            <input type="text" name="odg[]" placeholder="Answer 2">

            <div id="novaPitanja"> </div>
            
            <input type="button" value="Add answer" id="addAnswer">
            <input type="button" value="Add Questionnaire" id="addQuestionnaire">
            <p id="greskaAdmin">
            </p>
        </form></div>`

    $("#recepti").html(ispis)
    var br=3
    $("#addAnswer").click(function(){
        let ispis2=`<input name="odg[]" type="text" placeholder="Answer ${br}">`
        br++
        document.getElementById("novaPitanja").innerHTML+=ispis2
    })

    $("#addQuestionnaire").click(insertAnketa)

}

function insertAnketa(){
    var odg=document.getElementsByName("odg[]")
    var pitanje=document.getElementById("pitanje").value

    var zaSlanje=[]
    for(let i=0;i<odg.length;i++){
        zaSlanje.push(odg[i].value)
    }
    $.ajax({
        url:"model/insertAnketa.php",
        method:"post",
        dataType:"json",
        data:{
            "pitanje":pitanje,
            "odg":zaSlanje
        },
        success:function(anketa){
            for(let i=0;i<odg.length;i++){
                odg[i].value=""
            }
            document.getElementById("pitanje").value=""
            $("#greskaAdmin").html(anketa);
        },
        error:function(xhr){
            $("#greskaAdmin").html(JSON.parse(xhr.responseText))
        }
    })
}

function sveKategorije(){
    $.ajax({
        url:"model/dohvatiKategorije.php",
        method:"get",
        dataType:"json",
        success:function(data){
            let ispis="<div id='tabela'><h2>All categories</h2><div class='nekaKlasa'>"
            for(let d of data){
                ispis+=`<div class="kategorije">
                <img src="assets/images/${d.slikasrc}" alt="${d.naziv}">
                <h3>${d.naziv}</h3>
                <a href="" class="brisiKat" data-id="${d.idKategorije}">Delete</a>
            </div>
            `
            }
            ispis+=`
                <form>
                <h3>Update</h3>
                    <select id="selectKat"><option value="0">Choose</option>`
                        
                for(let o of data){
                    ispis+=`<option value="${o.idKategorije}">${o.naziv}</option>`
                }

                ispis+= `</select>

                <input type="text" id="novoImeKat" placeholder="New category name"/>

                <br><br>
                <input type="file" id="novaSlikaKat"/>

                <input type="button" id="updateKat" value="Update category"/>
                <div id="greskaUpdate"></div>
                </form>
            `
            ispis+=`</div></div>`
            $("#recepti").html(ispis)

            $(".brisiKat").click(brisiKategoriju)

            $("#updateKat").click(uradiUpdateKategorije)
        },
        error:function(xhr){
            $("#recepti").html(JSON.parse(xhr.responseText))
        }
    })
}
function uradiUpdateKategorije(){
    
    var fajl=document.getElementById("novaSlikaKat").files[0]
    var naslov=document.getElementById("novoImeKat").value
    var id=document.getElementById("selectKat").value

    var podaciZaSlanje= new FormData();

    

    podaciZaSlanje.append("slika",fajl)
    podaciZaSlanje.append("naslov",naslov)
    podaciZaSlanje.append("id",id)

    $.ajax({
        url:"model/updateKategorije.php",
        method:"post",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#greskaUpdate").html(data)
            console.log(data)
        },
        error:function(xhr){
            $("#greskaUpdate").html(JSON.parse(xhr.responseText))

            
        }
    })
}


function brisiKategoriju(e){
    e.preventDefault()
    var id=this.dataset.id
    var div=$(this).parent()

    $.ajax({
        url:"model/brisiKategoriju.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(anketa){
            div.remove()
        },
        error:function(xhr){
            $("#greskaAdmin").html(xhr)
        }
    })
}

function dodajKategoriju(){
    let ispis=''
    ispis+=`
    
    <div id="table"><h2>Add category</h2>
    <div id="posaljiRecept">
    <form enctype="multipart/form-data" action="#">
        <input type="file" id="slika"/>
        <input type="text" id="naslovKat" placeholder="Title"/>
        <input type="button" id="dodajKat" value="Add category"/>
        <div id="greskaAdmin"></div>
    </form></div></div>`
    $("#recepti").html(ispis)

    $("#dodajKat").click(insertKategorije)

}

function insertKategorije(){
    
    var fajl=document.getElementById("slika").files[0]
    var naslov=document.getElementById("naslovKat").value

    var podaciZaSlanje= new FormData();


    podaciZaSlanje.append("slika",fajl)
    podaciZaSlanje.append("naslov",naslov)

    $.ajax({
        url:"model/insertKategorije.php",
        method:"post",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#greskaAdmin").html(data)
        },
        error:function(xhr){
            $("#greskaAdmin").html(JSON.parse(xhr.responseText))
        }
    })
}
