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
        if(!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 1;
        }

        if(isset($_POST['dodaj'])) {
            ++$_SESSION['counter'];
        }    

        if(isset($_POST['reset'])) {
            $_SESSION['counter'] = 1;
        }

        ?>

        <form method="POST">
            <input type="hidden" name="counter" value="<?php echo $_SESSION['counter']; ?>" />
            <input type="submit" name="dodaj" value="Dodaj sifru delatnosti" />
            <input type="submit" name="reset" value="Resetuj na jednu sifru delatnosti" />
            <br/>Sifre delatnosti:<br/>
            <?php
            include_once './dbconnect.php';
            for($i=0; $i<$_SESSION['counter']; $i++){
                ?>
                &emsp;&emsp;<input type='text' name=<?php echo 'sif'.$i; ?>> <br/>
                <?php
            }
            if(isset($_POST['submit'])){
                $kor_ime = $_SESSION['kor_ime'];
                for($i=0; $i<$_SESSION['counter']; $i++){
                    $temp = $_POST['sif'.$i];
                    $result = mysqli_query($con,"INSERT INTO sifra_delatnosti(sifra, kor_ime) VALUES ('$temp', '$kor_ime')");
                }
                //echo 'PRCI KIKU BRE!';
            }
            mysqli_close($con);
            ?>
            <input type="submit" name="submit" value="Pošalji" />
        </form>
    </body>
</html>