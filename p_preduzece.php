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
            include_once './dbconnect.php';
            session_start();
            $kor_ime = $_SESSION['kor_ime'];
            $res0 = mysqli_query($con, "select PDV from preduzece where kor_ime='$korime'");
            $row = mysqli_fetch_assoc($result);
            if($row == null) {
                header('Location: ./preduzece_prva_pr.php');
            }
        ?>
    </body>
</html>