<?php
class Prodotto_Carrello
{
    private $id_Prodotto;
    private $nome;
    private $prezzo;

    private $quantità;
    private $link_Immagine;

    function __construct($id_Prodotto, $nome, $prezzo, $quantità, $link_Immagine)
    {
        $this->id_Prodotto = $id_Prodotto;
        $this->nome = $nome;
        $this->prezzo = $prezzo;
        $this->quantità = $quantità;
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

    function GetQuantità()
    {
        return $this->quantità;
    }

    function GetLink_Immagine()
    {
        return $this->link_Immagine;
    }
}