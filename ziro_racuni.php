<html>
    <head>
        <title></title>
        <script></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="provera.js"></script>
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
            session_start();
            if(!isset($_SESSION['kor_ime'])){
                header('Location: ./index.php');
            }
            if($_SESSION['tip']!='preduzece'){
                header('Location: ./index.php');
            }
            $kor_ime = $_SESSION['kor_ime'];

            $result = mysqli_query($con,"select * from racun where kor_ime='$kor_ime'");
            
            if($result){?>
                <table>
                <tr><th>Broj računa</th><th>Banka</th></tr>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <form name="odobri" method="post" action="">
                        
                        <tr>
                            <input type="hidden" name="br_rac" value="<?php echo $row['br_rac']; ?>" />
                            <input type="hidden" name="banka" value="<?php echo $row['banka']; ?>" />
                            <td> <?php echo $row['br_rac'];?> </td>
                            <td> <?php echo $row['banka'];?> </td>
                            <td> <input type="submit" name="obrisi" value="Obriši" /></td>
                        </tr>

                    </form>
                    <?php
                }
                ?>
                </table>
                <?php
                if(isset($_POST['obrisi'])){
                    $br_rac = $_POST['br_rac'];
                    $banka = $_POST['banka'];
                    $result = mysqli_query($con,"DELETE FROM racun WHERE br_rac = '$br_rac' AND banka = '$banka'");
                    header('Location: ./ziro_racuni.php');
                }
            }
            else {
                echo "<span style='color: red'>GREŠKA</span>";
            }
        ?>
        <br/>
        Dodaj račun: <br/>
        <form name="dodati" method="post" onsubmit="return proveriRacun();">
        <tr><td><input type='text' name='br_rac' placeholder='Broj računa'> </td>
        <td><input type='text' name='banka' placeholder='Banka'> </td></tr>
        <tr><input type="submit" name="dodaj" value="Dodaj"></tr>
        </form>
        <?php
            if(isset($_POST['dodaj'])) {
                $br_rac = $_POST['br_rac'];
                $banka = $_POST['banka'];
                $result = mysqli_query($con,"select * from racun where kor_ime='$kor_ime'");
                $ok = false;
                while($row = mysqli_fetch_assoc($result)) {
                    if($row['br_rac'] == $br_rac && $row['banka'] == $banka){
                        $ok = true;
                        break;
                    }
                }
                if($br_rac != '' && $banka != '' && $ok==false){
                    $result = mysqli_query($con,"INSERT INTO racun(br_rac, banka, kor_ime) VALUES ('$br_rac', '$banka', '$kor_ime')");
                    header('Location: ./ziro_racuni.php');
                }
            }
            mysqli_close($con);
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>