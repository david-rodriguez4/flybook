<?php

class RepositorioUsuario
{

    public static function getAll($conexion)
    {

        $usuarios = array();

        if (isset($conexion)) {

            try {

                include_once 'Usuario.inc.php';

                $sql = "SELECT * FROM usuarios";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $usuarios[] = new Usuario($fila['id'], $fila['nombre'], $fila['apellido'], $fila['email'], $fila['password'], $fila['direccion'], $fila['fecha_registro'], $fila['estado']);
                    }
                } else {
                    print 'No hay usuarios';
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $usuarios;
    }

    public static function getUsuarios($conexion)
    {
        $total_usuarios = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM usuarios";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $total_usuarios;
    }

    public static function insertarUsuario($conexion, $usuario)
    {
        $usuario_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuarios(id, nombre, apellido, email, password, direccion, fecha_registro, estado) VALUES(:id, :nombre, :apellido, :email, :password, :direccion, NOW(), 0)";
                $setencia = $conexion->prepare($sql);

                $idtemp = $usuario->getId();
                $nombretemp = $usuario->getNombre();
                $apellidotemp = $usuario->getApellido();
                $emailtemp = $usuario->getEmail();
                $passwordtemp = $usuario->getPassword();
                $direcciontemp = $usuario->getDireccion();

                $setencia->bindParam(':id', $idtemp, PDO::PARAM_STR);
                $setencia->bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $setencia->bindParam(':apellido', $apellidotemp, PDO::PARAM_STR);
                $setencia->bindParam(':email', $emailtemp, PDO::PARAM_STR);
                $setencia->bindParam(':password', $passwordtemp, PDO::PARAM_STR);
                $setencia->bindParam(':direccion', $direcciontemp, PDO::PARAM_STR);
                $usuario_insertado = $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }

    public static function emailExiste($conexion, $email)
    {
        $email_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':email', $email, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $email_existe;
    }

    public static function getUsuarioEmail($conexion, $email)
    {
        $usuario = "";

        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':email', $email, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetch();
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['apellido'], $resultado['email'], $resultado['password'], $resultado['direccion'], $resultado['fecha_registro'], $resultado['estado']);
                } else {
                    $usuario = new Usuario(null, null, null, null, null, null, null, null);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $usuario;
    }

    public static function getUsuarioId($conexion, $id)
    {
        $usuario = "";

        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetch();
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['apellido'], $resultado['email'], $resultado['password'], $resultado['direccion'], $resultado['fecha_registro'], $resultado['estado']);
                } else {
                    $usuario = new Usuario(null, null, null, null, null, null, null, null);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $usuario;
    }

}
