<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if(isset($_SESSION['managerZalogowany'])){
    if($_SESSION['managerZalogowany']){}
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
    <title>Strona managera</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="style.php" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="manager.css">
</head>
<body>
    <div class="content">
    <header>
        <div class="part1">
<?php
if(isset($_SESSION['manager'])){
    if($_SESSION['manager']){
        echo "<h1>Zalogował się manager ".$_SESSION['managerImie']."</h1>";
        //$_SESSION['manager']=0;
}
}
?>
<!--<a href="index.php">Wróc do głównej strony</a><br>-->
<form action="index.php" method="post">
<input type="submit" name="wylogujManager"value="Wyloguj się" />
</form>
</form>
</div>
<div class="part2">
<h2>Pokoje hotelowe</h2>
<?php
        if(isset($_SESSION['sukces_zam'])){
            if($_SESSION['sukces_zam']){
                     echo "<u>Dane poprawne, gość zameldowany.</u>";
                     $_SESSION['sukces_zam']=0;
            }
        }
        if(isset($_SESSION['sukces_wym'])){
            if($_SESSION['sukces_wym']){
                    echo "<b><u>Dane poprawne, gość wymeldowany.</b></u>";
                     $_SESSION['sukces_wym']=0;
                }
        }
?>
<table>
<?php
$result = mysqli_query($link,"SELECT * FROM rooms");
if (!$result) {
printf("Query failed: %s\n", mysqli_error($link));
}
while($row=mysqli_fetch_assoc($result))
if($row['WOLNY']=="TAK" && $row['CZYSTO']=="TAK"){
    printf("<tr><td class='wolny'>%s</td><td>%s</td><td>%s</td></tr>","<a href='manager.php?zameldujzulicy=".$row['NR_POK']."'>Pokój nr ".$row['NR_POK']."</a>","","<p>Czy pokój jest czysty? ".$row['CZYSTO']."</p>");
}
else if($row['WOLNY']=="TAK" && $row['CZYSTO']=="NIE"){
    printf("<tr><td class='wolny'>%s</td><td>%s</td><td>%s</td></tr>","Pokój nr ".$row['NR_POK']."","","Czy pokój jest czysty? ".$row['CZYSTO']."");
}
else{
    if($row['ZAMELDOWANY']=="NIE"){
        printf("<tr><td class='rezer'>%s</td><td>%s</td><td>%s</td></tr>","<a href='manager.php?zamelduj=".$row['NR_POK']."'>Pokój nr ".$row['NR_POK']."</a>","","<p>Czy pokój jest czysty? ".$row['CZYSTO']."</p>");
    }
    else{
        printf("<tr><td class='zajety'>%s</td><td>%s</td><td>%s</td></tr>","<a href='manager.php?wymelduj=".$row['NR_POK']."'>Pokój nr ".$row['NR_POK']."</a>","","<p>Czy pokój jest czysty? ".$row['CZYSTO']."</p>");
    }
}
?>
</table>
<br>
<div class="legenda"><p>Legenda: </p><p class="wolne">wolny</p><p class="rezerwacja">rezerwacja</p><p class="zajete">zajęty</p></div>
<br><a href="list.php">Lista gości</a>
</div>
</header>
<main>
<article id="zameldowania"><h3>Zamelduj gościa </h3></article>
<article id="zameldowaniabezr"><h3>Zamelduj gościa bez rezerwacji</h3></article>
<article id="wymeldowania"><h3>Wymelduj gościa</h3></article>
</main>
<?php

?>
<?php
if(isset($_GET['zamelduj'])){
    $_SESSION['zamelduj']=$_GET['zamelduj'];
    unset($_SESSION['wymelduj']);
    unset($_SESSION['zameldujzulicy']);
}
if(isset($_GET['wymelduj'])){
    $_SESSION['wymelduj']=$_GET['wymelduj'];
    unset($_SESSION['zameldujzulicy']);
    unset($_SESSION['zamelduj']);
}
if(isset($_GET['zameldujzulicy'])){
    $_SESSION['zameldujzulicy']=$_GET['zameldujzulicy'];
    unset($_SESSION['wymelduj']);
    unset($_SESSION['zamelduj']);
}
if(isset($_SESSION['zamelduj']))
{      

        echo '<script type="text/javascript">document.getElementById("zameldowania").innerHTML = "';
        echo "<h3>Zamelduj gościa</h3>";
        if(isset($_SESSION['blad_zam'])){
            if($_SESSION['blad_zam']){
                    echo "<br>Nastąpił błąd podczas dokonywania zameldowania.";
                    $_SESSION['blad_zam']=0;
            }
        }
        echo "<form class='zameldowanie' action='redirect_zam.php' method='post'>";
        echo "<p>Numer pokoju: ".$_SESSION['zamelduj']."</p>";
        echo "<p>Imię gościa <input type='text' name='imie'></p>";
        echo "<p>Nazwisko gościa <input type='text' name='nazwisko'></p>";
        echo "<p>Data przyjazdu <input type='date' name='przyjazd' min=".date('Y-m-d')."></p>";
        echo "<p><input type='submit' value='Zamelduj'></p>";
        echo "</form>";
        echo '";</script>';
        
}
?>
<?php
?>
<?php
if(isset($_SESSION['zameldujzulicy']))
{      
        echo '<script type="text/javascript">document.getElementById("zameldowaniabezr").innerHTML = "';
        echo "<h3>Zamelduj gościa bez rezerwacji</h3>";
        if(isset($_SESSION['blad_zam'])){
            if($_SESSION['blad_zam']){
                    echo "<br>Nastąpił błąd podczas dokonywania zamelodwania.";
                    $_SESSION['blad_zam']=0;
            }
        }
        echo "<form class='zameldowanie' action='redirect_zam2.php' method='post'>";
        echo "<p>Numer pokoju: ".$_SESSION['zameldujzulicy']."</p>";
        echo "<p>Imię gościa <input type='text' name='imie'></p>";
        echo "<p>Nazwisko gościa <input type='text' name='nazwisko'></p>";
        echo "<p>Data przyjazdu: ".date('Y-m-d')."</p>";
        echo "<p>Data wyjazdu <input type='date' name='wyjazd' min=".date('Y-m-d')."><br><br></p>";
        echo "<p><input type='submit' value='Zamelduj'></p>";
        echo "</form>";
        echo '";</script>';      
}
?>
<?php

?>
<?php
if(isset($_SESSION['wymelduj']))
{     
        echo '<script type="text/javascript">document.getElementById("wymeldowania").innerHTML = "';
        echo "<h3>Wymelduj gościa</h3>";
        if(isset($_SESSION['blad_wym'])){
            if($_SESSION['blad_wym']){
                    echo "<br>Nastąpił błąd podczas dokonywania wymeldowania.";
                    $_SESSION['blad_wym']=0;
            }
        }
        echo "<form class='wymeldowanie' action='redirect_wym.php' method='post'>";
        echo "<p>Numer pokoju: ".$_SESSION['wymelduj']."</p>";
        echo "<p>Imię gościa <input type='text' name='imie'></p>";
        echo "<p>Nazwisko gościa <input type='text' name='nazwisko'></p>";
        echo "<p>Data wyjazdu <input type='date' name='wyjazd' min=".date('Y-m-d')."></p>";
        echo "<p><input type='submit' value='Wymelduj'></p>";
        echo "</form>";
        echo '";</script>';  
}
else{
}
?>
</div>
<footer>2022</footer>
</body>
<script>
    $(function(){
        $('a').click(function () {
        $('body').load($(this).attr('href'));
        return false;
    });});
</script>
</html>
<?php
    $link->close();
    ob_end_flush();
?>