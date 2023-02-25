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
    header("location: ../Html/Login.html");
} else {
    header("location: ../Html/Registrazione.html?errore=usernameusato");
}