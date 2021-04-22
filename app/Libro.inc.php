<?php

class Libro
{
    private $id;
    private $id_vendedor;
    private $titulo;
    private $autor;
    private $editorial;
    private $edicion;
    private $img1;
    private $img2;
    private $img3;
    private $year_publicacion;
    private $isbn;
    private $issn;
    private $fecha_subida;
    private $precio;
    private $calidad;
    private $activo;

    public function __construct($id, $id_vendedor, $titulo, $autor, $editorial, $edicion, $img1, $img2, $img3, $year_publicacion, $isbn, $issn, $fecha_subida, $precio, $calidad, $activo)
    {
        $this->id = $id;
        $this->id_vendedor = $id_vendedor;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->edicion = $edicion;
        $this->img1 = $img1;
        $this->img2 = $img2;
        $this->img3 = $img3;
        $this->year_publicacion = $year_publicacion;
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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdVendedor()
    {
        return $this->id_vendedor;
    }

    public function setIdVendedor($id_vendedor)
    {
        $this->id_vendedor = $id_vendedor;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getEditorial()
    {
        return $this->editorial;
    }

    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    public function getEdicion()
    {
        return $this->edicion;
    }

    public function setEdicion($edicion)
    {
        $this->edicion = $edicion;
    }

    public function getImg1()
    {
        return $this->img1;
    }

    public function setImg1($img1)
    {
        $this->img1 = $img1;
    }

    public function getImg2()
    {
        return $this->img2;
    }

    public function setImg2($img2)
    {
        $this->img2 = $img2;
    }

    public function getImg3()
    {
        return $this->img3;
    }

    public function setImg3($img3)
    {
        $this->img3 = $img3;
    }

    public function getYearPublicacion()
    {
        return $this->year_publicacion;
    }

    public function setYearPublicacion($year_publicacion)
    {
        $this->year_publicacion = $year_publicacion;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function getIssn()
    {
        return $this->issn;
    }

    public function setIssn($issn)
    {
        $this->issn = $issn;
    }

    public function getFechaSubida()
    {
        return $this->fecha_subida;
    }

    public function setFechaSubida($fecha_subida)
    {
        $this->fecha_subida = $fecha_subida;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getCalidad()
    {
        return $this->calidad;
    }

    public function setCalidad($calidad)
    {
        $this->calidad = $calidad;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

}