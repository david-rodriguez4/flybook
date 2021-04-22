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
                $sql = "INSERT INTO compraventa(id, id_vendedor, id_comprador, id_libro, estado, fecha_compra) VALUES(:id, :id_vendedor, :id_comprador, :id_libro, 0, NOW())";
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
                        $compras[] = new CompraVenta($fila['id'], $fila['id_vendedor'], $fila['id_comprador'], $fila['id_libro'], $fila['estado'], $fila['fecha_compra']);
                    }
                } else {
                    echo "No hay resultados";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $compras;
    }
}