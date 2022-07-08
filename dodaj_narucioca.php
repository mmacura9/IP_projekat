<html>
    <head>
        <title></title>
        <script></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <div class="header">
            <a href='logout.php' class="logout"> logout </a>
            &nbsp;&nbsp;
            <a href='p_preduzece.php'> Nazad </a>
            
        </div>
        
         
        <?php
            include_once './dbconnect.php';
            include_once './meni.php';
        ?>
        <br/>
        <br/>
        <form name="dodaj_pib" method="post" action="">
            <tr>
                <td> Unesite PIB naručioca: </td>
                <td> <input type="text" name="pib" placeholder="PIB" /></td>
            </tr>
            <br/>
            <input type="submit" name="dodaj" value="Dodaj" />
        </form>
        <?php
            session_start();
            if(!isset($_SESSION['kor_ime'])){
                header('Location: ./index.php');
            }
            if($_SESSION['tip']!='preduzece'){
                header('Location: ./index.php');
            }
            $kor_ime = $_SESSION['kor_ime'];
            if(isset($_POST['dodaj'])){
                $pib = $_POST['pib'];
                $result = mysqli_query($con,"select * from preduzece where PIB='$pib'");
                if($result){
                    $row = mysqli_fetch_assoc($result);
                    if($row){
                        $ime = $row['ime'];
                        $prezime = $row['prezime'];
                        $kor_ime_novo = $row['kor_ime'];
                        $br_tel = $row['br_tel'];
                        $email = $row['email'];
                        $naziv = $row['naziv'];
                        $drzava = $row['drzava'];
                        $grad = $row['grad'];
                        $post_br = $row['post_broj'];
                        $ulica = $row['ulica_br'];
                        $pib = $row['PIB'];
                        $mat_br = $row['maticni_br'];
                        $result = mysqli_query($con, "INSERT INTO narucioci(kor_ime, Ime, Prezime, br_tel, email, naziv, drzava, grad, post_br, ulica, pib, mat_br, kor_ime_glavni) VALUES"
                        ." ('$kor_ime_novo','$ime','$prezime','$br_tel','$email','$naziv','$drzava','$grad','$post_br','$ulica','$pib','$mat_br','$kor_ime')");
                        echo "Uspešno ste dodali naručioca";
                    }
                    else {
                        echo 'Taj PIB ne postoji u bazi! Unesite podatke u formi dole!';
                    }
                }
            }
        ?>
        <hr width='50%'/>
        <form name="registracija" method="post" action="" onsubmit="return proveraRegistracija();">
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
        <input type="submit" name="registracija" value="Registracija">
        </form>
        <?php
        if(isset($_POST['registracija'])){
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $kor_ime_novo = $_POST['kor_ime'];
                $br_tel = $_POST['broj_tel'];
                $email = $_POST['email'];
                $naziv = $_POST['preduzece'];
                $drzava = $_POST['drzava'];
                $grad = $_POST['grad'];
                $post_br = $_POST['post_broj'];
                $ulica = $_POST['ulica'];
                $pib = $_POST['pib'];
                $mat_br = $_POST['mat_br'];
                if($ime!='' && $prezime!='' && $kor_ime_novo!='' && $br_tel!='' && $email!='' && $naziv!='' && $drzava!='' && $grad!='' && $post_br!='' && $ulica!='' && $pib!='' && $mat_br!=''){
                    $result = mysqli_query($con, "INSERT INTO narucioci(kor_ime, Ime, Prezime, br_tel, email, naziv, drzava, grad, post_br, ulica, pib, mat_br, kor_ime_glavni) VALUES"
                    ." ('$kor_ime_novo','$ime','$prezime','$br_tel','$email','$naziv','$drzava','$grad','$post_br','$ulica','$pib','$mat_br','$kor_ime')");
                    echo "Uspešno ste dodali naručioca";
                }
                else {
                    echo 'Niste uneli sve podatke!';
                }
            }
            mysqli_close($con);
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>