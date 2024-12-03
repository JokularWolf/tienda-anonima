<?php

class Conexion {
    private $mysqlConexion;
    private $resultado;
    
    public function abrirConexion() {
        $this->mysqlConexion = new mysqli("localhost", "root", "", "tiendaanonima");

        if ($this->mysqlConexion->connect_error) {
            die("Error de conexión: " . $this->mysqlConexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->mysqlConexion;
    }

    public function ejecutarConsulta($sentenciaSQL) {
        $this->resultado = $this->mysqlConexion->query($sentenciaSQL);
    }

    public function siguienteRegistro() {
        return $this->resultado->fetch_row();
    }

    public function obtenerLlaveAutonumerica() {
        return $this->mysqlConexion->insert_id;
    }

    public function cerrarConexion() {
        $this->mysqlConexion->close();
    }

    public function numeroFilas() {
        return $this->resultado->num_rows;
    }
}

?>
