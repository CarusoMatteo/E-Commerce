<?php

$conn = include("SelezionaDB.php");

$nomeUtente = $_GET["username"];

$selezione =
    "SELECT carrello.Id_prodotto AS Id_Prodotto, Nome, Prezzo, Quantità, Link_Immagine
    FROM (utenti INNER JOIN carrello
    ON utenti.Username = carrello.Username) INNER JOIN prodotti
    ON carrello.Id_Prodotto = prodotti.Id_Prodotto
    WHERE utenti.Username = '$nomeUtente'
    ";
return mysqli_query($conn, $selezione);