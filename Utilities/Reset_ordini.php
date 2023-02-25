<?php
// Variabili per stabilire la connessione
$server = "localhost";
$user = "root";
$psw = null;

// Stabilizzazione del connessione
$conn = mysqli_connect($server, $user, $psw);

// Selezione del database
$query = "USE ecommerce";
mysqli_query($conn, $query);

$cancella = "DELETE FROM ordini_prodotti";
mysqli_query($conn, $cancella);

$cancella = "DELETE FROM ordini";
mysqli_query($conn, $cancella);

$autoincrementReset = "ALTER TABLE ordini AUTO_INCREMENT=1";
mysqli_query($conn, $autoincrementReset);

mysqli_close($conn);
