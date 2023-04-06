<?php
session_start();
ob_start();
require('funkcje.php');
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if (isSet($_POST['zaloguj']))
{
    $login = zabezpieczenie($_POST['login']);
    $pass = zabezpieczenie($_POST['password']);
    $hash = hash('sha256',$pass);
    $result = mysqli_query($link,"SELECT * FROM users WHERE login='$login' AND password='$hash'");
    if (!$result) {
    printf("Query failed: %s\n", mysqli_error($link));
    }
    $row = mysqli_fetch_assoc($result);
    //$sql = "SELECT login, password, ID FROM users WHERE login=? AND password=?";
    //$stmt = $link->prepare($sql);
    //$stmt->bind_param("ss", $login, $pass);
    //$result = $stmt->execute();
   
    if($row['ID']=='0'){
        $_SESSION['gosc']=1;
        $_SESSION['goscImie']=$row['IMIE'];
        $_SESSION['goscNazwisko']=$row['NAZWISKO'];
        $_SESSION['goscZalogowany']=1;
        $_SESSION['goscLogin']=$row['LOGIN'];
        header("Location: guest.php");    
    }
    else if($row['ID']=='1'){  
        $_SESSION['pracownik']=1;
        $_SESSION['pracownikImie']=$row['IMIE'];
        $_SESSION['pracownikZalogowany']=1; 
        header('location: employee.php');     
    }
    else if($row['ID']=='2'){
        $_SESSION['manager']=1;
        $_SESSION['managerImie']=$row['IMIE'];
        $_SESSION['managerZalogowany']=1; 
        header('location: manager.php');
    }
    else{
        header('location: index.php');
        $_SESSION['blad']=1;
    }
    //$stmt->close();
    $link->close();
}
?>
<?php
ob_end_flush();
?>