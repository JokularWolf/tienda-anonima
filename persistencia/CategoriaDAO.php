<?php

class CategoriaDAO{

    private $idCategoria;
    private $nombre;


    public function __construct($idCategoria=0, $nombre="")
    {
        $this ->idCategoria = $idCategoria;
        $this -> nombre = $nombre;

    }

    public function consultarCategoria(){

        return "SELECT idCategoria,nombre FROM categoria";
    }

}


?>