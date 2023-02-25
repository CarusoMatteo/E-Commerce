<html>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>
        Carrello - Ferramenta Caruso
    </title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../Css/Carrello.css">

    <?php

    include_once('../Classi/Prodotto_Carrello.php');

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

        function LinkNegozio() {
            var query = window.location.href;
            query = query.split('?')[1];

            window.location.href = "Negozio.php?" + query;
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

        <a onclick="LinkNegozio()" style="cursor: pointer">
            Negozio
        </a>

        <div class="selezionato">
            Carrello
        </div>

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
        <div class="row">

            <!-- Elenco prodotti nel carrello -->

            <?php

            StampaProdottiCarrello();

            ?>
        </div>
    </div>
</body>

</html>

<?php

function StampaProdottiCarrello()
{
    $arrayCarrello = array();

    $carrello = include("../Php/Get_Tutti_Prodotti_Carrello.php");

    while ($curr = mysqli_fetch_assoc($carrello)) {
        $id_Prodotto = $curr['Id_Prodotto'];
        $nome = $curr['Nome'];
        $prezzo = $curr['Prezzo'];
        $quantità = $curr['Quantità'];
        $link_Immagine = $curr['Link_Immagine'];

        array_push($arrayCarrello, new Prodotto_Carrello($id_Prodotto, $nome, $prezzo, $quantità, $link_Immagine));
    }

    $length = count($arrayCarrello);

    print('<div class="columnLeft">');

    for ($indexArrayCarrello = 0; $indexArrayCarrello < $length; $indexArrayCarrello++) {

        $prodottoCurr = $arrayCarrello[$indexArrayCarrello];
        print('
        <div class="card">

            <div class="containerTesto">

                <div class="sinistra">
                    <img class="card-img-top" src="' . $prodottoCurr->GetLink_Immagine() . '" alt="...">
                </div>'
        );

        print('<div class="destra">');

        // Nome prodotto
        print('
            <h3>'
            . $prodottoCurr->GetNome() .
            '</h3>
        ');

        // Prezzo x Quantità
        print('        
        <h4 style="font-weight: normal;">
        <div class="containerTesto">
        <div class="sinistra">
        € ' . $prodottoCurr->GetPrezzo() . '
        </div>
        <div class="destra">
        x ' . $prodottoCurr->GetQuantità() . ' pz.
        </div>
        </div>
        </h4>'
        );

        // Form per modificare la quantità
        print('
        <h4>
        Quantità
        </h4>

        <div class="containerTesto">
        <div class="sinistra">
        ');

        // Button -
        print('
        <form class="firstForm" action="../Php/Quantità_Diminuisci1.php?username=' . $_GET['username'] . '&idprodotto=' . $prodottoCurr->GetId_Prodotto() . '" method="post">
        <input type="submit" class="btnQuantità" value="-">
        </form>   
        </div>
        ');

        // Quantità attuale
        print('
        <div class="sinistra">
        ' . $prodottoCurr->GetQuantità() . '
        </div>

        <div class="destra">
        ');


        // Button +
        print('
        <form action="../Php/Quantità_Aumenta1.php?username=' . $_GET['username'] . '&idprodotto=' . $prodottoCurr->GetId_Prodotto() . '" method="post">
        <input type="submit" class="btnQuantità" value="+">
        </form>
        </div>        
        ');

        print('</div>
        <br>
                <a class="link_Rimuovi" href="../Php/Rimuovi_da_Carrello.php?username=' . $_GET['username'] . '&idprodotto=' . $prodottoCurr->GetId_Prodotto() . '">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </a>
        <br>
        <br>
        </div>
        </div>
        </div>
        <br>
        ');
    }

    $totCarrello = include("../Php/Get_Prezzo_Totale_Carrello.php");

    print('
    </div>
    <div class="columnRigth">
        <div class="card fissaCima">
            <h3>
                Subtotale
            </h3>
            <div class="totale">
                € ' . $totCarrello .
        '<br>'
    );

    if ($totCarrello != '0') {

        $saldoAtt = include("../Php/Get_Saldo.php");

        if ($saldoAtt < $totCarrello) {
            $totMenoSaldo = $totCarrello - $saldoAtt;
            print("- $saldoAtt");
        } else {
            $totMenoSaldo = "0.00";
            print("- $totCarrello");
        }

        print("<br>");
        print("⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯");
        print("<br>");

        print("€ $totMenoSaldo");
    }




    print('
        </div>
        <p>
            IVA Inclusa
        </p>
        <form action="../Php/Acquista.php?username=' . $_GET['username'] . '" method="post">
    ');

    if ($totCarrello == '0')
        print('<input type="submit" class="btnDisabled" value="Acquista" disabled>');
    else
        print('<input type="submit" class="btnAcquista" value="Acquista">');

    print('
            </form>
        </div>
    </div>
    ');
}

?>