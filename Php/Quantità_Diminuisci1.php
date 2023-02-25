<?php

$username = $_GET["username"];
$id_Prodotto = $_GET["idprodotto"];

$conn = include("SelezionaDB.php");

$select = "SELECT quantità
        FROM carrello
        WHERE Username='$username' AND Id_Prodotto = $id_Prodotto
";

$quantitàAtt = mysqli_fetch_assoc(mysqli_query($conn, $select))['quantità'];

if ($quantitàAtt != '1') {
    try {
        $modifica = "UPDATE carrello
    SET quantità = carrello.quantità - 1
    WHERE Username='$username' AND Id_Prodotto = $id_Prodotto
    ";
        mysqli_query($conn, $modifica);
    } catch (Exception $e) {
        print($e);
        die;
    }
} else {
    try {
        $modifica = "DELETE
        FROM carrello
        WHERE Username='$username' AND Id_Prodotto = $id_Prodotto
    ";
        mysqli_query($conn, $modifica);
    } catch (Exception $e) {
        print($e);
        die;
    }
}

header("Location: ../Pagine/Carrello.php?username=" . $_GET['username']);