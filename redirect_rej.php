<?php
session_start();
ob_start();
require('funkcje.php');
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
//Dodawanie przesłanych danych z rejestracja.php do odpowiednich baz danych
}
if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['surname']) && is_string($_POST['login']) && is_string($_POST['password']) && is_string($_POST['name']) && is_string($_POST['surname']))
{
    $login = zabezpieczenie($_POST['login']);
    $pass = zabezpieczenie($_POST['password']);
    $name=zabezpieczenie($_POST['name']);
    $surname=zabezpieczenie($_POST['surname']);
    $nr_pok=0;
    $zameldowany="NIE";
    $check = mysqli_query($link,"SELECT * FROM users WHERE login='$_POST[login]'");
    $check2 = mysqli_query($link,"SELECT * FROM guests WHERE login='$_POST[login]'");
    $check=mysqli_fetch_assoc($check);
    $check2=mysqli_fetch_assoc($check2);
    if($check || $check2){
        $_SESSION['login_istnieje']=1;
        header("Location: rejestracja.php");
    }
    else{
        $check3=mysqli_query($link,"SELECT * FROM guests WHERE IMIE='$_POST[name]' AND NAZWISKO='$_POST[surname]' AND NR_POK!=0");
        $check3=mysqli_fetch_assoc($check3);
        if($check3){
            $hash=hash('sha256',$pass);
            $sql3 = "UPDATE guests SET LOGIN=?, PASSWORD=? WHERE IMIE='$_POST[name]' AND NAZWISKO='$_POST[surname]'";
            $sql4 = "INSERT INTO users(login,password,imie,nazwisko) VALUES(?,?,?,?)";
            $stmt3 = $link->prepare($sql3);
            $stmt4 = $link->prepare($sql4);
            $stmt3->bind_param("ss", $login, $hash);
            $stmt4->bind_param("ssss", $login, $hash,$name,$surname);
            $result3 = $stmt3->execute();
            $result4 = $stmt4->execute();
            if(!$result3 || !$result4){
                header('location: index.php'); 
                $_SESSION['blad_rej']=1;
            }
            else{
                header('location: index.php'); 
                $_SESSION['sukces_dodanie']=1;
            }
        }
        else{
            $hash=hash('sha256',$pass);
            $sql = "INSERT INTO users(login,password,imie,nazwisko) VALUES(?,?,?,?)";
            $sql2 = "INSERT INTO guests(login,password,imie,nazwisko,nr_pok,zameldowany) VALUES(?,?,?,?,?,?)";
            $stmt = $link->prepare($sql);
            $stmt2 = $link->prepare($sql2);
            $stmt->bind_param("ssss", $login, $hash,$name,$surname);
            $stmt2->bind_param("ssssis", $login, $hash,$name,$surname,$nr_pok,$zameldowany);
            $result = $stmt->execute();
            $result2 = $stmt2->execute();
            if(!$result || !$result2){
                header('location: index.php'); 
                $_SESSION['blad_rej']=1;
            }
            else{   
                header('location: index.php'); 
                $_SESSION['sukces']=1;
            }
            
        }
    }
    $stmt->close();
}
else{
    header('location: rejestracja.php');
    $_SESSION['blad_rej']=1;
}
$link->close();
?>
<?php
ob_end_flush();
?>