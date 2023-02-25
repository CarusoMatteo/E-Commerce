<?php

$conn = include("SelezionaDB.php");

//$ordine = $_GET["ordine"];
$ordine = 1;

$selezione =
    "SELECT prodotti.Nome AS Nome, ordini_prodotti.Quantità AS Quantità
    FROM ordini_prodotti JOIN prodotti
    ON ordini_prodotti.Id_Prodotto = prodotti.Id_Prodotto
    WHERE Id_Ordine = 1
    ";
return mysqli_query($conn, $selezione);