<html>
    <head>
        <title></title>
        <style>
            body {
                background-color: black;
                color: white;
                background-repeat: no-repeat;
                background-size: cover;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <form method="post">
        <center>
            <table>
                <tr>
                    <td>Šifra artikla:</td><td><input type="text" name="sifra"></td>
                </tr>
                <tr>
                    <td>Naziv:</td><td><input type="text" name="naziv"></td>
                </tr>
                <tr>
                    <td>Jedinica mere:</td><td><input type="text" name="jedinica"></td>
                </tr>
                <tr>
                    <td>Poreska stopa:</td>
                    <td><select name='stopa'>
                    <option value='20' name='tip1'> 20</option>
                    <option value='10' name='tip2'> 10 </option>
                    <option value='0' name='tip3'> 0  </option>
                </select> </td>
                </tr>
                <tr>
                    <td>Zemlja porekla:</td><td><input type="text" name="zemlja"></td>
                </tr>
                <tr>
                    <td>Strani naziv:</td><td><input type="text" name="strani_naziv"></td>
                </tr>
                <tr>
                    <td>Barkod broj:</td><td><input type="text" name="barkod"></td>
                </tr>
                <tr>
                    <td>Naziv proizvođača:</td><td><input type="text" name="proizvodjac"></td>
                </tr>
                <tr>
                    <td>Carinska tarifa:</td><td><input type="text" name="tarifa"></td>
                </tr>
                <tr>
                    <td><input type="radio" name="eko_akcize" value="0"> <label>Eko Taksa</label></td>
                    <td><input type="radio" name="eko_akcize" value="1"> <label>Akcize</label></td>
                </tr>
                <tr>
                    <td>Minimalne zalihe:</td><td><input type="text" name="min_zalihe"></td>
                </tr>
                <tr>
                    <td>Maksimalne zalihe:</td><td><input type="text" name="max_zalihe"></td>
                </tr>
                <tr>
                    <td>Opis:</td><td><input type="text" name="opis"></td>
                </tr>
                <tr>
                    <td>Deklaracija:</td><td><input type="text" name="deklaracija"></td>
                </tr>
            </table>
        </center>
            <input type='submit' name='posalji' value='Pošalji'>
        </form>
        <?php
            include_once './dbconnect.php';
            session_start();
            if(!isset($_SESSION['kor_ime'])){
                header('Location: ./index.php');
            }
            if($_SESSION['tip']!='preduzece'){
                header('Location: ./index.php');
            }
            $kor_ime = $_SESSION['kor_ime'];

            if(isset($_POST['posalji'])){
                $result = mysqli_query($con, "SELECT sifra_ar as 'sifra' FROM artikal WHERE kor_ime='$kor_ime'");
                $ok = true;
                while ($row = mysqli_fetch_assoc($result)){
                    $ok = $_POST['sifra'] != $row['sifra'];
                    if($ok == false)
                        break;
                }
                if($ok && $_POST['sifra'] != '' && $_POST['naziv'] != '' && $_POST['jedinica']) {
                    $sifra = $_POST['sifra'];
                    $naziv = $_POST['naziv'];
                    $jedinica = $_POST['jedinica'];
                    $stopa = $_POST['stopa'];
                    $zemlja = $_POST['zemlja'];
                    $strani_naziv = $_POST['strani_naziv'];
                    $barkod = $_POST['barkod'];
                    $proizvodjac = $_POST['proizvodjac'];
                    $tarifa = $_POST['tarifa'];
                    $eko_akcize = $_POST['eko_akcize'];
                    $min_zalihe = $_POST['min_zalihe'];
                    $max_zalihe = $_POST['max_zalihe'];
                    $opis = $_POST['opis'];
                    $deklaracija = $_POST['deklaracija'];
                    $result = mysqli_query($con, "INSERT INTO  artikal ( kor_ime ,  sifra_ar ,  jedinica ,  naziv ,  stopa_poreza ,  proizvodjac ,  zemlja ,  strani_naziv ,  bar_kod ,  carinska_tarifa ,  eko_akcize ,  max_kol ,  min_kol ,  opis ,  deklaracija )".
                    " VALUES ('$kor_ime','$sifra','$jedinica','$naziv','$stopa','$proizvodjac','$zemlja','$strani_naziv','$barkod','$tarifa','$eko_akcize','$max_zalihe','$min_zalihe','$opis','$deklaracija')");
                    echo "<script type='text/javascript'>window.parent.location.reload()</script>";
                }
            }
            mysqli_close($con);
        ?>
    </body>
</html>