<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/CompraVenta.inc.php';

class RepositorioCompraVenta
{

    public static function insertar_compraventa($conexion, $compraventa)
    {
        $libro_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO compraventa(id, id_vendedor, id_comprador, id_libro, estado) VALUES(:id, :id_vendedor, :id_comprador, :id_libro, 0)";
                $setencia = $conexion->prepare($sql);

                $idtemp = $compraventa->getId();
                $idvendedortemp = $compraventa->getIdVendedor();
                $idcompradortemp = $compraventa->getIdComprador();
                $idlibrotemp = $compraventa->getIdLibro();

                $setencia->bindParam(':id', $idtemp, PDO::PARAM_STR);
                $setencia->bindParam(':id_vendedor', $idvendedortemp, PDO::PARAM_STR);
                $setencia->bindParam(':id_comprador', $idcompradortemp, PDO::PARAM_STR);
                $setencia->bindParam(':id_libro', $idlibrotemp, PDO::PARAM_STR);

                $libro_insertado = $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libro_insertado;
    }

    public static function obtener_compras_id_comprador($conexion, $id_comprador)
    {
        $compras = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM compraventa WHERE id_comprador = :id_comprador";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id_comprador', $id_comprador, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $compras[] = new CompraVenta($fila['id'], $fila['id_vendedor'], $fila['id_comprador'], $fila['id_libro'], $fila['id_pago'], $fila['img_pago'], $fila['id_envio'], $fila['img_envio'], $fila['estado'], $fila['fecha_pago'], $fila['fecha_envio']);
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $compras;
    }

    public static function obtener_compra_id_vendedor_id_libro($conexion, $id_vendedor, $id_libro)
    {
        $compra = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM compraventa WHERE id_vendedor = :id_vendedor AND id_libro = :id_libro";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_STR);
                $setencia->bindParam(':id_libro', $id_libro, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetch();
                if (!empty($resultado)) {
                    $compra = new CompraVenta($resultado['id'], $resultado['id_vendedor'], $resultado['id_comprador'], $resultado['id_libro'], $resultado['id_pago'], $resultado['img_pago'], $resultado['id_envio'], $resultado['img_envio'], $resultado['estado'], $resultado['fecha_pago'], $resultado['fecha_envio']);
                } else {
                    $compra = new CompraVenta("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $compra;
    }

    public static function obtener_compra_id($conexion, $id)
    {
        $compra = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM compraventa WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetch();
                if (!empty($resultado)) {
                    $compra = new CompraVenta($resultado['id'], $resultado['id_vendedor'], $resultado['id_comprador'], $resultado['id_libro'], $resultado['id_pago'], $resultado['img_pago'], $resultado['id_envio'], $resultado['img_envio'], $resultado['estado'], $resultado['fecha_pago'], $resultado['fecha_envio']);
                } else {
                    $compra = new CompraVenta("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $compra;
    }

    public static function obtener_compras_id_comprador_pagar($conexion, $id_comprador)
    {
        $compras = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM compraventa WHERE id_comprador = :id_comprador AND estado = 0";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id_comprador', $id_comprador, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $compras[] = new CompraVenta($fila['id'], $fila['id_vendedor'], $fila['id_comprador'], $fila['id_libro'], $fila['id_pago'], $fila['img_pago'], $fila['id_envio'], $fila['img_envio'], $fila['estado'], $fila['fecha_pago'], $fila['fecha_envio']);
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $compras;
    }

    public static function obtener_compras_id_vendedor_enviar($conexion, $id_vendedor)
    {
        $ventas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM compraventa WHERE id_vendedor = :id_vendedor AND estado = 1";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $ventas[] = new CompraVenta($fila['id'], $fila['id_vendedor'], $fila['id_comprador'], $fila['id_libro'], $fila['id_pago'], $fila['img_pago'], $fila['id_envio'], $fila['img_envio'], $fila['estado'], $fila['fecha_pago'], $fila['fecha_envio']);
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $ventas;
    }

    public static function actualizar_estado_pago($conexion, $id)
    {
        if (isset($conexion)) {
            try {
                $sql = "UPDATE compraventa SET estado = 1, fecha_compra = NOW() WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return true;
    }

    public static function insertar_actualizar_pago($conexion, $id, $id_pago, $img_pago, $estado)
    {
        $libro_pago = false;

        if (isset($conexion)) {
            try {
                $sql = "UPDATE compraventa SET id_pago = :id_pago, img_pago = :img_pago, estado = :estado, fecha_pago = NOW() WHERE id = :id";
                $setencia = $conexion->prepare($sql);

                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->bindParam(':id_pago', $id_pago, PDO::PARAM_STR);
                $setencia->bindParam(':img_pago', $img_pago, PDO::PARAM_STR);
                $setencia->bindParam(':estado', $estado, PDO::PARAM_STR);

                $libro_pago = $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libro_pago;
    }

    public static function insertar_actualizar_envio($conexion, $id, $img_envio, $estado)
    {
        $libro_pago = false;

        if (isset($conexion)) {
            try {
                $sql = "UPDATE compraventa SET img_envio = :img_envio, estado = :estado, fecha_envio = NOW() WHERE id = :id";
                $setencia = $conexion->prepare($sql);

                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->bindParam(':img_envio', $img_envio, PDO::PARAM_STR);
                $setencia->bindParam(':estado', $estado, PDO::PARAM_STR);

                $libro_pago = $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libro_pago;
    }
}