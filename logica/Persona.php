<?php
require_once ("./persistencia/Conexion.php");
require ("./persistencia/AdministradorDAO.php");
require ("./persistencia/ClienteDAO.php");

class Persona{
    protected $idPersona;
    protected $estado;
    protected $nombre;
    protected $apellido;
    protected $correo;
    protected $clave;

    public function getIdPersona(){
        return $this->idPersona;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getClave(){
        return $this->clave;
    }

    public function setIdPersona($idPersona){
        $this->idPersona = $idPersona;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function setClave($clave){
        $this->clave = $clave;
    }
    
    public function __construct($idPersona, $estado, $nombre, $apellido, $correo, $clave){
        $this -> idPersona = $idPersona;
        $this -> estado = $estado;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }
    
}

?>