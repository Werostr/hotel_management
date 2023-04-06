<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "pracownik", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if(isset($_SESSION['pracownikZalogowany'])){
    if($_SESSION['pracownikZalogowany']){}
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
    <title>Strona pracownika</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
        .pilne{
            background: red;
        }
    </style>
    <link rel="stylesheet" href="employee.css">
</head>
<body>
<div class="all">
<div class="content">
<main>
<div class="part1">
<?php
if(isset($_SESSION['pracownik'])){
    if($_SESSION['pracownik']){
        echo "<h1>Zalogował się pracownik ".$_SESSION['pracownikImie']."</h1>";
        //$_SESSION['pracownik']=0;
    }
}
?>
<!--<a href="index.php">Wróc do głównej strony</a><br>-->
<form action="index.php" method="post">
<input type="submit" name="wylogujPracownik"value="Wyloguj się" />
</form>
</div>
<div class="part2">
<table>
<?php
$result = mysqli_query($link,"SELECT * FROM rooms");
if (!$result) {
printf("Query failed: %s\n", mysqli_error($link));
}
while($row=mysqli_fetch_assoc($result))
if($row['CZYSTO']=="TAK"){
    printf("<tr><td class='czysto'>%s%s</td></tr>","Pokój nr ".$row['NR_POK'].": ", "Czysto");
}
else if($row['CZYSTO']=="NIE"){
    printf("<tr><td class='brudno'>%s%s</td><td>%s</td></tr>","Pokój nr ".$row['NR_POK'].": ", "Do posprzątania",
    "<form class='sprzatanie' action='redirect_sprz.php' method='post'>
    <input type = 'hidden' name = 'nr' value = ".$row['NR_POK']." />
    <input type='submit' value='Wysprzątano'>
    </form>
    ");
}

?>
</table>
<script>
$(function(){
    $('#sprzatanie').click(function(){
        <?php

        ?>
    })
})  
</script>
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