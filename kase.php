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
        <div class="dropdown">
            <button class="dropbtn">Informacije o preduzeću</button>
            <div class="dropdown-content">
                <a href="opsti_podaci.php">Opšti podaci</a>
                <a href="ziro_racuni.php">Žiro računi</a>
                <a href="kase.php">Kase</a>
            </div>
        </div>
        <?php
            include_once './dbconnect.php';
            session_start();
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
                            <td> <?php echo $row['lok'];?> </td>
                            <td> <?php echo $row['tip'];?> </td>
                        </tr>

                    </form>
                    <?php
                }
                ?>
                </table>
                <?php
                if(isset($_POST['prihvati'])){
                    $kor_ime = $_POST['kor_ime'];
                    $res1 = mysqli_query($con, "update preduzece set status='ok' where kor_ime = '$kor_ime'");
                    header("Refresh:0");
                }
                if(isset($_POST['odbij'])){
                    $kor_ime = $_POST['kor_ime'];
                    $res1 = mysqli_query($con, "update preduzece set status='odbijen' where kor_ime = '$kor_ime'");
                    header("Refresh:0");
                }
            }
            else {
                echo "<span style='color: red'>GREŠKA</span>";
            }

            mysqli_close($con);
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>