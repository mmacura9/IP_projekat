<html>
    <head>
        <title></title>
        <script src="provera.js"></script>
    </head>
    <body>
        <?php include_once './dbconnect.php'; ?>
        <form name="prijava" method="post" action="">
            Korisničko ime: <input type="text" name="korime">
            Lozinka: <input type="text" name="lozinka">
            <input type="submit" value="Prijava" onclick="proveraPrijava()">
        </form>
        <?php
            if (!empty($_POST['korime'])) {
                echo $_POST['korime'];
            }
            else {
                echo 'Niste uneli korisničko ime.';
            }
        ?>
        <hr/>
        <h1>Registracija preduzeća</h1>
        <br/>
        <form name="registracija" method="post" action="">
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
            <input type="submit" value="Registracija" onclick="proveraRegistracija()">
        </form>
    </body>
</html>