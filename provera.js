function proveraPrijava(){
    var kor_ime = document.prijava.kor_ime.value
    alert(1)
}

function proveraRegistracija(){
    var ime = document.registracija.ime.value
    //alert(ime)
    var prezime = document.registracija.prezime.value
    var kor_ime = document.registracija.kor_ime.value
    var lozinka = document.registracija.lozinka.value
    var proveraLozinke = document.registracija.lozinka_potvrda.value
    var tel = document.registracija.broj_tel.value
    var mejl = document.registracija.email.value
    var preduzece = document.registracija.preduzece.value
    var drzava = document.registracija.drzava.value
    var grad = document.registracija.grad.value
    var post_broj = document.registracija.post_broj.value
    var ulica = document.registracija.ulica.value
    var pib = document.registracija.pib.value
    var mat_broj = document.registracija.mat_br.value

    var reg_ime = /^[A-Z][a-z]+$/
    if(!ime.match(reg_ime)){
        alert("Loše ste uneli ime")
        return
    }
    if(!prezime.match(reg_ime)){
        alert("Loše ste uneli prezime")
        return
    }
    
    var reg_kor = /^\w+$/
    if(!kor_ime.match(reg_kor)){
        alert("Loše ste uneli korisničko ime")
        return
    }

    var reg_loz =/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,12})/ // /^([A-Z] | [a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,12})$/
    if(!lozinka.match(reg_loz)){
        alert("Loše ste uneli lozinku")
        return
    }

    if(proveraLozinke!=lozinka){
        alert("Lozinke se ne poklapaju")
        return
    }

    var reg_mejl = /^([A-Z] | [a-z])\w+@\w+\.[a-z]+/
    if(!mejl.match(reg_mejl)){
        alert("Loše ste uneli e-mail")
        return
    }

    if(!preduzece.match(reg_kor)){
        alert("Loše ste uneli ime preduzeća")
        return
    }

    if(!drzava.match(reg_kor)){
        alert("Loše ste uneli državu")
        return
    }

    if(!grad.match(reg_kor)){
        alert("Loše ste uneli grad")
        return
    }

    var reg_post = /^\d+$/
    if(!post_broj.match(reg_post)){
        alert("Loše ste uneli poštanski broj")
        return
    }

    var reg_ulica = /^([A-Z] | [a-z])+\s\d+$/
    if(!ulica.match(reg_ulica)){
        alert("Loše ste uneli ulicu i broj")
        return
    }

    var reg_pib = /^[1-9]\d{8}$/
    if(!pib.match(reg_pib)){
        alert("Loše ste uneli pib")
        return
    }
    var reg_mat = /^\d+$/
    if(!mat_broj.match(reg_mat)){
        alert("Loše ste uneli matični broj preduzeća")
        return
    }
}