<?php

$conn = include("SelezionaDB.php");

$nomeUtente = $_POST["Username"];
$password = $_POST["Password"];

$query = "INSERT INTO utenti (Username, Password) 
VALUES ('$nomeUtente' , '$password')
";

try {
    $ok = mysqli_query($conn, $query);
} catch (Exception $e) {
    $ok = false;
}


mysqli_close($conn);

if ($ok) {
    header("location: ../Pagine/Login.php");
} else {
    header("location: ../Pagine/Registrazione.php?errore=usernameusato");
}