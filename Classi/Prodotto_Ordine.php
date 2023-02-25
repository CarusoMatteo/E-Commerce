<?php
class Prodotto_Ordine
{
    private $nome;
    private $quantità;


    function __construct($nome, $quantità)
    {
        $this->nome = $nome;
        $this->quantità = $quantità;
    }

    function GetNome()
    {
        return $this->nome;
    }

    function GetQuantità()
    {
        return $this->quantità;
    }
}