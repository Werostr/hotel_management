<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if (isset($_SESSION['zamelduj']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['przyjazd']))
{
        $zameldowany="TAK";
        $check=mysqli_query($link,"SELECT * FROM guests WHERE NR_POK='$_SESSION[zamelduj]' AND DATA_PRZYJAZDU='$_POST[przyjazd]'");
        $check=mysqli_fetch_assoc($check);
        if($check['IMIE']==$_POST['imie'] && $check['NAZWISKO']==$_POST['nazwisko']){
            $sql = "UPDATE rooms SET ZAMELDOWANY=? WHERE NR_POK='$_SESSION[zamelduj]'";
            $sql2 = "UPDATE guests SET ZAMELDOWANY=? WHERE NR_POK='$_SESSION[zamelduj]' AND DATA_PRZYJAZDU='$_POST[przyjazd]'";
            $stmt = $link->prepare($sql);
            $stmt2 = $link->prepare($sql2);
            $stmt->bind_param("s",$zameldowany);
            $stmt2->bind_param("s", $zameldowany);
            $result = $stmt->execute();
            $result2 = $stmt2->execute();
            if(!$result || !$result2){
                header("Location: manager.php");
                $_SESSION['blad_zam']=1;
            }
            else{   
                header('location: manager.php'); 
                $_SESSION['sukces_zam']=1;
                unset($_SESSION['zameldujzulicy']);
                unset($_SESSION['zamelduj']);
                unset($_SESSION['wymelduj']);
            }
        }
        else{
            header("Location: manager.php");
            $_SESSION['blad_zam']=1;
        }
        $stmt->close();   
} 
else{
    header('location: manager.php');
    $_SESSION['blad_zam']=1;
}
$link->close();
?>
<?php
ob_end_flush();
?>