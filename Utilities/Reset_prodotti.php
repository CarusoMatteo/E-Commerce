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

$cancella = "DELETE FROM  prodotti WHERE 1";
mysqli_query($conn, $cancella);

$autoincrementReset = "ALTER TABLE prodotti AUTO_INCREMENT=1";
mysqli_query($conn, $autoincrementReset);


$inserimento =
    "INSERT INTO prodotti
(Nome, Prezzo, Descrizione, Link_Immagine) VALUES
('Cacciavite', 8.19, 'Philips', 'https://www.aquatuning.it/media/image/74/e4/58/32046_1_600x600.jpg'),
('Viti', 2.37, 'Duratool', 'https://standardbolts.net/wp-content/uploads/2018/10/CARRIAGE-BOLT-ZINC.png?v=1603699697'),
('Martello', 20.03, 'Stanley', 'https://i.ebayimg.com/images/g/y9EAAOSwSatiAqIt/s-l640.jpg'),
('Trapano', 169.99, 'Hitachi', 'https://tcdn.storeden.com/product/13511939/14652184'),
('Seghetto', 22.99, 'Brixo', 'https://images-eu.ssl-images-amazon.com/images/I/31eAqeh0zwL._AC_UL600_SR600,400_.jpg'),
('Presa', 5.00, 'Vimar', 'https://images-eu.ssl-images-amazon.com/images/I/41m53mRpn7L._AC_UL600_SR600,400_.jpg'),
('Nastro adesivo', 5.00, 'Scotch', 'https://images-eu.ssl-images-amazon.com/images/I/71XZvIRXqxL._AC_UL600_SR600,400_.jpg'),
('Lucchetto', 4.98, 'Abus', 'https://images-eu.ssl-images-amazon.com/images/I/61mlQbD4a7S._AC_UL600_SR600,400_.jpg')
";
mysqli_query($conn, $inserimento);

mysqli_close($conn);
