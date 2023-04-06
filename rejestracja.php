<?php session_start();
ob_start();
?>
<?php
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
//Strona służąca do przesłania danych w celu dodania nowego gościa do bazy użytkowników i gości
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strona rejestracji</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="rejestracja.css">
</head>
<body>
    <div class="all">
    <div class="content">
    <main>
    <div class="part1">
    <h1>Aby założyć konto podaj swoje dane</h1>
    <?php
    if(isset($_SESSION['blad_rej'])){
            if($_SESSION['blad_rej']){
                     echo "<br>Błąd rejestracji.<br><br>";
                     $_SESSION['blad_rej']=0;
            }
        }
    if(isset($_SESSION['login_istnieje'])){
            if($_SESSION['login_istnieje']){
                     echo "<br>Wybrany login jest już użyty.<br><br>";
                     $_SESSION['login_istnieje']=0;
            }
        }
    else{
            echo "";
    }
    ?>
    
    <form class="rejestracja" action="redirect_rej.php" method="POST">
    <br><br>
    Imię <input type="text" name="name"><br><br>
    Nazwisko <input type="text" name="surname"><br><br>
    Login <input type="text" name="login"><br><br>
    Hasło <input type="password" name="password"><br><br>
    <input type="submit" value="Zarejestruj się">
    </form>
    </form>
    </div>
    <div class="part2">
    <a href="index.php">Wróc do głównej strony</a>
    </div>
    </main>
    </div>
    <footer>2022</footer>
    </div>
</body>
</html>
<?php
    ob_end_flush();
?>