<?php

$username = $_GET["username"];
$totale = include("Get_Prezzo_Totale_Carrello.php");

$conn = include("SelezionaDB.php");

$inserimentoOrdine = "INSERT INTO ordini
    (Totale, Data, Username) VALUES
    ($totale , NOW(), '$username')
    ";
mysqli_query($conn, $inserimentoOrdine);

$id_Ordine = mysqli_fetch_assoc(mysqli_query($conn, "SELECT last_insert_id() AS id"))['id'];
print($id_Ordine);

$inserimentoOrdine_Prodotto = "INSERT INTO ordini_prodotti
    (Id_ordine, Id_Prodotto, Quantità) VALUES
";

$arrayId_Prodotti = array();
$arrayQuantità = array();

$carrello = include("../Php/Get_Tutti_Prodotti_Carrello.php");

while ($curr = mysqli_fetch_assoc($carrello)) {
    $id_Prodotto = $curr['Id_Prodotto'];
    $quantità = $curr['Quantità'];

    array_push($arrayId_Prodotti, $id_Prodotto);
    array_push($arrayQuantità, $quantità);
}

$length = count($arrayId_Prodotti);

for ($indexArrayCarrello = 0; $indexArrayCarrello < $length; $indexArrayCarrello++) {
    $id_ProdottoCurr = $arrayId_Prodotti[$indexArrayCarrello];
    $quantitàCurr = $arrayQuantità[$indexArrayCarrello];

    $inserimentoOrdine_Prodotto .= "(" . $id_Ordine . "," . $id_ProdottoCurr . "," . $quantitàCurr . ")";

    if ($indexArrayCarrello != $length - 1) {
        $inserimentoOrdine_Prodotto .= ',';
    }
}

print($inserimentoOrdine_Prodotto);

try {
    mysqli_query($conn, $inserimentoOrdine_Prodotto);
} catch (Exception) {
    // Il carrello è vuoto
}

$cancella = "DELETE FROM carrello 
WHERE username='$username'";
mysqli_query($conn, $cancella);

mysqli_close($conn);

header("Location: ../Html/Carrello.php?username=$username");