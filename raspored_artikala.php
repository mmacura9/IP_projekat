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
        ?>
        <form method="post">
            Formiraj kategoriju: <input type="text" name="kategorija" placeholder="Kategorija"><br/>
            <input type="submit" name="formiraj" value="Formiraj">
        </form>
        <?php
            if(isset($_POST['formiraj'])) {
                $kategorija = $_POST['kategorija'];
                if($kategorija != ''){
                    $result = mysqli_query($con, "SELECT naziv FROM kategorija");
                    $ok = false;
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['naziv'] == $kategorija) {
                            echo "Ova kategorija već postoji";
                            $ok = true;
                            break;
                        }
                    }
                    if(!$ok){
                        $result = mysqli_query($con, "INSERT INTO kategorija(naziv) VALUES ('$kategorija')");
                    }
                }
            }

            $res = mysqli_query($con, "SELECT * FROM kategorija");
            ?>
            <table>
            <?php
            while($row = mysqli_fetch_assoc($res)) {
                ?>
                <form method="post">
                        <tr><td><?php echo $row['naziv']; ?></td><td><input type="submit" name="dodaj" value="Dodaj kategoriju">
                        <input type="hidden" name="id" value=<?php echo $row['id']; ?>></td></tr>
                </form>
                <?php
            }?>
            </table>
            <?php
            if(isset($_POST['dodaj'])){
                $_SESSION['kategorija'] = $_POST['id'];
                $link = "<script>window.open(\"dodaj.php\", \"myWindow\", \"width=1000,height=500\")</script>";
                echo $link;
            }
        ?>
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>