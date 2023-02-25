<?php
class Ordine
{
    private $id_Ordine;
    private $totale;
    private $data;
    private $username;
    private $arrayProdotti;

    function __construct($id_Ordine, $totale, $data, $username, $arrayProdotti)
    {
        $this->id_Ordine = $id_Ordine;
        $this->totale = $totale;
        $this->data = $data;
        $this->username = $username;
        $this->arrayProdotti = $arrayProdotti;
    }

    function GetId_Ordine()
    {
        return $this->id_Ordine;
    }

    function GetTotale()
    {
        return $this->totale;
    }

    function GetData()
    {
        return $this->data;
    }

    function GetUsername()
    {
        return $this->username;
    }

    function GetArrayProdotti()
    {
        return $this->arrayProdotti;
    }
}