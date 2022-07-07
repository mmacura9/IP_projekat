<html>
    <head>
        <title></title>
        <script src="provera.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <a href='logout.php' class="logout"> logout </a>
            &nbsp;&nbsp;
            <a href='p_preduzece.php'> Nazad </a>
            
        </div>
        <form name="promena" method="post" action="" onsubmit="return proveraSifre();">
        <table>
            <tr><input type="submit" name="promena" value="Promeni"></tr>
            <tr><td>Stara lozinka:</td> <td><input type="password" name="stara"></td> </tr>
            <tr><td>Nova lozinka: </td> <td><input type="password" name="nova"></td> </tr>
            <tr><td>Potvrda lozinke:</td> <td> <input type="password" name="potvrda"></td></tr>
            
        </table>
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

        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>

        </div>
    </body>
</html>