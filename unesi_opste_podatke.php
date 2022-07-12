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
                    $result = mysqli_query($con, "INSERT INTO artikal(kor_ime, sifra_ar, naziv, jedinica, stopa_poreza) VALUES ('$kor_ime', '$sifra', '$naziv', '$jedinica', '$stopa')");
                    echo "<script type='text/javascript'>window.parent.location.reload()</script>";
                }
            }
            mysqli_close($con);
        ?>
    </body>
</html>