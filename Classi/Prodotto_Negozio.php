<?php
class Prodotto_Negozio
{
    private $id_Prodotto;
    private $nome;
    private $prezzo;
    private $descrizione;
    private $link_Immagine;


    function __construct($id_Prodotto, $nome, $prezzo, $descrizione, $link_Immagine)
    {
        $this->id_Prodotto = $id_Prodotto;
        $this->nome = $nome;
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
        $this->link_Immagine = $link_Immagine;
    }

    function GetId_Prodotto()
    {
        return $this->id_Prodotto;
    }

    function GetNome()
    {
        return $this->nome;
    }

    function GetPrezzo()
    {
        return $this->prezzo;
    }

    function GetDescrizione()
    {
        return $this->descrizione;
    }

    function GetLink_Immagine()
    {
        return $this->link_Immagine;
    }
}