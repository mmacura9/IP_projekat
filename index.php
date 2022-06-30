<html>
    <head>
        <title></title>
    </head>
    <body>
        <form name="Prijava" method="post" action="">
            Korisničko ime: <input type="text" name="kor_ime">
            Lozinka: <input type="text" name="lozinka">
            <input type="submit" value="Prijava">
        </form>
        <?php
            if (!empty($_POST['kor_ime'])) {
                echo $_POST['kor_ime'];
            }
            else {
                echo 'Niste uneli korisničko ime.';
            }
        ?>
        <hr/>
        <h1>Registracija preduzeća</h1>
        <br/>
        <form name="Registracija" method="post" action="">
            Ime odgovornog lica: <input type="text" name="ime"> <br/>
            Prezime odgovornog lica: <input type="text" name="prezime"> <br/>
            Korisničko ime: <input type="text" name="kor_ime"><br/>
            Lozinka: <input type="password" name="lozinka"><br/>
            Potvrda lozinke: <input type="password" name="lozinka_potvrda"><br/>
            Kontakt telefon: <input type="text" name="broj_tel"><br/>
            e-mail: <input type="text" name="email"><br/>
            Naziv preduzeća: <input type="text" name="preduzece"><br/>
            Adresa sedišta preduzeća: <br/>
            &emsp;&emsp;&emsp;Država: <input type="text" name="drzava"><br/>
            &emsp;&emsp;&emsp;Grad: <input type="text" name="grad"><br/>
            &emsp;&emsp;&emsp;Poštanski broj: <input type="text" name="post_broj"><br/>
            &emsp;&emsp;&emsp;Ulica i broj: <input type="text" name="ulica"><br/>
            PIB: <input type="text" name="pib"><br/>
            Matični broj preduzeća: <input type="text" name="mat_br"><br/>
            <input type="submit" value="Registracija">
        </form>
    </body>
</html>