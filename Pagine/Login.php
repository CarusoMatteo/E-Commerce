<html>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>
        Login - Ferramenta Caruso
    </title>
    <link rel="stylesheet" href="../Css/Login-Registrazione.css">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <!-- Per usare le icone MDI -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0">
</head>

<body>

    <div class="barraLogo">
        <div class="elemento">
            <img src="../Immagini/logo.png" height="30px">
        </div>
        <div class="elemento">
            Ferramenta Caruso
        </div>
    </div>

    <div class="barraNavigazione">

        <div class="elemento">
            <span class="material-symbols-outlined">
                shopping_bag
            </span>
        </div>

        <div class="selezionato">
            Login
        </div>

        <a href="Negozio.php">
            Negozio
        </a>

        <a href="Carrello.php">
            Carrello
        </a>

    </div>

    <div class="main">
        <form action="../Php/Controlla_Accesso.php" method="post">
            <h2>
                Il Tuo Account con noi
            </h2>
            <h3>
                Accedi per vedere la lista dei prodotti.
            </h3>

            <!-- Se l'account non esiste -->
            <label for="errore" id="errore" style="color:red">
                <script>
                    var errore = window.location.href;
                    errore = errore.split('?')[1];
                    errore = errore.split('=')[1];

                    if (errore == 'nonesiste')
                        document.getElementById('errore').innerHTML = "L'account non esiste. <br>";
                    else if (errore == 'nologin')
                        document.getElementById('errore').innerHTML = "Effettua il login per accedere al negozio. <br>";
                </script>
            </label>

            <br>

            <label for="lname">
                Nome utente
            </label>

            <br>

            <input type="text" class="login" name="Username" placeholder="Nome Utente" required>

            <br> <br>

            <label for="lPassword">
                Password
            </label>

            <br>

            <input type="text" class="login" name="Password" placeholder="Password" required>

            <h4>
                Non ancora iscritto? <a href="Registrazione.php">Iscriviti</a>!
            </h4>

            <input type="submit" value="Accedi">

        </form>
    </div>

</body>