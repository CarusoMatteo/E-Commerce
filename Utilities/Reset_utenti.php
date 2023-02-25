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

$cancella = "DELETE FROM utenti WHERE 1";
mysqli_query($conn, $cancella);

$autoincrementReset = "ALTER TABLE utenti AUTO_INCREMENT=1";
mysqli_query($conn, $autoincrementReset);

mysqli_close($conn);
