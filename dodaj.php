<html>
    <head>
        <title></title>
        <script></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        
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
        ?>
        <form method="post">
            Pretraga: <input type="text" name="pretraga">
            <input type="submit" name="posalji" value="Pretraži">
        </form>
        <?php
            $pretraga = '';
            if(isset($_POST['posalji'])){
                $pretraga = $_POST['pretraga'];
            }
            $result = mysqli_query($con, "SELECT id, naziv FROM artikal");
            if($pretraga!=''){
                $result = mysqli_query($con, "SELECT id, naziv FROM artikal WHERE naziv='$pretraga'");
            }
            ?>
            <table>
            <?php
            while($row= mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <form method="post">
                        <td><?php echo $row['naziv']; ?></td><td><input type='submit' name='dodaj' value='dodaj'></td>
                        <input type='hidden' name='artikal' value=<?php echo $row['id']; ?>>
                    </form>
                </tr>
                <?php
            }
            if(isset($_POST['artikal'])){
                $id_art = $_POST['artikal'];
                $res = mysqli_query($con, "SELECT * FROM art_kat WHERE id_art = '$id_art'");
                if(mysqli_fetch_assoc($res)) {
                    echo "Ovaj artikal je već ubačen u neku kategoriju";
                }
                else {
                    $id_kat = $_SESSION['kategorija'];
                    mysqli_query($con, "INSERT INTO art_kat(id_art, id_kat) VALUES('$id_art', '$id_kat')");
                }
            }
            ?>
            </table>
            <?php
            mysqli_close($con);
        ?>
    </body>
</html>