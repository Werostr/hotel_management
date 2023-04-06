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
        //Przekierowanie na inną stronę, jeżeli zalogowany użytkownik już dokonał rezerwacji
        $check = mysqli_query($link,"SELECT * FROM guests WHERE login='$_SESSION[goscLogin]'");
        $check=mysqli_fetch_assoc($check);
        if($check['NR_POK']==0){}
        else{
            header('Location: rezerwacja.php');
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
    <link rel="stylesheet" href="guest.css">
</head>
<body>
    <div class="content">
    <header>
    <div class="part1">
<?php
if(isset($_SESSION['gosc'])){
    if($_SESSION['gosc']){
        echo "<h1>Zalogował się gość ".$_SESSION['goscImie']." ".$_SESSION['goscNazwisko']."</h1>";
        //$_SESSION['gosc']=0;
}
}
?>
<form action="index.php" method="post">
<input type="submit" name="wylogujGosc"value="Wyloguj się" />
</form>
</div>
<div class="part2">
<h2>Pokoje hotelowe</h2>
<p>Klikij pokój, który jest zaznaczony jako wolny</p>
<table>
<?php
$result = mysqli_query($link,"SELECT * FROM rooms");
if (!$result) {
printf("Query failed: %s\n", mysqli_error($link));
}
//Wyświetlanie listy pokoi
while($row=mysqli_fetch_assoc($result))
if($row['WOLNY']=="TAK"){
    printf("<tr><td class='wolny'>%s</td></tr>","<a href='setroom.php?wybranyPokoj=".$row['NR_POK']."'>Pokój nr ".$row['NR_POK']."</a>");
}
else{
    printf("<tr><td class='rezer'>%s</td></tr>","Pokój nr ".$row['NR_POK']."");
}
?>
</table>
<br>
<div class="legenda"><p>Legenda: </p><p class="wolne">wolny</p><p class="zarezerwowane">rezerwacja</p></div>
<?php
if(isset($_SESSION['zajetyPokoj'])){
    if($_SESSION['zajetyPokoj']){
             echo "<br><b><u>Pokój, który wybrałeś jest już zarezerwowany.</b></u><br><br>";
             $_SESSION['zajetyPokoj']=0;
    }
}
if(isset($_SESSION['blad_rez'])){
    if($_SESSION['blad_rez']){
            echo "<br>Nastąpił błąd podczas dokonywania rezerwacji.<br><br>";
            $_SESSION['blad_rez']=0;
    }
}
else{
        echo "";
    }

?>
</div>
</header>
<main>
<div class="part3"><h3>Zarezerwuj wolny pokój</h3>
<?php
//Po kliknieciu wolnego pokoju pojawia się pole gdzie możemy zarezerwować wybrany pokój
if(isset($_SESSION['wybranyPokoj']))
{
    echo "<form class='rezerwacja' action='redirect_rez.php' method='post'>";
    echo "Numer pokoju: ".$_SESSION['wybranyPokoj']."<br><br>";
    echo "Data przyjazdu <input type='date' name='przyjazd' min=".date('Y-m-d')."><br><br>";
    echo "Data wyjazdu <input type='date' name='wyjazd' min=".date('Y-m-d')."><br><br>";
    echo "<input type='submit' value='Zarezerwuj'>";
    echo "</form>";
}
else{
}
?>
</div>
</main>
</div>
<footer>2022</footer>
</body>
</html>
<?php
    $link->close();
    ob_end_flush();
?>