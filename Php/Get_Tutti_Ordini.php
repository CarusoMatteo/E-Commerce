<?php

$conn = include("SelezionaDB.php");

$nomeUtente = $_GET["username"];

$selezione =
    "SELECT Id_Ordine, Totale, Data, ordini.Username AS Username
    FROM utenti INNER JOIN ordini
    ON utenti.Username = ordini.Username
    WHERE ordini.Username = '$nomeUtente'
    ORDER BY Data
    ";
return mysqli_query($conn, $selezione);