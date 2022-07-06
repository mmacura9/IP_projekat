<html>
    <head>
        <title></title>
        <script></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class ="header">
            <a href='logout.php'> logout </a>
        </div>
        <div class="meni">
            <a href='promeni_sifru.php'> promena sifre </a>
        </div>
        <div class="ostalo">
            <table class="tabela">
                <tr>
                    <th> Ime i prezime </th>
                    <th> Korisničko ime </th>
                    <th> email </th>
                    <th> Naziv firme </th>
                    <th> PIB </th>
                </tr>
            <?php
                include_once './dbconnect.php';
                session_start();
                if(!isset($_SESSION['kor_ime'])){
                    header('Location: ./index.php');
                }
                if($_SESSION['tip']!='admin'){
                    header('Location: ./index.php');
                }
                $result = mysqli_query($con, "select * from preduzece where status='na cekanju'");
                if($result){
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form name="odobri" method="post" action="">
                            <tr>
                                <td> <?php echo $row['ime'].' '.$row['prezime'];?> </td>
                                <td> <input type='hidden' value =<?php echo $row['kor_ime'];?> name='kor_ime'> <?php echo $row['kor_ime'];?> </td>
                                <td> <?php echo $row['email'];?> </td>
                                <td> <?php echo $row['naziv'];?> </td>
                                <td> <?php echo $row['PIB'];?> </td>
                                <td> <input type='submit' name='prihvati' value='prihvati'> </td>
                                <td> <input type='submit' name='odbij' value='odbij'> </td>
                            </tr>
                        </form>
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
                else {
                    echo "<span style='color: red'>GREŠKA</span>";
                }
                mysqli_close($con);
            ?>
            </table>
            </div>
            <div class="footer"></div>
    </body>
</html>