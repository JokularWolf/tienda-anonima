<?php
class MarcaDAO{
    private $idMarca;
    private $nombre;
    
    public function __construct($idMarca=0, $nombre=""){
        $this -> idMarca = $idMarca;
        $this -> nombre = $nombre;
    }
    
    public function consultarMarca(){
        return "select idMarca, nombre
                from Marca
                order by nombre asc";
    }

    public function consultarProductosPorMarca($idMarca) {
        return "SELECT p.nombre, p.cantidad, p.precioVenta
                FROM producto p
                JOIN marca m ON p.Marca_idMarca = m.idMarca
                WHERE m.idMarca = $idMarca";
    }
}

?>