<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if (isset($_SESSION['wymelduj']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['wyjazd']))
{
        $zameldowany_czysto="NIE";
        $wolny="TAK";
        $nr_pok=0;
        $data=NULL;
        $check=mysqli_query($link,"SELECT * FROM guests WHERE NR_POK='$_SESSION[wymelduj]' AND DATA_WYJAZDU='$_POST[wyjazd]' AND ZAMELDOWANY='TAK'");
        $check=mysqli_fetch_assoc($check);
        if($check['IMIE']==$_POST['imie'] && $check['NAZWISKO']==$_POST['nazwisko']){
            $sql = "UPDATE rooms SET WOLNY=?, CZYSTO=?,ZAMELDOWANY=? WHERE NR_POK='$_SESSION[wymelduj]'";
            $sql2 = "UPDATE guests SET NR_POK=?, DATA_PRZYJAZDU=?, DATA_WYJAZDU=?, ZAMELDOWANY=? WHERE NR_POK='$_SESSION[wymelduj]' AND DATA_WYJAZDU='$_POST[wyjazd]'";
            $stmt = $link->prepare($sql);
            $stmt2 = $link->prepare($sql2);
            $stmt->bind_param("sss",$wolny,$zameldowany_czysto,$zameldowany_czysto);
            $stmt2->bind_param("isss",$nr_pok,$data,$data,$zameldowany_czysto);
            $result = $stmt->execute();
            $result2 = $stmt2->execute();
            if(!$result || !$result2){
                header("Location: manager.php");
                $_SESSION['blad_wym']=1;
            }
            else{   
                header('location: manager.php'); 
                $_SESSION['sukces_wym']=1;
                unset($_SESSION['zameldujzulicy']);
                unset($_SESSION['zamelduj']);
                unset($_SESSION['wymelduj']);
            }
        }
        else{
            header("Location: manager.php");
            $_SESSION['blad_wym']=1;
        }
        $stmt->close();   
} 
else{
    header('location: manager.php');
    $_SESSION['blad_wym']=1;
}
$link->close();
?>
<?php
ob_end_flush();
?>