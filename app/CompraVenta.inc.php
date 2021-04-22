<?php


class CompraVenta
{
    private $id;
    private $id_vendedor;
    private $id_comprador;
    private $id_libro;
    private $estado;
    private $fecha_compra;

    public function __construct($id, $id_vendedor, $id_comprador, $id_libro, $estado, $fecha_compra)
    {
        $this->id = $id;
        $this->id_vendedor = $id_vendedor;
        $this->id_comprador = $id_comprador;
        $this->id_libro = $id_libro;
        $this->estado = $estado;
        $this->fecha_compra = $fecha_compra;
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

    public function getIdComprador()
    {
        return $this->id_comprador;
    }

    public function setIdComprador($id_comprador)
    {
        $this->id_comprador = $id_comprador;
    }

    public function getIdLibro()
    {
        return $this->id_libro;
    }

    public function setIdLibro($id_libro)
    {
        $this->id_libro = $id_libro;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    public function setFechaCompra($fecha_compra)
    {
        $this->fecha_compra = $fecha_compra;
    }
}