<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

if (isset($_POST['nr']))
{
    $sql = "UPDATE rooms SET CZYSTO='TAK' WHERE NR_POK='$_POST[nr]'";
    $stmt = $link->prepare($sql);
    $stmt->execute();
    header('location: index.php'); 
}

$link->close();
?>
<?php
ob_end_flush();
?>