<?php

$username = $_GET["username"];
//$fondi = abs($_POST["fondi"]);
$fondi = $_POST["fondi"];

$conn = include("SelezionaDB.php");
print($fondi);

try {
    $modifica = "UPDATE utenti
    SET saldo = saldo + $fondi
    WHERE Username = '$username'
    ";
    mysqli_query($conn, $modifica);
} catch (Exception $e) {
    print($e);
    die;
}

header("Location: ../Pagine/Account.php?username=" . $_GET['username']);