<?php

try {
    $conn = include("SelezionaDB.php");

    $username = $_GET["username"];

    // Seleziono i dati nella tabella
    $selezione =
        "SELECT prodotti.Prezzo AS Prezzo, carrello.Quantità AS Quantità
        FROM (  utenti INNER JOIN carrello 
            ON utenti.Username = carrello.Username
         )  INNER JOIN prodotti
            ON carrello.Id_Prodotto = prodotti.Id_Prodotto
         
         WHERE utenti.Username='$username'
    ";
    $ris = mysqli_query($conn, $selezione);

    $totale = 0;

    while ($curr = mysqli_fetch_assoc($ris)) {
        $totale += $curr['Prezzo'] * $curr['Quantità'];
    }

    return $totale;
} catch (Exception) {
    return "0,00";
}