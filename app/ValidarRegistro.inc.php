<?php

include_once 'RepositorioUsuario.inc.php';

class ValidarRegistro
{

    private $aviso_inicio;
    private $aviso_cierre;

    private $nombre;
    private $apellido;
    private $email;
    private $clave;
    private $direccion;
    private $estado;

    private $error_nombre;
    private $error_apellido;
    private $error_email;
    private $error_clave1;
    private $error_clave2;
    private $error_direccion;

    public function __construct($nombre, $apellido, $email, $clave1, $clave2, $direccion, $conexion)
    {

        $this->aviso_inicio = "<div class='panel-block'><div class='message is-danger'><div class='message-body' role='alert'>";
        $this->aviso_cierre = "</div></div></div>";

        $this->nombre = "";
        $this->apellido = "";
        $this->email = "";
        $this->clave = "";
        $this->direccion = "";
        $this->estado = "";

        $this->error_nombre = $this->validar_nombre($nombre);
        $this->error_apellido = $this->validar_apellido($apellido);
        $this->error_email = $this->validar_email($conexion, $email);
        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1, $clave2);
        $this->error_direccion = $this->validar_direccion($direccion);

        if ($this->error_clave1 === "" && $this->error_clave2 === "") {
            $this->clave = $clave1;
        }
    }

    private function variable_iniciada($variable)
    {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombre($nombre)
    {
        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir tu nombre.";
        } else {
            $this->nombre = $nombre;
        }
        return "";
    }

    private function validar_apellido($apellido)
    {
        if (!$this->variable_iniciada($apellido)) {
            return "Debes escribir tu apellido.";
        } else {
            $this->apellido = $apellido;
        }
        return "";
    }

    private function validar_email($conexion, $email)
    {
        if (!$this->variable_iniciada($email)) {
            return "Debes escribir un email.";
        } else {
            $this->email = $email;
        }
        if (RepositorioUsuario:: emailExiste($conexion, $email)) {
            return "El correo electrónico ya está en uso. Intenta recuperar tu contraseña <a href='#'>aquí</a>.";
        }
        return "";
    }

    private function validar_clave1($clave1)
    {
        if (!$this->variable_iniciada($clave1)) {
            return "Debes escribir una contraseña.";
        }
        if (strlen($clave1) < 6) {
            return "La contraseña debe ser mayor a 6 caracteres.";
        }

        if (strlen($clave1) > 24) {
            return "La contraseña no debe ser mayor a 24 caracteres.";
        }
        return "";
    }

    private function validar_clave2($clave1, $clave2)
    {
        if (!$this->variable_iniciada($clave1)) {
            return "Primero debes escribir la contraseña.";
        }

        if (!$this->variable_iniciada($clave2)) {
            return "Debes repertir la contraseña.";
        }

        if ($clave1 !== $clave2) {
            return "Las contraseñas no coinciden.";
        }
        return "";
    }

    private function validar_direccion($direccion)
    {
        if (!$this->variable_iniciada($direccion)) {
            return "Debes escribir tu dirección de residencia.";
        } else {
            $this->direccion = $direccion;
        }
        return "";
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getErrorNombre()
    {
        return $this->error_nombre;
    }

    public function getErrorEmail()
    {
        return $this->error_email;
    }

    public function getErrorClave1()
    {
        return $this->error_clave1;
    }

    public function getErrorClave2()
    {
        return $this->error_clave2;
    }

    public function getErrorDireccion()
    {
        return $this->error_direccion;
    }

    public function mostrarErrorNombre()
    {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }

    public function mostrarErrorApellido()
    {
        if ($this->error_apellido !== "") {
            echo $this->aviso_inicio . $this->error_apellido . $this->aviso_cierre;
        }
    }

    public function mostrarErrorEmail()
    {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrarErrorClave1()
    {
        if ($this->error_clave1 !== "") {
            echo $this->aviso_inicio . $this->error_clave1 . $this->aviso_cierre;
        }
    }

    public function mostrarErrorClave2()
    {
        if ($this->error_clave2 !== "") {
            echo $this->aviso_inicio . $this->error_clave2 . $this->aviso_cierre;
        }
    }

    public function mostrarErrorDireccion()
    {
        if ($this->error_direccion !== "") {
            echo $this->aviso_inicio . $this->error_direccion . $this->aviso_cierre;
        }
    }

    public function registroValido()
    {
        if ($this->error_nombre === "" && $this->error_apellido === "" && $this->error_email === "" && $this->error_clave1 === "" && $this->error_clave2 === "" && $this->error_direccion === "") {
            return true;
        } else {
            return false;
        }
    }

}
