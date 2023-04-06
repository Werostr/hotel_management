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
            if($check['ZAMELDOWANY']=="TAK"){}
            else{
                header('Location: rezerwacja.php');
            }
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
    <title>Strona gościa hotelowego</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="style.php" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="hotel_guest.css">
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
        echo "<h2>Witaj w naszym systemie hotelowym.</h2>";
        //$_SESSION['gosc']=0;
}
}
else{}
?>
<form action="index.php" method="post">
<input type="submit" name="wylogujGosc"value="Wyloguj się" />
</form>
</div>
<div class="part2">
<p>Informacje o pobycie</p>
<?php
//Wyświetlanie informacji o pobycie
$result = mysqli_query($link,"SELECT * FROM guests WHERE LOGIN='$_SESSION[goscLogin]'");
if (!$result) {
printf("Query failed: %s\n", mysqli_error($link));
}
$row=mysqli_fetch_assoc($result);
?>
<ul>
    <li>Numer pokoju: <?php echo $row['NR_POK'];?></li>
    <li>Data wyjazdu: <?php echo $row['DATA_WYJAZDU'];?></li>
</ul>
<?php
$result2 = mysqli_query($link,"SELECT * FROM rooms WHERE NR_POK='$row[NR_POK]'");
if (!$result2) {
printf("Query failed: %s\n", mysqli_error($link));
}
$row2=mysqli_fetch_assoc($result2);
if($row2['CZYSTO']=="TAK"){
    printf("<form action='redirect_sprz_guest.php' method='post'>
    <input type = 'hidden' name = 'nr' value = ".$row['NR_POK']." />
    <input type='submit' value='Poproś o posprzątanie'>
    </form>
    ");
}
else{printf("<p style='color:#76ff03'>Wkrótce posprzątamy</p>");}
?>
</div>
<div class="part3">
<p>Życzymy miłego pobytu!</p>
</div>
<main>
</div>
<footer>2022</footer>
</div>
</body>
</html>
<?php
    $link->close();
    ob_end_flush();
?>