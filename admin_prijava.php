<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
        <h2>Prijava administratora: </h2>
        <?php include_once './dbconnect.php'; ?>
        <form name="prijava" method="post" action="" onsubmit="return proveraPrijava();">
            Korisničko ime: <input type="text" name="korime">
            Lozinka: <input type="password" name="lozinka">
            <input type="submit" name='prijava' value="Prijava">
        </form>
        
        <?php
            include_once './dbconnect.php';
            if(isset($_POST['prijava'])){
                $korime = $_POST['korime'];
                $loz = $_POST['lozinka'];
                $res0 = mysqli_query($con, "select kor_ime from admin where kor_ime='$korime' and lozinka='$loz'");
                if (mysqli_num_rows($res0)>0) {
                    session_start();
                    $_SESSION['kor_ime'] = $korime;
                    $_SESSION['lozinka'] = $loz;
                    $_SESSION['tip'] = 'admin';
                    header('Location: ./p_admin.php');
                }
                else {
                    echo "<span style='color: red'>Loše korisničko ime ili šifra</span>";
                }
            }
            mysqli_close($con);
        ?>
        </div>
        
    </body>
</html>