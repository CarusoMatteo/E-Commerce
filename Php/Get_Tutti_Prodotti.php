<?php

$conn = include("SelezionaDB.php");

$selezione = "SELECT Id_Prodotto, Nome, Prezzo, Descrizione, Link_Immagine 
FROM prodotti
ORDER BY Nome";
return mysqli_query($conn, $selezione);