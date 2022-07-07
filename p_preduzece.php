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
        <a href='promeni_sifru.php'> promena sifre </a>
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
            if(!isset($_SESSION['kor_ime'])){
                header('Location: ./index.php');
            }
            if($_SESSION['tip']!='preduzece'){
                header('Location: ./index.php');
            }
            $kor_ime = $_SESSION['kor_ime'];
            $res0 = mysqli_query($con, "select PDV from preduzece where kor_ime='$kor_ime'");
            $row = mysqli_fetch_assoc($res0);
            if($row['PDV'] == NULL) {
                mysqli_close($con);
                header('Location: ./preduzece_prva_pr.php');
            }
            mysqli_close($con);
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>

        </div>
    </body>
</html>