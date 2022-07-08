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
            session_start();
            if(!isset($_SESSION['kor_ime'])){
                header('Location: ./index.php');
            }
            if($_SESSION['tip']!='preduzece'){
                header('Location: ./index.php');
            }
            $kor_ime = $_SESSION['kor_ime'];

            $result = mysqli_query($con,"select * from preduzece where kor_ime='$kor_ime'");
            
            if($result){?>
                <table>
                <tr>
                <th>Ime i prezime</th><th>Korisničko ime</th><th>Broj telefona</th><th>email</th><th>Naziv firme</th><th>Država</th><th>Grad</th>
                <th>Poštanski broj</th><th>Ulica i broj</th><th>PIB</th><th>Matični broj</th><th>PDV</th>
                </tr>
                <?php
                $row = mysqli_fetch_assoc($result);
                if($row){
                    ?>
                    <form name="odobri" method="post" action="">
                        
                        <tr>
                            <td> <?php echo $row['ime']." ".$row['prezime'];?> </td>
                            <td> <?php echo $row['kor_ime'];?> </td>
                            <td> <?php echo $row['br_tel'];?> </td>
                            <td> <?php echo $row['email'];?> </td>
                            <td> <?php echo $row['naziv'];?> </td>
                            <td> <?php echo $row['drzava'];?> </td>
                            <td> <?php echo $row['grad'];?> </td>
                            <td> <?php echo $row['post_broj'];?> </td>
                            <td> <?php echo $row['ulica_br'];?> </td>
                            <td> <?php echo $row['PIB'];?> </td>
                            <td> <?php echo $row['maticni_br'];?> </td>
                            <td> <?php 
                            if($row['PDV'])
                                echo 'da';
                            else
                                echo 'ne';
                            
                            ?> </td>
                        </tr>

                    </form>
        <?php
                }
            }
        ?>
        </table>
        <br/>
        <br/>
        <div class='glavni'>
        <form name="registracija" method="post">
        <table>
            <tr>
            <td>Ime odgovornog lica:</td><td> <input type="text" name="ime"> </td>
            </tr>
            <tr>
            <td>Prezime odgovornog lica: </td><td><input type="text" name="prezime"> </td>
            </tr>
            <tr>
            <td>Kontakt telefon:</td> <td><input type="text" name="broj_tel"></td>
            </tr>
            <tr>
            <td>e-mail:</td><td> <input type="text" name="email"></td>
            </tr>
        </table>
        <input type="submit" name="promeni" value="Promeni">
        </form>
        </div>
            <br/>
        <?php
        if(isset($_POST["promeni"])){
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $broj_tel = $_POST['broj_tel'];
            $email = $_POST['email'];
            if($ime != '')
                $result = mysqli_query($con, "UPDATE preduzece SET ime='$ime' WHERE kor_ime='$kor_ime'");
            if($prezime != '')
                $result = mysqli_query($con, "UPDATE preduzece SET prezime='$prezime' WHERE kor_ime='$kor_ime'");
            if($broj_tel != '')
                $result = mysqli_query($con, "UPDATE preduzece SET br_tel='$broj_tel' WHERE kor_ime='$kor_ime'");
            if($email != '')
                $result = mysqli_query($con, "UPDATE preduzece SET email='$email' WHERE kor_ime='$kor_ime'");
            header('Location: ./opsti_podaci.php');
        }
        mysqli_close($con);
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>