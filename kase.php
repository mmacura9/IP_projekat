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
            include_once './meni.php';
            include_once './dbconnect.php';
            session_start();
            if(!isset($_SESSION['kor_ime'])){
                header('Location: ./index.php');
            }
            if($_SESSION['tip']!='preduzece'){
                header('Location: ./index.php');
            }
            $kor_ime = $_SESSION['kor_ime'];

            $result = mysqli_query($con,"select * from kasa where kor_ime='$kor_ime'");
            
            if($result){?>
                <table>
                <tr><th>Lokacija</th><th>Tip</th></tr>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <form name="odobri" method="post" action="">
                        
                        <tr>
                            <input type="hidden" name="lok" value="<?php echo $row['lok']; ?>" />
                            <input type="hidden" name="tip" value="<?php echo $row['tip']; ?>" />
                            <td> <?php echo $row['lok'];?> </td>
                            <td> <?php echo $row['tip'];?> </td>
                            <td> <input type="submit" name="obrisi" value="Obriši" /></td>
                        </tr>

                    </form>
                    <?php
                }
                ?>
                </table>
                <?php
                if(isset($_POST['obrisi'])){
                    $lok = $_POST['lok'];
                    $tip = $_POST['tip'];
                    $result = mysqli_query($con,"DELETE FROM kasa WHERE lok = '$lok' AND tip = '$tip'");
                    header('Location: ./kase.php');
                }
            }
            else {
                echo "<span style='color: red'>GREŠKA</span>";
            }
        ?>
        <br/>
        Dodaj kasu: <br/>
        <form name="dodati" method="post" action="">
        <tr><td><input type='text' name='lok' placeholder='Lokacija'> </td>
        <td>Tip kase: <select name='tipovi'>
            <option value='1' name='tip1'> Tip 1 </option>
            <option value='2' name='tip2'> Tip 2 </option>
            <option value='3' name='tip3'> Tip 3  </option>
            <option value='4' name='tip4'> Tip 4 </option>
        </select> </td></tr>
        <tr><input type="submit" name="dodaj" value="Dodaj"></tr>
        </form>
        <?php
            if(isset($_POST['dodaj'])) {
                $tip = $_POST['tipovi'];
                $lok = $_POST['lok'];
                $result = mysqli_query($con,"select * from kasa where kor_ime='$kor_ime'");
                $ok = false;
                while($row = mysqli_fetch_assoc($result)) {
                    if($row['lok'] == $lok && $row['tip'] == $tip){
                        $ok = true;
                        break;
                    }
                }
                if($lok != '' && $ok==false){
                    $result = mysqli_query($con,"INSERT INTO kasa(kor_ime, lok, tip) VALUES ('$kor_ime','$lok','$tip')");
                    header('Location: ./kase.php');
                }
            }
            mysqli_close($con);
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>