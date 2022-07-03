<html>
    <head>
        <title></title>
        <script></script>
    </head>
    <body>
        <a href='logout.php'> logout </a>
        <br/>
        <a href='promeni_sifru.php'> promena sifre </a>
        <hr/>
        
        <?php
        session_start();
        if(!isset($_SESSION['kor_ime'])){
            header('Location: ./index.php');
        }
        if($_SESSION['tip']!='preduzece'){
            header('Location: ./index.php');
        }
        if(!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 1;
        }

        if(!isset($_SESSION['counter1'])) {
            $_SESSION['counter1'] = 1;
        }

        if(isset($_POST['dodaj'])) {
            ++$_SESSION['counter'];
        }

        if(isset($_POST['dodaj1'])) {
            ++$_SESSION['counter1'];
        }

        if(isset($_POST['reset'])) {
            $_SESSION['counter'] = 1;
        }

        if(isset($_POST['reset1'])) {
            $_SESSION['counter1'] = 1;
        }
        ?>

        <form method="POST">
            <input type="hidden" name="counter" value="<?php echo $_SESSION['counter']; ?>" />
            <input type="submit" name="dodaj" value="Dodaj šifru delatnosti" />
            <input type="submit" name="reset" value="Resetuj na jednu šifru delatnosti" />
            <br/>Sifre delatnosti:<br/>
            <?php
            include_once './dbconnect.php';
            for($i=0; $i<$_SESSION['counter']; $i++){
                ?>
                &emsp;&emsp;<input type='text' name=<?php echo 'sif'.$i; ?>> <br/>
                <?php
            }?>
            <input type="hidden" name="counter1" value="<?php echo $_SESSION['counter1']; ?>" />
            <input type="submit" name="dodaj1" value="Dodaj račun" />
            <input type="submit" name="reset1" value="Resetuj na jedan račun" />
            <br/>Računi:<br/>
            <?php
            include_once './dbconnect.php';
            for($i=0; $i<$_SESSION['counter1']; $i++){
                ?>
                &emsp;&emsp;<input type='text' name=<?php echo 'rac'.$i; ?> placeholder='Račun'> <input type='text' name=<?php echo 'ban'.$i; ?> placeholder='Banka'><br/>
                <?php
            }?>
            <?php
            if(isset($_POST['submit'])){
                $kor_ime = $_SESSION['kor_ime'];
                for($i=0; $i<$_SESSION['counter']; $i++){
                    $temp = $_POST['sif'.$i];
                    $result = mysqli_query($con,"INSERT INTO sifra_delatnosti(sifra, kor_ime) VALUES ('$temp', '$kor_ime')");
                }
                for($i=0; $i<$_SESSION['counter1']; $i++){
                    $temp1 = $_POST['rac'.$i];
                    $temp2 = $_POST['ban'.$i];
                    $result = mysqli_query($con,"INSERT INTO racun(br_rac, banka, kor_ime) VALUES ('$temp1', '$temp2', '$kor_ime')");
                }
            }
            mysqli_close($con);
            ?>
            <input type="submit" name="submit" value="Pošalji" />
        </form>
    </body>
</html>