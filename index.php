<?php session_start();
ob_start();
//Automatyczne przenoszenie na odpowiednią stronę jeżeli sesja zalogowania jest aktywna
if(isSet($_POST['wylogujPracownik'])){
    $_SESSION['pracownikZalogowany'] = 0;
}
if(isSet($_POST['wylogujGosc'])){
    $_SESSION['goscZalogowany'] = 0;
    unset($_SESSION['wybranyPokoj']);
}
if(isSet($_POST['wylogujManager'])){
    $_SESSION['managerZalogowany'] = 0;
    unset($_SESSION['zamelduj']);
    unset($_SESSION['zameldujzulicy']);
    unset($_SESSION['wymelduj']);
}
if(isset($_SESSION['pracownikZalogowany'])){
    if($_SESSION['pracownikZalogowany']){
        header('Location: employee.php');
    }
}
if(isset($_SESSION['goscZalogowany'])){
    if($_SESSION['goscZalogowany']){
        header('Location: guest.php');
    }
}
if(isset($_SESSION['managerZalogowany'])){
    if($_SESSION['managerZalogowany']){
        header('Location: manager.php');
    }
}
else{}
//W przeciwnym wypadku, przeniesienie do strony logowania(rejestracji nowego gościa)
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strona logowania</title>   
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="content">   
<header>
    <div class="banner">
        <p>Hotel "Czarny Potok"</p>
</header>

<main>
    <div class="part1"></div>
    <div class="part2">
    <div class="part2_1">
    <a href="rejestracja.php">Przejdź do strony rejestracji dla nowych gości hotelowych</a><br>
    </div>
    <div class="part2_2">
    <h1>Logowanie do systemu hotelowego</h1>
    <?php
        if(isset($_SESSION['sukces'])){
                if($_SESSION['sukces']){
                         echo "<br>Zarejestrowałeś się. Teraz zaloguj się do systemu.";
                         $_SESSION['sukces']=0;
                }
        }
        if(isset($_SESSION['sukces_dodanie'])){
            if($_SESSION['sukces_dodanie']){
                     echo "<br>Udało się powiązać konto z gościem hotelowym.";
                     $_SESSION['sukces_dodanie']=0;
            }
    }
        if(isset($_SESSION['blad'])){
            if($_SESSION['blad']){
                     echo "<br>Błąd logowania.";
                     $_SESSION['blad']=0;
            }
        }
        else{
            echo "";
        }
        ?>   
    <form class="logowanie" action="redirect1.php" method="post">
        Login <input type="text" name="login"><br><br>
        Hasło <input type="password" name="password"><br><br>
        <input type="submit" name="zaloguj" value="Zaloguj">
    </form> 
    </div>
    </div> 
    <div class="part3"></div> 
    </main>
    </div>
    <footer>2022</footer>
</body>
</html>
<?php
    ob_end_flush();
?>