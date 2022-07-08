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
        <table>
            <tr><th>Ime i prezime</th><th>email</th><th>Naziv firme</th><th>PIB</th></tr>
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
            $result = mysqli_query($con, "select * from narucioci where kor_ime_glavni='$kor_ime'");
                if($result){
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td> <?php echo $row['Ime'].' '.$row['Prezime'];?> </td>
                            <td> <?php echo $row['email'];?> </td>
                            <td> <?php echo $row['naziv'];?> </td>
                            <td> <?php echo $row['pib'];?> </td>
                        </tr>
                        <?php
                    }
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
            mysqli_close($con);
        ?>
        </table>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>