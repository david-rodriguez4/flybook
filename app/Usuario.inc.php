<?php

class Usuario {

    private $id;
    private $nombre;
    private $apellido;
    private $docid;
    private $fecha_nacimiento;
    private $email;
    private $password;
    private $fecha_registro;
    private $estado;

    public function __construct($id, $nombre, $apellido, $docid, $fecha_nacimiento, $email, $password, $fecha_registro, $estado) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->docid = $docid;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->email = $email;
        $this->password = $password;
        $this->fecha_registro = $fecha_registro;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }
    
    public function getApellido() {
        return $this->apellido;
    }
    
    public function getDocid() {
        return $this->docid;
    }
    
    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFechaRegistro() {
        return $this->fecha_registro;
    }
    
    public function getEstado() {
        return $this->estado;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setApellido($apellido) {
        $this->nombre = $apellido;
    }
    
    public function setDocid($docid) {
        $this->nombre = $docid;
    }
    
    public function setFechaNacimiento($fecha_nacimiento) {
        $this->nombre = $fecha_nacimiento;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setEstado($estado) {
        $this->password = $estado;
    }

}
