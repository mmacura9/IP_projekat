<html>
    <head>
        <title></title>
        <style>
            body {
                background-color: black;
                color: white;
                background-repeat: no-repeat;
                background-size: cover;
                text-align: center;
            }
        </style>
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

            $res1 = mysqli_query($con, "SELECT id, naziv FROM artikal WHERE kor_ime='$kor_ime'");
            ?>
            <center>
            <table>
                <form method="post">
                <?php
            $i = 0;
            while($row = mysqli_fetch_assoc($res1)){
                ?>
                    <tr>
                        <td><?php echo $row['naziv']; ?></td><input type='hidden' name=<?php echo 'id'.$i; ?> value=<?php echo $row['id']; ?>>
                <?php
                    $result = mysqli_query($con, "SELECT DISTINCT lok FROM kasa WHERE kor_ime='$kor_ime'");
                    while($row1 = mysqli_fetch_assoc($result)){
                        ?>
                        <td> <input type='submit' name=<?php echo 'lokacija'.$i; ?> value=<?php echo $row1['lok']; ?>> </td>
                        <?php
                    }
                ?>
                    </tr>
                
                <?php
                    $i++;
                }
                ?>
                </form>
            </table>
            
        <?php
            for($j=0; $j<$i; $j++){
                if(isset($_POST['lokacija'.$j])){
                    $lok = $_POST['lokacija'.$j];
                    $id_art = $_POST['id'.$j];
                    ?>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Nabavna cena: </td>
                                <td> <input type='text' name='nabavna'></td>
                            </tr>
                            <tr>
                                <td>Prodajna cena: </td>
                                <td> <input type='text' name='prodajna'></td>
                            </tr>
                            <tr>
                                <td>Stanje lagera: </td>
                                <td> <input type='text' name='lager'></td>
                            </tr>
                            <tr>
                                <td>Minimalna željena količina: </td>
                                <td> <input type='text' name='min_kol'></td>
                            </tr>
                            <tr>
                                <td>Maksimalna željena količina: </td>
                                <td> <input type='text' name='max_kol'></td>
                            </tr>
                        </table>
                        <input type='submit' name='unesi1' value='Unesi cenu'>
                    </form>
                    <?php
                    if(isset($_POST['unesi1'])){
                        $nabavna = $_POST['nabavna'];
                        $prodajna = $_POST['prodajna'];
                        $lager = $_POST['lager'];
                        $min_kol = $_POST['min_kol'];
                        $max_kol = $_POST['max_kol'];
                        if ($nabavna!='' && $prodajna!='' && $lager!='' && $min_kol!='' && $max_kol!=''){
                            $res10 = mysqli_query($con, "INSERT INTO cena(id_art, lok, nabavna_cena, prodajna_cena, stanje_lagera, min_kol, max_kol, kor_ime) VALUES ('$id_art', '$lok', '$nabavna', '$prodajna', '$lager', '$min_kol', '$max_kol', '$kor_ime')");
                        }
                    }
                }
            }
            $res = mysqli_query($con, "SELECT artikal.naziv as 'naziv', cena.* FROM cena, artikal WHERE cena.kor_ime='$kor_ime' and cena.id_art=artikal.id");
            ?>
            <table>
                <tr><th>Naziv artikla</th><th>Lokacija</th><th>Nabavna cena</th><th>Prodajna cena</th><th>Stanje lagera</th><th>Minimalna željena količina</th><th>Maksimalna željena količina</th></tr>
            <?php
            while($row = mysqli_fetch_assoc($res)){
                ?>
                <tr>
                    <td>
                        <?php echo $row['naziv']; ?>
                    </td>
                    <td>
                        <?php echo $row['lok']; ?>
                    </td>
                    <td>
                        <?php echo $row['nabavna_cena']; ?>
                    </td>
                    <td>
                        <?php echo $row['prodajna_cena']; ?>
                    </td>
                    <td>
                        <?php echo $row['stanje_lagera']; ?>
                    </td>
                    <td>
                        <?php echo $row['min_kol']; ?>
                    </td>
                    <td>
                        <?php echo $row['max_kol']; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
            mysqli_close($con);
        ?>
        </center>
    </body>
</html>