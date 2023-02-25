<?php
$conn = include("SelezionaDB.php");

$username = $_POST["Username"];
$password = $_POST["Password"];

$query =
    "SELECT EXISTS 
    (SELECT * 
    FROM utenti
    WHERE Username = '$username' AND Password = '$password'
    ) AS ris
";

$exists = mysqli_fetch_assoc(mysqli_query($conn, $query))['ris'];

mysqli_close($conn);

if ($exists == 1) {
    header("location: ../html/Negozio.php?username=$username");
} else {
    header("location: ../html/Login.html?errore=nonesiste");
}