<?php

$username = $_GET["username"];
$id_Prodotto = $_GET["idprodotto"];

$conn = include("SelezionaDB.php");

try {
    $modifica = "UPDATE carrello
    SET quantità = carrello.quantità + 1
    WHERE Username='$username' AND Id_Prodotto = $id_Prodotto
    ";
    mysqli_query($conn, $modifica);
} catch (Exception $e) {
    print($e);
    die;
}

header("Location: ../Html/Carrello.php?username=" . $_GET['username']);