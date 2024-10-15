<?php
include("../componentes/encabezado.php");
?>

<style>
.material-symbols-rounded {
  font-variation-settings:
  'FILL' 1,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24;
}
</style>
</head>
<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10 col-sm-12">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Crear Producto</h1>
                            
                            <!-- Formulario de creación de producto -->
                            <form method="post" action="crearProducto.php" class="needs-validation" novalidate="" autocomplete="off">
                                
                                <!-- Nombre del producto -->
                                <div class="mb-3">
                                    <label class="mb-3 text-muted" for="nombre">Nombre del Producto</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                                </div>

                                <!-- Cantidad -->
                                <div class="mb-3">
                                    <label class="mb-3 text-muted" for="cantidad">Cantidad</label>
                                    <input id="cantidad" type="number" class="form-control" name="cantidad" required>
                                </div>

                                <!-- Precio de Compra -->
                                <div class="mb-3">
                                    <label class="mb-3 text-muted" for="precioCompra">Precio de Compra</label>
                                    <input id="precioCompra" type="number" class="form-control" name="precioCompra" required>
                                </div>

                                <!-- Precio de Venta -->
                                <div class="mb-3">
                                    <label class="mb-3 text-muted" for="precioVenta">Precio de Venta</label>
                                    <input id="precioVenta" type="number" class="form-control" name="precioVenta" required>
                                </div>

								<div class="mb-3">
                                    <label class="mb-3 text-muted" for="marca">Marca</label>
                                    <select id="marca" class="form-control" name="marca" required>
                                        <option value="" disabled selected>Seleccione una marca</option>
                                        <?php 
                                        // Cargar las categorías desde la base de datos
                                        require_once ("../logica/Marca.php");
                                        
                                        // Crear una instancia de la clase Categoria
                                        $marca = new Marca();
                                        $marcas = $marca->consultarMarca();
                                        
                                        // Iterar sobre las categorías obtenidas y mostrarlas en el menú desplegable
                                        foreach ($marcas as $marcaActual) {
                                            echo "<option value='" . $marcaActual->getIdMarca() . "'>" . $marcaActual->getNombre() . "</option>"; 
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Selección de Categoría -->
                                <div class="mb-3">
                                    <label class="mb-3 text-muted" for="categoria">Categoría</label>
                                    <select id="categoria" class="form-control" name="categoria" required>
                                        <option value="" disabled selected>Seleccione una categoría</option>
                                        <?php 
                                        // Cargar las categorías desde la base de datos
                                        require_once ("../logica/Categoria.php");
                                        
                                        // Crear una instancia de la clase Categoria
                                        $categoria = new Categoria();
                                        $categorias = $categoria->consultarCategoria();
                                        
                                        // Iterar sobre las categorías obtenidas y mostrarlas en el menú desplegable
                                        foreach ($categorias as $categoriaActual) {
                                            echo "<option value='" . $categoriaActual->getIdCategoria() . "'>" . $categoriaActual->getNombre() . "</option>"; 
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Botón para enviar el formulario -->
                                <div class="d-grid gap-2">
                                    <button type="submit" name="crearProducto" class="btn btn-primary">
                                        Crear Producto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Incluir el footer -->
                <?php include("../componentes/footer.php") ?>
            </div>
        </div>
    </section>
</body>
</html>
