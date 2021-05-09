<?php


class CompraVenta
{
    private $id;
    private $id_vendedor;
    private $id_comprador;
    private $id_libro;
    private $id_pago;
    private $img_pago;
    private $id_envio;
    private $img_envio;
    private $estado;
    private $fecha_pago;
    private $fecha_envio;

    /**
     * CompraVenta constructor.
     * @param $id
     * @param $id_vendedor
     * @param $id_comprador
     * @param $id_libro
     * @param $id_pago
     * @param $img_pago
     * @param $id_envio
     * @param $img_envio
     * @param $estado
     * @param $fecha_pago
     * @param $fecha_envio
     */
    public function __construct($id, $id_vendedor, $id_comprador, $id_libro, $id_pago, $img_pago, $id_envio, $img_envio, $estado, $fecha_pago, $fecha_envio)
    {
        $this->id = $id;
        $this->id_vendedor = $id_vendedor;
        $this->id_comprador = $id_comprador;
        $this->id_libro = $id_libro;
        $this->id_pago = $id_pago;
        $this->img_pago = $img_pago;
        $this->id_envio = $id_envio;
        $this->img_envio = $img_envio;
        $this->estado = $estado;
        $this->fecha_pago = $fecha_pago;
        $this->fecha_envio = $fecha_envio;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdVendedor()
    {
        return $this->id_vendedor;
    }

    /**
     * @param mixed $id_vendedor
     */
    public function setIdVendedor($id_vendedor)
    {
        $this->id_vendedor = $id_vendedor;
    }

    /**
     * @return mixed
     */
    public function getIdComprador()
    {
        return $this->id_comprador;
    }

    /**
     * @param mixed $id_comprador
     */
    public function setIdComprador($id_comprador)
    {
        $this->id_comprador = $id_comprador;
    }

    /**
     * @return mixed
     */
    public function getIdLibro()
    {
        return $this->id_libro;
    }

    /**
     * @param mixed $id_libro
     */
    public function setIdLibro($id_libro)
    {
        $this->id_libro = $id_libro;
    }

    /**
     * @return mixed
     */
    public function getIdPago()
    {
        return $this->id_pago;
    }

    /**
     * @param mixed $id_pago
     */
    public function setIdPago($id_pago)
    {
        $this->id_pago = $id_pago;
    }

    /**
     * @return mixed
     */
    public function getImgPago()
    {
        return $this->img_pago;
    }

    /**
     * @param mixed $img_pago
     */
    public function setImgPago($img_pago)
    {
        $this->img_pago = $img_pago;
    }

    /**
     * @return mixed
     */
    public function getIdEnvio()
    {
        return $this->id_envio;
    }

    /**
     * @param mixed $id_envio
     */
    public function setIdEnvio($id_envio)
    {
        $this->id_envio = $id_envio;
    }

    /**
     * @return mixed
     */
    public function getImgEnvio()
    {
        return $this->img_envio;
    }

    /**
     * @param mixed $img_envio
     */
    public function setImgEnvio($img_envio)
    {
        $this->img_envio = $img_envio;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getFechaPago()
    {
        return $this->fecha_pago;
    }

    /**
     * @param mixed $fecha_pago
     */
    public function setFechaPago($fecha_pago)
    {
        $this->fecha_pago = $fecha_pago;
    }

    /**
     * @return mixed
     */
    public function getFechaEnvio()
    {
        return $this->fecha_envio;
    }

    /**
     * @param mixed $fecha_envio
     */
    public function setFechaEnvio($fecha_envio)
    {
        $this->fecha_envio = $fecha_envio;
    }


}