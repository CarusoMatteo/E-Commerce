<html>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>
        Account - Ferramenta Caruso
    </title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../Css/Account.css">

    <?php

    include_once('../Classi/Ordine.php');
    include_once('../Classi/Prodotto_Ordine.php');

    ?>

    <!-- Per usare le icone MDI -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0">

    <script>
        try {
            username = window.location.href;
            username = username.split('?')[1];
            username = username.split('=')[1];

            // Gli spazi in una variabile GET vengono sostituiti con '%20'
            username = username.replace("%20", " ");

            if (username == null)
                window.location.href = "Login.html";

        } catch {
            window.location.href = "Login.html?errore=nologin";
        }

        function LinkNegozio() {
            var query = window.location.href;
            query = query.split('?')[1];

            window.location.href = "Negozio.php?" + query;
        }

        function LinkCarrello() {
            var query = window.location.href;
            query = query.split('?')[1];

            window.location.href = "Carrello.php?" + query;
        }
    </script>
</head>

<body>

    <div class="barraLogo">
        <div class="elemento">
            <img src="../Immagini/logo.png" height="30px">
        </div>
        <div class="elemento">
            Ferramenta Caruso
        </div>

        <div class="elementoDestra">
            <span class="material-symbols-outlined">
                account_circle
            </span>
        </div>

        <div id="nome_utente" class="elementoDestraGrassetto">
            <script>
                var username = window.location.href;
                username = username.split('?')[1];
                username = username.split('=')[1];

                // Gli spazi in una variabile GET vengono sostituiti con '%20'
                username = username.replace("%20", " ");

                document.getElementById('nome_utente').innerHTML = username;
            </script>
        </div>

        <div class="elementoDestra">
            Benvenuto/a
        </div>
    </div>

    <div class="barraNavigazione">

        <div class="elemento">
            <span class="material-symbols-outlined">
                shopping_bag
            </span>
        </div>

        <a href="Login.html">
            Esci
        </a>

        <a onclick="LinkNegozio()" style="cursor: pointer">
            Negozio
        </a>

        <a onclick="LinkCarrello()" style="cursor: pointer">
            Carrello
        </a>

        <div class="elementoDestra">
            <span class="material-symbols-outlined">
                shopping_cart
            </span>
        </div>

        <div class="elementoDestraGrassetto">
            <?php
            $totCarrello = include("../Php/Get_Prezzo_Totale_Carrello.php");

            print("€ " . $totCarrello);
            ?>
        </div>


        <div class="elementoDestra">
            Totale:
        </div>
    </div>

    <div class="main">
        <div class="box" style="padding-bottom: 40px;">
            <h1>
                Il Tuo Account
            </h1>

            <div class="card">

                <div class="row">

                    <div class="column">
                        <br> <br>
                        <div style="font-size: large;">
                            Il tuo saldo attuale:
                        </div>
                        <br>
                        <div class="saldo">

                            <?php

                            print("€ " . Get_Saldo());

                            ?>

                        </div>

                    </div>

                    <div class="vertline"></div>

                    <div class="column">
                        <?php

                        print('<form action="../Php/Aggiungi_fondi.php?username=' . $_GET['username'] . '" method="post">');

                        ?>
                        <div style="font-size: large;">
                            Aggiungi fondi
                        </div>
                        € <input type="text" name="fondi" placeholder="Fondi" required>
                        <br> <br>
                        <input type="submit" class="btnAcquista" value="Aggiungi fondi">
                        </form>
                    </div>
                </div>
            </div>

            <br>

            <h2>
                Storico ordini
            </h2>

            <?php

            StampaTabellaOrdini();

            ?>

        </div>
    </div>

</body>

</html>

<?php

function Get_Saldo()
{
    return include('../Php/Get_Saldo.php');
}

function StampaTabellaOrdini()
{
    $arrayOrdini = array();

    $ordini = include("../Php/Get_Tutti_Ordini.php");

    while ($currOrdine = mysqli_fetch_assoc($ordini)) {
        $id_Ordine = $currOrdine['Id_Ordine'];
        $totale = $currOrdine['Totale'];
        $data = $currOrdine['Data'];
        $username = $currOrdine['Username'];

        $arrayProdotti = GetArrayProdotti($id_Ordine);

        array_push($arrayOrdini, new Ordine($id_Ordine, $totale, $data, $username, $arrayProdotti));
    }

    // Stampa header tabella
    print('

    <table>
        <thead>
            <tr>
                <td>Numero ordine</td>
                <td>Prodotti</td>
                <td>Totale</td>
                <td>Data</td>
            </tr>
        </thead>
    ');

    for ($indexArrayOrdini = 0; $indexArrayOrdini < count($arrayOrdini); $indexArrayOrdini++) {
        $ordineCurr = $arrayOrdini[$indexArrayOrdini];

        print('<tr>');

        // Stampa Id_Ordine

        print('
        <td>
        ' . $ordineCurr->GetId_Ordine() . '
        </td>
        ');

        // Stampa Prodotti

        print('<td>');

        $arrayProdottiCurr = $ordineCurr->GetArrayProdotti();

        for ($indexArrayProdotti = 0; $indexArrayProdotti < count($arrayProdottiCurr); $indexArrayProdotti++) {
            $prodottoCurr = $arrayProdottiCurr[$indexArrayProdotti];

            // Viti x 1
            print($prodottoCurr->GetNome() . ' x ' . $prodottoCurr->GetQuantità());

            if ($indexArrayProdotti != count($arrayProdottiCurr) - 1)
                print('; ');

        }

        print('</td>');

        // Stampa Totale
        print('
        <td>
        ' . $ordineCurr->GetTotale() . '
        </td>
        ');

        // Stampa Data
        print('
        <td>
        ' . $ordineCurr->GetData() . '
        </td>
        ');

        print('</tr>');
    }

    print('</table>');
}


function GetArrayProdotti($ordine)
{
    $conn = include("../Php/SelezionaDB.php");

    $selezione =
        "SELECT prodotti.Nome AS Nome, ordini_prodotti.Quantità AS Quantità
    FROM ordini_prodotti JOIN prodotti
    ON ordini_prodotti.Id_Prodotto = prodotti.Id_Prodotto
    WHERE Id_Ordine = $ordine
    ";
    //return mysqli_query($conn, $selezione);

    $arrayProdotti = array();

    $prodotti = mysqli_query($conn, $selezione);

    while ($currProd = mysqli_fetch_assoc($prodotti)) {
        $nome = $currProd['Nome'];
        $quantità = $currProd['Quantità'];

        array_push($arrayProdotti, new Prodotto_Ordine($nome, $quantità));
    }

    return $arrayProdotti;
}

?>