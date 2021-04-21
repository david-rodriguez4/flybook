<?php

include_once 'app/RepositorioUsuario.inc.php';

class ValidarLogin {

    private $usuario;
    private $error;

    public function __construct($email, $clave, $conexion) {
        $this->error = "";

        if (!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)) {
            $this->usuario = null;
            $this->error = "Escribe tus datos para iniciar sesión.";
        } else {
            $this->usuario = RepositorioUsuario :: getUsuarioEmail($conexion, $email);
            if (is_null($this->usuario) || !password_verify($clave, $this->usuario->getPassword())) {
                $this->error = "El correo electrónico y/o la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa y vuelve a intentarlo.";
            }
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    public function obtener_usuario() {
        return $this->usuario;
    }

    public function obtener_error() {
        return $this->error;
    }

    public function mostrar_error() {
        if ($this->error !== "") {
            echo "<div class='panel-block'><div class='message is-danger'><div class='message-body' role='alert'>";
            echo $this->error;
            echo "</div></div></div>";
        }
    }

}
