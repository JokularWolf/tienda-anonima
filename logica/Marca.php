<?php
require_once (dirname(__DIR__) . '/persistencia/MarcaDAO.php');
require_once (dirname(__DIR__) . '/logica/Producto.php');
class Marca{
    private $idMarca;
    private $nombre;

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setIdProducto($idMarca){
        $this->idMarca = $idMarca;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function __construct($idMarca=0, $nombre=""){
        $this -> idMarca = $idMarca;
        $this -> nombre = $nombre;
    }
    
    public function consultarMarca(){
        $marcas = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $marcaDAO = new MarcaDAO();
        $conexion -> ejecutarConsulta($marcaDAO -> consultarMarca());
        while($registro = $conexion -> siguienteRegistro()){
            $marca = new Marca($registro[0], $registro[1]);
            array_push($marcas, $marca);
        }
        $conexion -> cerrarConexion();
        return $marcas;        
    }
    
    public function consultarPorMarca($idMarca) {
        $productos = array(); 
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $marcaDAO = new MarcaDAO();
        $conexion->ejecutarConsulta($marcaDAO->consultarProductosPorMarca($idMarca));
    
        while ($registro = $conexion->siguienteRegistro()) {
            $producto = new Producto(0, $registro[0], $registro[1], 0, $registro[2]);
            array_push($productos, $producto);
        }
        $conexion->cerrarConexion();
        return $productos;
    }
}

?>