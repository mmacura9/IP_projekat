function proveraPrijava(){
    
}

function proveriRacun() {
    var br_rac = document.dodati.br_rac.value
    var reg_rac = /^\d{3}-\d{12}-\d{2}$/
    if(!br_rac.match(reg_rac)){
        alert("Loše ste uneli broja računa")
        return false
    }
    return true
}

function proveraSifre() {
    var sifra = document.promena.nova.value
    var reg_sifra = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,12})/;
    if(!sifra.match(reg_sifra)) {
        alert("Loše ste uneli lozinku")
        return false
    }
    return true
}

function proveraRegistracija(){
    var ime = document.registracija.ime.value
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
        return false
    }

    if(!prezime.match(reg_ime)){
        alert("Loše ste uneli prezime")
        return false
    }
    
    var reg_kor = /^\w+$/
    if(!kor_ime.match(reg_kor)){
        alert("Loše ste uneli korisničko ime")
        return false
    }

    var reg_loz =/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,12})/ // /^([A-Z] | [a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,12})$/
    if(!lozinka.match(reg_loz)){
        alert("Loše ste uneli lozinku")
        return false
    }

    if(proveraLozinke!=lozinka){
        alert("Lozinke se ne poklapaju")
        return false
    }
    
    /*var reg_mejl = /^\w+@\w+\.\w+/
    if(!mejl.match(reg_mejl)){
        alert("Loše ste uneli e-mail")
        return false
    }*/

    if(!preduzece.match(reg_kor)){
        alert("Loše ste uneli ime preduzeća")
        return false
    }

    if(!drzava.match(reg_kor)){
        alert("Loše ste uneli državu")
        return false
    }

    if(!grad.match(reg_kor)){
        alert("Loše ste uneli grad")
        return false
    }

    var reg_post = /^\d+$/
    if(!post_broj.match(reg_post)){
        alert("Loše ste uneli poštanski broj")
        return false
    }

    var reg_ulica = /^\w+/
    if(!ulica.match(reg_ulica)){
        alert("Loše ste uneli ulicu i broj")
        return false
    }

    var reg_pib = /^[1-9]\d{8}$/
    if(!pib.match(reg_pib)){
        alert("Loše ste uneli pib")
        return false
    }
    var reg_mat = /^\d+$/
    if(!mat_broj.match(reg_mat)){
        alert("Loše ste uneli matični broj preduzeća")
        return false
    }
    return true
}