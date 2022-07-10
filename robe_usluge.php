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

            $result = mysqli_query($con, "SELECT COUNT(*) AS 'broj' FROM artikal WHERE kor_ime='$kor_ime'");
            $row = mysqli_fetch_assoc($result);
            $broj = $row['broj'];
            echo "<br/>Ukupan broj artikala: ".$broj;
            if(!isset($_GET['trenutni'])){
                $_GET['trenutni'] = 0;
            }
            $trenutni = $_GET['trenutni'];
            $broj_paginacija = (int)($broj/10);
            ?>
                <table>
                    <tr><th>Sifra artikla</th><th>Naziv artikla</th><th>Jedinica mere</th><th>Stopa Poreza</th><th>Proizvođač</th></tr>
                <?php
                $result = mysqli_query($con, "SELECT id, sifra_ar, naziv, jedinica, stopa_poreza, proizvodjac FROM artikal WHERE kor_ime='$kor_ime' LIMIT 10 OFFSET $trenutni");

                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <form name="forma" method="post" action="">
                            <td><?php echo $row['sifra_ar']; ?></td>
                            <td><?php echo $row['naziv']; ?></td>
                            <td><?php echo $row['jedinica']; ?></td>
                            <td><?php echo $row['stopa_poreza']; ?></td>
                            <td><?php echo $row['proizvodjac']; ?></td>
                            <input type='hidden' name="id" value=<?php echo $row['id']; ?>>
                            <td> <input type='submit' name='izmeni' value='Izmeni'> </td>
                            <td> <input type='submit' name='obrisi' value='Obriši'> </td>
                        </form>
                    </tr>
                <?php
                }
                if(isset($_POST['obrisi'])){
                    $id = $_POST['id'];
                    $res = mysqli_query($con, "DELETE FROM artikal WHERE id='$id'");
                    header('Location: robe_usluge.php');
                }
                ?>
                </table>
                <a href="robe_usluge.php?trenutni=<?php if($trenutni==0) echo 0; else echo $trenutni-1;?>"> < </a> &nbsp;
                <?php
                    for($i=0; $i<=$broj_paginacija; $i++){
                        ?>
                        <a href="robe_usluge.php?trenutni=<?php echo $i;?>"><?php echo $i+1; ?></a> &nbsp;
                        <?php
                    }
                ?>
                <a href="robe_usluge.php?trenutni=<?php if($trenutni==$broj_paginacija) echo $broj_paginacija; else echo $trenutni+1;?>"> > </a> &nbsp;
            <?php
            $kor_ime = $_SESSION['kor_ime'];
            ?>
            <form name="forma" method="post" action="">
        <div class="footer">
            <img src="efiskalizacija.png" width = '30%'>
        </div>
    </body>
</html>