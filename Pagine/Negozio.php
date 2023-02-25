<html>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>
        Negozio - Ferramenta Caruso
    </title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../Css/Negozio.css">

    <?php

    include_once('../Classi/Prodotto_Negozio.php');

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
                window.location.href = "Login.php";

        } catch {
            window.location.href = "Login.php?errore=nologin";
        }

        function LinkCarrello() {
            var query = window.location.href;
            query = query.split('?')[1];

            window.location.href = "Carrello.php?" + query;
        }

        function LinkAccount() {
            var query = window.location.href;
            query = query.split('?')[1];

            window.location.href = "Account.php?" + query;
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

        <div class="elementoDestra" onclick="LinkAccount()" style="cursor: pointer">
            <span class="material-symbols-outlined">
                account_circle
            </span>
        </div>

        <div id="nome_utente" class="elementoDestraGrassetto" onclick="LinkAccount()" style="cursor: pointer">
            <script>
                var username = window.location.href;
                username = username.split('?')[1];
                username = username.split('=')[1];

                // Gli spazi in una variabile GET vengono sostituiti con '%20'
                username = username.replace("%20", " ");

                document.getElementById('nome_utente').innerHTML = username;
            </script>
        </div>

        <div class="elementoDestra" onclick="LinkAccount()" style="cursor: pointer">
            Benvenuto/a
        </div>
    </div>

    <div class="barraNavigazione">

        <div class="elemento">
            <span class="material-symbols-outlined">
                shopping_bag
            </span>
        </div>

        <a href="Login.php">
            Esci
        </a>

        <div class="selezionato">
            Negozio
        </div>


        <a onclick="LinkCarrello()" style="cursor: pointer">
            Carrello
        </a>

        <div class="elementoDestra" onclick="LinkCarrello()" style="cursor: pointer">
            <span class=" material-symbols-outlined">
                shopping_cart
            </span>
        </div>

        <div class="elementoDestraGrassetto" onclick="LinkCarrello()" style="cursor: pointer">
            <?php
            $totCarrello = include("../Php/Get_Prezzo_Totale_Carrello.php");

            print("€ " . $totCarrello);
            ?>
        </div>

        <div class="elementoDestra" onclick="LinkCarrello()" style="cursor: pointer">
            Totale:
        </div>
    </div>

    <div class="main">

        <?php

        StampaCarteConProdotti();

        ?>

    </div>
</body>

</html>

<?php

function StampaCarteConProdotti()
{
    $arrayProdotti = array();

    $prodotti = include("../Php/Get_Tutti_prodotti.php");

    while ($curr = mysqli_fetch_assoc($prodotti)) {
        $id_Prodotto = $curr['Id_Prodotto'];
        $nome = $curr['Nome'];
        $prezzo = $curr['Prezzo'];
        $descrizione = $curr['Descrizione'];
        $link_Immagine = $curr['Link_Immagine'];

        array_push($arrayProdotti, new Prodotto_Negozio($id_Prodotto, $nome, $prezzo, $descrizione, $link_Immagine));
    }

    $length = count($arrayProdotti);
    $indexArrayProdotti = 0;

    // 2 righe
    for ($indexRiga = 1; $indexArrayProdotti < $length; $indexRiga++) {

        // Inizia una nuova riga
        print('<div class="row">');

        // 4 colonne
        for ($indexColonna = 1; $indexColonna <= 4; $indexColonna++) {

            if ($indexArrayProdotti < $length) {

                $prodottoCurr = $arrayProdotti[$indexArrayProdotti];

                // Inizia una nuova colonna e carta
                print(' 
                <div class="column">
                <div class="card">
                ');

                // Se dev'essere presente il chip "Offerta" e il prezzo scontato
                $offerta = (random_int(1, 10) > 8) ? true : false;

                // Se il prodotto è in offerta si mette il chip
                if ($offerta) {
                    print('
                        <div class="img_container">
                        <img class="card-img-top" src="' . $prodottoCurr->GetLink_Immagine() . '" alt="...">
                        <div class="badge"> Offerta </div>
                        </div>
                    ');
                } else {
                    print('
                    <div class="img_container">
                    <img class="card-img-top" src="' . $prodottoCurr->GetLink_Immagine() . '" alt="...">
                    </div>
                    ');
                }

                // Scrive il nome del prodotto

                print('
                <h3>
                ' . $prodottoCurr->GetNome() . '
                </h3>
                ');

                // Se il prodotto è in offerta si mette sia il prezzo vecchio che quello nuovo
                if ($offerta) {

                    $prezzoScontato = $prodottoCurr->GetPrezzo();

                    $aumento = rand(5, 20);

                    $prezzoNonScontato = $prezzoScontato + $aumento;

                    print('
                    <div class="prezzo">
                    <div class="vecchio">€ ' . $prezzoNonScontato . '</div>
                    <div class="nuovo">€ ' . $prezzoScontato . '</div>
                    </div>
                ');
                } // Altrimenti solo il prezzo normale
                else {
                    print('
                    <div class="prezzo">
                    <div class="nuovo">€ ' . $prodottoCurr->GetPrezzo() . '</div>
                    </div>
                ');
                }

                // Scrive la descrizione

                print('
                <p>
                ' . $prodottoCurr->GetDescrizione() . '
                </p>
                ');

                // Mette il form
                // Si invia username e Id_Prodotto tramite GET e quantità tramite POST
                print('
                <form action="../Php/Aggiungi_a_Carrello.php?username=' . $_GET['username'] . '&idprodotto=' . $prodottoCurr->GetId_Prodotto() . '" method="post">
                <input type="text" class="negozio" name="quantità" placeholder="Quantità">
                <br>
                <input type="submit" value="Aggiungi">
                </form>
                ');

                // Chiude i div card e column
                print('
                </div>
                </div>
                ');

                $indexArrayProdotti++;
            }
        }

        // Chiude il div row
        print('
            </div>
            <br>
        ');
    }
}



?>