<?php
session_start();
if(isset($_GET["cerrarSesion"])){
    session_destroy();
}
require ("logica/Producto.php");
require ("logica/Categoria.php");
require ("logica/Marca.php");
require ("logica/Persona.php");
require ("logica/Administrador.php");
require ("logica/Cliente.php");

$paginasSinSesion = array(
    "presentacion/iniciarSesion.php",
    "presentacion/cliente/registrarCliente.php",
    "presentacion/sinPermiso.php",
);

$paginasConSesion = array(
    "presentacion/sesionAdministrador.php",
    "presentacion/sesionCliente.php",
    "presentacion/producto/buscarProducto.php",
    "presentacion/cliente/buscarCliente.php"
);

?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<!-- <script src="presentacion/js/cliente.js"></script> -->
</head>
<body>
<?php 
if(!isset($_GET["pid"])){
    include ("presentacion/encabezado.php");
    include ("presentacion/menu.php");
    include ("presentacion/producto/consultaProductoInicio.php");    
}else{
    $pid = base64_decode($_GET["pid"]);
    if(in_array($pid, $paginasSinSesion)){
        include ($pid);
    }else if(in_array($pid, $paginasConSesion)){
        if(isset($_SESSION["id"])){
            include ($pid);
        }else{
            include ("presentacion/iniciarSesion.php");
        }
    }else{
        echo "<h1>Error 404</h1>";        
    }
}

?>
</body>
</html>