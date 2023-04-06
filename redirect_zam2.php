<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
if (isset($_SESSION['zameldujzulicy']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['wyjazd']))
{
        $zameldowany="TAK";
        $wolny="NIE";
        $data=date('Y-m-d');
        $sql = "UPDATE rooms SET ZAMELDOWANY=?, WOLNY=? WHERE NR_POK='$_SESSION[zameldujzulicy]'";
        $sql2 = "INSERT INTO guests(imie,nazwisko,nr_pok,data_przyjazdu,data_wyjazdu,zameldowany) VALUES(?,?,?,?,?,?)";
        $stmt = $link->prepare($sql);
        $stmt2 = $link->prepare($sql2);
        $stmt->bind_param("ss",$zameldowany,$wolny);
        $stmt2->bind_param("ssisss", $_POST['imie'],$_POST['nazwisko'],$_SESSION['zameldujzulicy'],$data,$_POST['wyjazd'],$zameldowany);
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