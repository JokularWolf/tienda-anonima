<?php

class Cliente extends Persona{
    
    public function __construct($estado=0, $idPersona=0, $nombre="", $apellido="", $correo="", $clave=""){
        parent::__construct($estado, $idPersona, $nombre, $apellido, $correo, $clave);
    }
    
    public function registrar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO($this -> idPersona, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave);
        $conexion -> ejecutarConsulta($clienteDAO -> registrar());
        $this -> idPersona = $conexion -> obtenerLlaveAutonumerica();
        $conexion -> cerrarConexion();
        echo $this -> idPersona;
    }
 
    public function autenticar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO(null, null, null, null, $this -> correo, $this -> clave);
        $conexion -> ejecutarConsulta($clienteDAO -> autenticar());
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }else{
            $registro = $conexion -> siguienteRegistro();
            $this -> idPersona = $registro[0];
            $conexion -> cerrarConexion();
            return true;
        }
    }
    
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO($this -> idPersona);
        $conexion -> ejecutarConsulta($clienteDAO -> consultar());
        $registro = $conexion -> siguienteRegistro();
        $this -> estado = $registro[0];
        $this -> nombre = $registro[1];
        $this -> apellido = $registro[2];
        $this -> correo = $registro[3];
        $conexion -> cerrarConexion();
    }

    public function buscar($filtro){
        $clientes = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $ClienteDAO = new ClienteDAO();
        $conexion -> ejecutarConsulta($ClienteDAO -> buscar($filtro));
        while($registro = $conexion -> siguienteRegistro()){

            $cliente = new Cliente($registro[0], $registro[1], $registro[2], $registro[3], $registro[4]);
            array_push($clientes, $cliente);
        }
        $conexion -> cerrarConexion();
        return $clientes;
    }    

    public function actualizar($estado, $idPersona) {
        $this->estado = $estado;
        $this->idPersona = $idPersona;

        $clienteDAO = new ClienteDAO($this->idPersona, $this->estado);
        $consulta = $clienteDAO->actualizar();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $conexion->ejecutarConsulta($consulta);
    
        $conexion->cerrarConexion();
        return true;
    }  
    
}

?>




