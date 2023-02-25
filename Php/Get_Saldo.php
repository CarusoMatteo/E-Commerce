<?php

try {
    $conn = include("SelezionaDB.php");

    $nomeUtente = $_GET["username"];

    $selezione = "SELECT Saldo
    FROM utenti
    WHERE Username = '$nomeUtente'
    ";
    return mysqli_fetch_assoc(mysqli_query($conn, $selezione))['Saldo'];

} catch (Exception) {
    return "Errore";
}