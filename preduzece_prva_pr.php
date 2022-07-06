<html>
    <head>
        <title></title>
        <script></script>
        <link rel="stylesheet" type="text/css" href="style.css">
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

        if(!isset($_SESSION['counter2'])) {
            $_SESSION['counter2'] = 1;
        }

        if(isset($_POST['dodaj'])) {
            ++$_SESSION['counter'];
        }

        if(isset($_POST['dodaj1'])) {
            ++$_SESSION['counter1'];
        }

        if(isset($_POST['dodaj2'])) {
            ++$_SESSION['counter2'];
        }

        if(isset($_POST['reset'])) {
            $_SESSION['counter'] = 1;
        }

        if(isset($_POST['reset1'])) {
            $_SESSION['counter1'] = 1;
        }

        if(isset($_POST['reset2'])) {
            $_SESSION['counter2'] = 1;
        }
        ?>

        <form method="POST" id="forma">
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
            for($i=0; $i<$_SESSION['counter1']; $i++){
                ?>
                &emsp;&emsp;<input type='text' name=<?php echo 'rac'.$i; ?> placeholder='Račun'> <input type='text' name=<?php echo 'ban'.$i; ?> placeholder='Banka'><br/>
                <?php
            }?>
            <input type="hidden" name="counter2" value="<?php echo $_SESSION['counter2']; ?>" />
            <input type="submit" name="dodaj2" value="Dodaj kasu" />
            <input type="submit" name="reset2" value="Resetuj broj kasa na jedan" />
            <br/>Fiskalne kase:<br/>
            <?php
            for($i=0; $i<$_SESSION['counter2']; $i++){
                ?>
                &emsp;&emsp;<input type='text' name=<?php echo 'lok'.$i; ?> placeholder='Lokacija'> 
                Tip kase: <select name=<?php echo 'tipovi'.$i; ?>>
                        <option value='1' name='tip1'> Tip 1 </option>
                        <option value='2' name='tip2'> Tip 2 </option>
                        <option value='3' name='tip3'> Tip 3  </option>
                        <option value='4' name='tip4'> Tip 4 </option>
                    </select> </br>
                <?php
            }?>
            Da li ste u sistemu PDV-a? <input type='checkbox' name='pdv'><br/>
            <input type="submit" name="submit" value="Pošalji" />
            <?php
            if(isset($_POST['submit'])){
                $kor_ime = $_SESSION['kor_ime'];
                $ok1 = false;
                for($i=0; $i<$_SESSION['counter']; $i++){
                    $temp = $_POST['sif'.$i];
                    if($temp!=''){
                        $ok1 = true;
                        break;
                    }
                }
                $ok2 = false;
                for($i=0; $i<$_SESSION['counter1']; $i++){
                    $temp1 = $_POST['rac'.$i];
                    $temp2 = $_POST['ban'.$i];
                    if($temp1!='' && $temp2!=''){
                        $ok2 = true;
                        break;
                    }
                        
                }
                $ok3 = false;
                for($i=0; $i<$_SESSION['counter2']; $i++){
                    $temp1 = $_POST['tipovi'.$i];
                    $temp2 = $_POST['lok'.$i];
                    if($temp1!='' && $temp2!=''){
                        $ok3 = true;
                        break;
                    }
                }
                if($ok1 && $ok2 && $ok3){
                    for($i=0; $i<$_SESSION['counter']; $i++){
                        $temp = $_POST['sif'.$i];
                        if($temp!='')
                            $result = mysqli_query($con,"INSERT INTO sifra_delatnosti(sifra, kor_ime) VALUES ('$temp', '$kor_ime')");
                    }
                    for($i=0; $i<$_SESSION['counter1']; $i++){
                        $temp1 = $_POST['rac'.$i];
                        $temp2 = $_POST['ban'.$i];
                        if($temp1!='' && $temp2!='')
                            $result = mysqli_query($con,"INSERT INTO racun(br_rac, banka, kor_ime) VALUES ('$temp1', '$temp2', '$kor_ime')");
                            
                    }
                    for($i=0; $i<$_SESSION['counter2']; $i++){
                        $temp1 = $_POST['tipovi'.$i];
                        $temp2 = $_POST['lok'.$i];
                        if($temp1!='' && $temp2!='')
                            $result = mysqli_query($con,"INSERT INTO kasa(kor_ime, lok, tip) VALUES ('$kor_ime','$temp2','$temp1')");
                    }
                    if($_POST['pdv'])
                        $result = mysqli_query($con, "UPDATE preduzece SET PDV=1 WHERE kor_ime='$kor_ime'");
                    else
                        $result = mysqli_query($con, "UPDATE preduzece SET PDV=0 WHERE kor_ime='$kor_ime'");
                    mysqli_close($con);
                    header('Location: ./p_preduzece.php');
                }
                
            }
            mysqli_close($con);
            ?>
            
        </form>
    </body>
</html>