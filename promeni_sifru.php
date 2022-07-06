<html>
    <head>
        <title></title>
        <script src="provera.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form name="promena" method="post" action="" onsubmit="return proveraSifre();">
            Stara lozinka: <input type="password" name="stara"> <br/>
            Nova lozinka: <input type="password" name="nova"> <br/>
            Potvrda lozinke: <input type="password" name="potvrda"><br/>
            <input type="submit" name="promena" value="Promeni"><br/>
        </form>
        <?php
            if(isset($_POST['promena'])){
                $stara = $_POST['stara'];
                $nova = $_POST['nova'];
                $potvrda = $_POST['potvrda'];
                session_start();
                if($stara == $_SESSION['lozinka'] && $nova==$potvrda) {
                    include_once './dbconnect.php';
                    $kor_ime = $_SESSION['kor_ime'];
                    if ($_SESSION['tip'] == 'preduzece'){
                        $res = mysqli_query($con, "update preduzece set lozinka='$nova' where kor_ime = '$kor_ime'");
                        if(!$res){
                            echo "Nije uspela promena lozinke";
                        }
                    }
                    if ($_SESSION['tip'] == 'admin') {
                        $res = mysqli_query($con, "update admin set lozinka='$nova'");
                        if(!$res){
                            echo "Nije uspela promena lozinke";
                        }
                    }
                    mysqli_close($con);
                }
                else {
                    echo 'Podaci nisu dobri';
                }
            }
        ?>
    </body>
</html>