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

$inserimento = "INSERT INTO prodotti
(Nome, Prezzo, Descrizione) VALUES
('Prodotto 11', 1.00, 'Descrizione prodotto 11')
";
mysqli_query($conn, $inserimento);

mysqli_close($conn);