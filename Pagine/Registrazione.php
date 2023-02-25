<html>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>
        Registrazione - Ferramenta Caruso
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
        <form action="../Php/Crea_Utente.php" method="post">
            <h2>
                Scopri un mondo di prodotti
            </h2>
            <h3>
                Usufruisci di offerte ogni giorno dalla comodita di casa tua.
            </h3>

            <!-- Se l'account esiste già -->
            <label for="errore" id="errore" style="color:red">
                <script>
                    var errore = window.location.href;
                    errore = errore.split('?')[1];
                    errore = errore.split('=')[1];

                    if (errore == 'usernameusato')
                        document.getElementById('errore').innerHTML = "L'account esiste già. <br>";
                </script>
            </label>

            <br>
            <label for="lname">
                Nome utente
            </label>

            <br>

            <input type="text" class="registrazione" name="Username" placeholder="Nome Utente" required>

            <br> <br>

            <label for="lPassword">
                Password
            </label>

            <br>

            <input type="text" class="registrazione" name="Password" placeholder="Password" required>

            <h4>
                Hai già un account? <a href="Login.php">Accedi</a>!
            </h4>

            <input type="submit" value="Registrati">

        </form>
    </div>

</body>