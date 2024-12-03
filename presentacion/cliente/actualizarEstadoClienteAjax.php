<?php
        $idPersona = $_POST['idPersona'];
        $estado = $_POST['estado'];
    
        // Depuración
        $mensaje = "Datos recibidos correctamente: ID Persona - $idPersona, Estado - $estado.";
        $mensaje .= " Estado actualizado correctamente.";
    
        // Crear el objeto Cliente y ejecutar la actualización
        $cliente = new Cliente($idPersona);
        $cliente->actualizar($idPersona, $estado); // Aquí se imprimirá la consulta generada
    
        echo $mensaje; // Respuesta completa

    
?>
