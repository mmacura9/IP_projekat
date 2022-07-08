<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="provera.js"></script>
    </head>
    <body>
        <?php
        session_start();
        session_destroy();
        ?>
        <div class='header'>
        <h1>Prijava</h1>
        <form name="prijava" method="post" action="" onsubmit="return proveraPrijava();">
            Korisničko ime: <input type="text" name="korime">
            Lozinka: <input type="password" name="loz">
            <input type="submit" name="prijava" value="Prijava">
        </form>
        </div>
        <?php
            include_once './dbconnect.php';
            if(isset($_POST['prijava'])){
                $korime = $_POST['korime'];
                $loz = $_POST['loz'];
                $res0 = mysqli_query($con, "select kor_ime from preduzece where kor_ime='$korime' and lozinka='$loz' and status='ok'");
                if (mysqli_num_rows($res0)) {
                    session_start();
                    $_SESSION['kor_ime'] = $korime;
                    $_SESSION['lozinka'] = $loz;
                    $_SESSION['tip'] = 'preduzece';
                    header('Location: ./p_preduzece.php');
                }
                else {
                    echo "<span style='color: red'>Loše korisničko ime ili šifra</span>";
                }
            }
            
        ?>
        
        <h1>Registracija preduzeća</h1>
        <br/>
        <form name="registracija" method="post" action="" onsubmit="return proveraRegistracija();">
        <div class='glavni'>
        <table>
            <tr>
            <td>Ime odgovornog lica:</td><td> <input type="text" name="ime"> </td>
            </tr>
            <tr>
            <td>Prezime odgovornog lica: </td><td><input type="text" name="prezime"> </td>
            </tr>
            <tr>
            <td>Korisničko ime:</td> <td><input type="text" name="kor_ime"></td>
            </tr>
            <tr>
            <td>Lozinka:</td> <td><input type="password" name="lozinka"></td>
            </tr>
            <tr>
            <td>Potvrda lozinke:</td> <td><input type="password" name="lozinka_potvrda"></td>
            </tr>
            <tr>
            <td>Kontakt telefon:</td> <td><input type="text" name="broj_tel"></td>
            </tr>
            <tr>
            <td>e-mail:</td><td> <input type="text" name="email"></td>
            </tr>
            <tr>
            <td>Naziv preduzeća:</td> <td><input type="text" name="preduzece"></td>
            </tr>
            <tr>
            <td>
            Adresa sedišta preduzeća:
            </td>
            </tr>
            <tr>
            <td class="desno">Država:<td> <input type="text" name="drzava"></td>
            </tr>
            <tr>
            <td class="desno">Grad:</td><td><input type="text" name="grad"></td>
            </tr>
            <tr>
            <td class="desno">Poštanski broj:</td> <td><input type="text" name="post_broj"></td>
            </tr>
            <tr>
            <td class="desno">Ulica i broj:</td> <td><input type="text" name="ulica"></td>
            </tr>
            <tr>
            <td>PIB:</td><td> <input type="text" name="pib"></td>
            </tr>
            <tr>
            <td>Matični broj preduzeća:</td> <td><input type="text" name="mat_br"></td>
            </tr>
        </table>
        </div>
            <input type="submit" name="registracija" value="Registracija">
            <br/>
            <?php
            if(isset($_POST['registracija'])){
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $kor_ime = $_POST['kor_ime'];
                $lozinka = $_POST['lozinka'];
                $broj_tel = $_POST['broj_tel'];
                $email = $_POST['email'];
                $naziv = $_POST['preduzece'];
                $drzava = $_POST['drzava'];
                $grad = $_POST['grad'];
                $post = $_POST['post_broj'];
                $ulica = $_POST['ulica'];
                $pib = $_POST['pib'];
                $maticni = $_POST['mat_br'];
                $res1 = mysqli_query($con, "select kor_ime from preduzece where kor_ime='$kor_ime'");
                if(mysqli_num_rows($res1)==0){
                    $res2 = mysqli_query($con, "select email from preduzece where email='$email'");
                    if(mysqli_num_rows($res2)==0){
                        $result = mysqli_query($con, "insert into preduzece (ime, prezime, kor_ime, lozinka, br_tel, email, naziv, drzava, grad, post_broj, ulica_br, PIB, maticni_br, PDV, status)"
                        ." values ('$ime', '$prezime', '$kor_ime', '$lozinka', '$broj_tel', '$email', '$naziv', '$drzava', '$grad', '$post', '$ulica', '$pib', '$maticni', NULL, 'na cekanju')");
                        if($result) {
                            echo 'Uspesno ste registrovani';
                        }
                        else{
                            echo "<span style='color: red'>Nesto je krenulo po zlu</span>";
                            echo("Error description: " . $con -> error);
                        }
                    }
                    else{
                        echo "<span style='color: red'>Već postoji nalog sa ovim mejlom.</span>";
                    }
                }
                else {
                    echo "<span style='color: red'>Korisničko ime već postoji.</span>";
                }
                
            }
            mysqli_close($con);
            ?>
        </form>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>

        </div>
    </body>
</html>