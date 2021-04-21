<?php

class Libro
{
    private $id;
    private $id_vendedor;
    private $titulo;
    private $autor;
    private $editor;
    private $img1;
    private $img2;
    private $img3;
    private $fecha_publicacion;
    private $isbn;
    private $issn;
    private $fecha_subida;
    private $precio;
    private $calidad;
    private $activo;

    public function __construct($id, $id_vendedor, $titulo, $autor, $editor, $img1, $img2, $img3, $fecha_publicacion, $isbn, $issn, $fecha_subida, $precio, $calidad, $activo)
    {
        $this->id = $id;
        $this->id_vendedor = $id_vendedor;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editor = $editor;
        $this->img1 = $img1;
        $this->img2 = $img2;
        $this->img3 = $img3;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->isbn = $isbn;
        $this->issn = $issn;
        $this->fecha_subida = $fecha_subida;
        $this->precio = $precio;
        $this->calidad = $calidad;
        $this->activo = $activo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdVendedor()
    {
        return $this->id_vendedor;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getEditor()
    {
        return $this->editor;
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

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getIssn()
    {
        return $this->issn;
    }

    public function getFechaSubida()
    {
        return $this->fecha_subida;
    }

    public function getCalidad()
    {
        return $this->calidad;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setEditor($editor)
    {
        $this->editor = $editor;
    }

    public function setImg1($img1)
    {
        $this->img1 = $img1;
    }

    public function setImg2($img2)
    {
        $this->img2 = $img2;
    }

    public function setImg3($img3)
    {
        $this->img3 = $img3;
    }

    public function setFechaPublicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function setIssn($issn)
    {
        $this->issn = $issn;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setCalidad($calidad)
    {
        $this->calidad = $calidad;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

}