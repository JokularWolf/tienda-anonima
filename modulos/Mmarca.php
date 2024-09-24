<?php 
require_once ("../logica/Marca.php");

// Verificar si se ha pasado un idMarca como parámetro en la URL
if (isset($_GET['idMarca'])) {
    $idMarca = $_GET['idMarca'];

    // Instanciar la clase Marca y llamar al método para consultar productos por marca
    $marca = new Marca();
    $productos = $marca->consultarPorMarca($idMarca);

    // Mostrar los productos de la marca
    echo "<h2>Productos de la marca seleccionada:</h2>";
    foreach ($productos as $productoActual) {
        echo "Nombre del producto: " . $productoActual->getNombre() . "<br>";
        echo "Cantidad: " . $productoActual->getCantidad() . "<br>";
        echo "Precio: $" . $productoActual->getPrecioVenta() . "<br><br>";
    }
} else {
    echo "No se ha seleccionado ninguna marca.";
}
?>