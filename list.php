<?php
session_start();
ob_start();
$link = mysqli_connect("localhost", "admin", "fajnehaslo", "hotel");
if (!$link) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista gości</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="style.php" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="list.css">
</head>

<body>
    <main>
    <table>
    <tr><td><b>Imię</td><td><b>Nazwisko</b></td><td><b>Nr pokoju</b></td><td><b>Data przyjazdu</b></td><td><b>Data wyjazdu</b></td></tr>
    <?php
    
    $sql = "SELECT * FROM guests  WHERE NR_POK!=0 ORDER BY DATA_PRZYJAZDU";
    $result = $link->query($sql);
    if (!$result) {
        printf("Query failed: %s\n", mysqli_error($link));
        }
    foreach ($result as $v) {
    printf("<tr><td>".$v["IMIE"]."</td><td>".$v["NAZWISKO"]."</td><td>".$v["NR_POK"]."</td><td>".$v["DATA_PRZYJAZDU"]."</td><td>".$v["DATA_WYJAZDU"]."</td></tr>"); }
    $result->free();
    $link->close();
    ?>
    </table>
    <a href="index.php">Wstecz</a>
    </main>
    <footer>2022</footer>
</body>
<script>
    $(function(){
        $('a').click(function () {
        $('body').load($(this).attr('href'));
        return false;
    });});
</script>
</html>