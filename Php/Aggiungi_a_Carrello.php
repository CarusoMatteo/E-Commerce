<?php

if (empty($_POST['quantità']))
    $_POST['quantità'] = 1;

$username = $_GET["username"];
$id_Prodotto = $_GET["idprodotto"];
$quantità = abs($_POST["quantità"]); // Così non si ha quantità negativa

$conn = include("SelezionaDB.php");

// Se il prodotto è gia stato inserito per quell'utente
$query =
    "SELECT EXISTS 
    (SELECT * 
    FROM carrello
    WHERE Username = '$username' AND Id_Prodotto = '$id_Prodotto'
    ) AS ris
";

$exists = mysqli_fetch_assoc(mysqli_query($conn, $query))['ris'];

// Se non esiste
if ($exists == 0) {
    try {
        $inserimento = "INSERT INTO carrello
    (Username, Id_Prodotto, Quantità) VALUES
    ('$username', $id_Prodotto, $quantità)
    ";
        mysqli_query($conn, $inserimento);
    } catch (Exception $e) {
        print($e);
        die;
    }
}
// Se esiste
else {
    try {
        $modifica = "UPDATE carrello
    SET quantità = carrello.quantità + $quantità
    WHERE Username='$username' AND Id_Prodotto = $id_Prodotto
    ";
        mysqli_query($conn, $modifica);
    } catch (Exception $e) {
        print($e);
        die;
    }
}

header("Location: ../Pagine/Negozio.php?username=$username");