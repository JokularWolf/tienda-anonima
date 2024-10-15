<?php
require_once (dirname(__DIR__) . '/persistencia/Conexion.php');
require_once  (dirname(__DIR__) . '/persistencia/ProductoDAO.php');

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $marca;
    private $categoria;

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getPrecioCompra () {
        return $this->precioCompra;
    }

    public function getPrecioVenta () {
        return $this->precioVenta;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setPrecioCompra($precioCompra){
        $this->precioCompra = $precioCompra;
    }

    public function setPrecioVenta($precioVenta){
        $this->precioVenta = $precioVenta;
    }

    public function setMarca($marca){
        $this->marca = $marca;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, Marca $marca = null, Categoria $categoria = null){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this->marca = $marca;
        $this->categoria = $categoria;
    }
    
    public function consultarProductos(){
        $productos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutarConsulta($productoDAO -> consultarProductos());
        while($registro = $conexion -> siguienteRegistro()){
            $marca = new Marca($registro[5], $registro[6]);
            $categoria = new Categoria($registro[7], $registro[8]);
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $marca, $categoria);           
            array_push($productos, $producto);
        }
        $conexion -> cerrarConexion();
        return $productos;        
    }
    
}

?>