<html>
    <head>
        <title></title>
        <script src="provera.js"></script>
    </head>
    <body>
        <h1>Prijava</h1>
        <form name="prijava" method="post" action="" onsubmit="return proveraPrijava();">
            Korisničko ime: <input type="text" name="korime">
            Lozinka: <input type="password" name="loz">
            <input type="submit" name="prijava" value="Prijava">
        </form>
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
        <hr/>
        <h1>Registracija preduzeća</h1>
        <br/>
        <form name="registracija" method="post" action="" onsubmit="return proveraRegistracija();">
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
            <input type="submit" name="registracija" value="Registracija">
            <br/>
            <?php
            //echo gettype($con); 
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
    </body>
</html>