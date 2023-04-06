<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if(isset($_SESSION['goscZalogowany'])){
    if($_SESSION['goscZalogowany']){
        $check = mysqli_query($link,"SELECT * FROM guests WHERE login='$_SESSION[goscLogin]'");
        $check=mysqli_fetch_assoc($check);
        if($check['NR_POK']!=0){
            if($check['ZAMELDOWANY']=="TAK"){
                header('Location: hotel_guest.php');
            }
            else{}
        }
        else{
            header('Location: guest.php');
        }
    }
    else{
        header('Location: index.php');
    }
}
else{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strona gościa</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="style.php" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="rezerwacja.css">
</head>
<body>
    <div class="all">
    <div class="content">
    <main>
    <div class="part1">
<?php
if(isset($_SESSION['gosc'])){
    if($_SESSION['gosc']){
        echo "<h1>Zalogował się gość ".$_SESSION['goscImie']." ".$_SESSION['goscNazwisko']."</h1>";
        //$_SESSION['gosc']=0;
}
}
if(isset($_SESSION['sukces_rez'])){
    if($_SESSION['sukces_rez']){
        echo "<h2>Udało Ci się zarezerwować wybrany pokój</h2>";
        $_SESSION['sukces_rez']=0;
}
}
else{}
?>
<form action="index.php" method="post">
<input type="submit" name="wylogujGosc"value="Wyloguj się" />
</form>
</div>
<div class="part2">
<h3>Informacje o rezerwacji</h3>
<?php
//Wyświetlanie informacji o rezerwacji
$result = mysqli_query($link,"SELECT * FROM guests WHERE LOGIN='$_SESSION[goscLogin]'");
if (!$result) {
printf("Query failed: %s\n", mysqli_error($link));
}
$row=mysqli_fetch_assoc($result);
?>
<ul>
    <li>Numer pokoju: <?php echo $row['NR_POK'];?></li>
    <li>Data przyjazdu: <?php echo $row['DATA_PRZYJAZDU'];?></li>
    <li>Data wyjazdu: <?php echo $row['DATA_WYJAZDU'];?></li>
</ul>
</div>
<div class="part3">
<h3>Czekamy na Twoje przybycie!</h3>
</div>
</main>
</div>
<footer>2022</footer>
</div>
</body>
</html>
<?php
    $link->close();
    ob_end_flush();
?>