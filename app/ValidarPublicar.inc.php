<?php
include_once 'RepositorioLibro.inc.php';

class ValidarPublicar
{
    private $aviso_inicio;
    private $aviso_cierre;

    private $titulo;
    private $autor;
    private $editor;
    private $img1;
    private $img2;
    private $img3;
    private $fecha_publicacion;
    private $precio;
    private $calidad;

    private $error_titulo;
    private $error_autor;
    private $error_img1;
    private $error_img2;
    private $error_img3;
    private $error_fecha_publicacion;
    private $error_precio;
    private $error_calidad;

    public function __construct($titulo, $autor, $img1, $img2, $img3, $fecha_publicacion, $precio, $calidad)
    {
        $this->aviso_inicio = "<div class='panel-block'><div class='message is-danger'><div class='message-body' role='alert'>";
        $this->aviso_cierre = "</div></div></div>";

        $this->titulo = "";
        $this->autor = "";
        $this->img1 = "";
        $this->img2 = "";
        $this->img3 = "";
        $this->fecha_publicacion = "";
        $this->precio = "";
        $this->calidad = "";

        $this->error_titulo = $this->validar_titulo($titulo);
        $this->error_autor = $this->validar_autor($autor);
        $this->error_img1 = $this->validar_img1($img1);
        $this->error_img2 = $this->validar_img2($img2);
        $this->error_img3 = $this->validar_img3($img3);
        $this->error_fecha_publicacion = $this->validar_fp($fecha_publicacion);
        $this->error_precio = $this->validar_precio($precio);
        $this->error_calidad = $this->validar_calidad($calidad);

        if (!$this->variable_iniciada($titulo) || !$this->variable_iniciada($autor) || !$this->variable_iniciada($precio) || !$this->variable_iniciada($img1) || !$this->variable_iniciada($img2) || !$this->variable_iniciada($img3)) {
            $this->libro = null;
            $this->error = "Escribe los datos esenciales del libro. Ingresa el título, autor, una foto y el precio.";
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

    private function validar_titulo($titulo)
    {
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir el título.";
        } else {
            $this->titulo = $titulo;
        }
        return "";
    }

    private function validar_autor($autor)
    {
        if (!$this->variable_iniciada($autor)) {
            return "Debes escribir el autor.";
        } else {
            $this->autor = $autor;
        }
        return "";
    }

    private function validar_img1($img1)
    {
        if ($img1 == "") {
            return "Selecciona la foto de la portada del libro.";
        } else {
            $this->img1 = $img1;
        }
        return "";
    }

    private function validar_img2($img2)
    {
        if ($img2 == "") {
            return "Selecciona la foto de las hojas del libro.";
        } else {
            $this->img2 = $img2;
        }
        return "";
    }

    private function validar_img3($img3)
    {
        if ($img3 == "") {
            return "Selecciona del lomo del libro.";
        } else {
            $this->img3 = $img3;
        }
        return "";
    }

    private function validar_fp($fecha_publicacion)
    {
        if ($fecha_publicacion > date("Y")) {
            return "Debes escribir un año menor a " . date("Y") . ".";
        } else {
            $this->fecha_publicacion = $fecha_publicacion;
        }
        return "";
    }

    private function validar_precio($precio)
    {
        if (!$this->variable_iniciada($precio)) {
            return "Debes elegir un precio.";
        } else {
            $this->precio = $precio;
        }
        return "";
    }

    private function validar_calidad($calidad)
    {
        if (!$this->variable_iniciada($calidad)) {
            return "Debes escribir un número entre 1 y 100.";
        } elseif ($calidad > 100) {
            return "Debes escribir un número menor a 100.";
        } elseif ($calidad < 1) {
            return "Debes escribir un número mayor a 1.";
        } else {
            $this->calidad = $calidad;
        }
        return "";
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getImg1()
    {
        return $this->img1;
    }

    public function getImg2()
    {
        return $this->img2;
    }

    public function getImg3()
    {
        return $this->img3;
    }

    public function getFechaPublicacion()
    {
        return $this->fecha_publicacion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getCalidad()
    {
        return $this->calidad;
    }

    public function mostrarErrorTitulo()
    {
        if ($this->error_titulo !== "") {
            echo $this->aviso_inicio . $this->error_titulo . $this->aviso_cierre;
        }
    }

    public function mostrarErrorAutor()
    {
        if ($this->error_autor !== "") {
            echo $this->aviso_inicio . $this->error_autor . $this->aviso_cierre;
        }
    }

    public function mostrarErrorFP()
    {
        if ($this->error_fecha_publicacion !== "") {
            echo $this->aviso_inicio . $this->error_fecha_publicacion . $this->aviso_cierre;
        }
    }

    public function mostrarErrorImg1()
    {
        if ($this->error_img1 !== "") {
            echo $this->aviso_inicio . $this->error_img1 . $this->aviso_cierre;
        }
    }

    public function mostrarErrorImg2()
    {
        if ($this->error_img2 !== "") {
            echo $this->aviso_inicio . $this->error_img2 . $this->aviso_cierre;
        }
    }

    public function mostrarErrorImg3()
    {
        if ($this->error_img3 !== "") {
            echo $this->aviso_inicio . $this->error_img3 . $this->aviso_cierre;
        }
    }

    public function mostrarErrorPrecio()
    {
        if ($this->error_precio !== "") {
            echo $this->aviso_inicio . $this->error_precio . $this->aviso_cierre;
        }
    }

    public function mostrarErrorCalidad()
    {
        if ($this->error_calidad !== "") {
            echo $this->aviso_inicio . $this->error_calidad . $this->aviso_cierre;
        }
    }

    public function publicarValido()
    {
        if ($this->error_titulo === "" && $this->error_autor === "" && $this->error_img1 === "" && $this->error_precio === "") {
            return true;
        } else {
            return false;
        }
    }

}