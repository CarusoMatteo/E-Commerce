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
return $conn;
