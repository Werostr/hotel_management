<?php
session_start();
ob_start();
require('funkcje.php');
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
//Dodawanie przesłanych danych z guest.php do odpowiednich baz danych
}
if (isset($_SESSION['wybranyPokoj']) && !empty($_POST['przyjazd']) && !empty($_POST['wyjazd']))
{
    $check = mysqli_query($link, "SELECT * FROM rooms WHERE NR_POK='$_SESSION[wybranyPokoj]'");
    $check=mysqli_fetch_assoc($check);
    if($check['WOLNY']=="NIE"){
        header("Location: guest.php");
        $_SESSION['zajetyPokoj']=1;
    }
    else{
        $zajete="NIE";
        $sql = "UPDATE guests SET NR_POK=?, DATA_PRZYJAZDU=?, DATA_WYJAZDU=? WHERE login='$_SESSION[goscLogin]'";
        $sql2 = "UPDATE rooms SET WOLNY=? WHERE NR_POK='$_SESSION[wybranyPokoj]'";
        $stmt = $link->prepare($sql);
        $stmt2 = $link->prepare($sql2);
        $stmt->bind_param("iss",$_SESSION['wybranyPokoj'], $_POST['przyjazd'],$_POST['wyjazd']);
        $stmt2->bind_param("s", $zajete);
        $result = $stmt->execute();
        $result2 = $stmt2->execute();
        if(!$result || !$result2){
            header("Location: guest.php");
            $_SESSION['blad_rez']=1;
        }
        else{   
            header('location: rezerwacja.php'); 
            $_SESSION['sukces_rez']=1;
        }
    }  
    $stmt->close();
}
else{
    header('location: guest.php');
    $_SESSION['blad_rez']=1;
}
$link->close();
?>
<?php
ob_end_flush();
?>