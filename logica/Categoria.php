<?php
require_once (dirname(__DIR__) . '/persistencia/Conexion.php');
require_once (dirname(__DIR__) . '/persistencia/CategoriaDAO.php');


class Categoria{
    private $idCategoria;
    private $nombre;

    public function getidCategoria(){
        return $this->idCategoria;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setidCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function __construct($idCategoria=0, $nombre="")
    {
        $this ->idCategoria = $idCategoria;
        $this -> nombre = $nombre;
    }


    public function consultarCategoria(){
        //Consulta a la base de datos para obtener la marca por id
        $categorias = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion -> ejecutarConsulta($categoriaDAO -> consultarCategoria());
        while($registro = $conexion ->siguienteRegistro()){
            $categoria = new Categoria($registro[0], $registro[1]);
            //Retorna un array de objetos de Marca
            array_push($categorias, $categoria);
        }
        $conexion -> cerrarConexion();
        return $categorias;
    }
    
}

?>