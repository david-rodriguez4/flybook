<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Libro.inc.php';

class RepositorioLibro
{
    public static function desactivar_libro($conexion, $id)
    {
        if (isset($conexion)) {
            try {
                $sql = "UPDATE libros SET activo = 0 WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return true;
    }

    public static function activar_libro($conexion, $id)
    {
        if (isset($conexion)) {
            try {
                $sql = "UPDATE libros SET activo = 1 WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return true;
    }

    public static function obtener_id_vendedor($conexion, $id_vendedor)
    {
        $libros = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM libros WHERE id_vendedor = :id_vendedor";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id_vendedor', $id_vendedor, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $libros[] = new Libro($fila['id'], $fila['id_vendedor'], $fila['titulo'], $fila['autor'], $fila['editorial'], $fila['edicion'], $fila['img1'], $fila['img2'], $fila['img3'], $fila['year_publicacion'], $fila['isbn'], $fila['issn'], $fila['fecha_subida'], $fila['precio'], $fila['calidad'], $fila['activo']);
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libros;
    }

    public static function insertar_libro($conexion, $libro)
    {
        $libro_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO libros(id, id_vendedor, titulo, autor, editorial, edicion, img1, img2, img3, year_publicacion, isbn, issn, fecha_subida, precio, calidad, activo) VALUES(:id, :id_vendedor, :titulo, :autor, :editorial, :edicion, :img1, :img2, :img3, :year_publicacion, :isbn, :issn, NOW(), :precio, :calidad, 1)";
                $setencia = $conexion->prepare($sql);

                $idtemp = $libro->getId();
                $idvendedortemp = $libro->getIdVendedor();
                $titulotemp = $libro->getTitulo();
                $autortemp = $libro->getAutor();
                $editorialtemp = $libro->getEditorial();
                $ediciontemp = $libro->getEdicion();
                $img1temp = $libro->getImg1();
                $img2temp = $libro->getImg2();
                $img3temp = $libro->getImg3();
                $yptemp = $libro->getYearPublicacion();
                $isbntemp = $libro->getIsbn();
                $issntemp = $libro->getIssn();
                $preciotemp = $libro->getPrecio();
                $calidadtemp = $libro->getCalidad();

                $setencia->bindParam(':id', $idtemp, PDO::PARAM_STR);
                $setencia->bindParam(':id_vendedor', $idvendedortemp, PDO::PARAM_STR);
                $setencia->bindParam(':titulo', $titulotemp, PDO::PARAM_STR);
                $setencia->bindParam(':autor', $autortemp, PDO::PARAM_STR);
                $setencia->bindParam(':editorial', $editorialtemp, PDO::PARAM_STR);
                $setencia->bindParam(':edicion', $ediciontemp, PDO::PARAM_STR);
                $setencia->bindParam(':img1', $img1temp, PDO::PARAM_STR);
                $setencia->bindParam(':img2', $img2temp, PDO::PARAM_STR);
                $setencia->bindParam(':img3', $img3temp, PDO::PARAM_STR);
                $setencia->bindParam(':year_publicacion', $yptemp, PDO::PARAM_STR);
                $setencia->bindParam(':isbn', $isbntemp, PDO::PARAM_STR);
                $setencia->bindParam(':issn', $issntemp, PDO::PARAM_STR);
                $setencia->bindParam(':precio', $preciotemp, PDO::PARAM_STR);
                $setencia->bindParam(':calidad', $calidadtemp, PDO::PARAM_STR);

                $libro_insertado = $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libro_insertado;
    }

    public static function obtener_todas_por_fecha_descendiente($conexion)
    {
        $libros = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM libros WHERE activo = 1 ORDER BY fecha_subida DESC";
                $setencia = $conexion->prepare($sql);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $libros[] = new Libro($fila['id'], $fila['id_vendedor'], $fila['titulo'], $fila['autor'], $fila['editorial'], $fila['edicion'], $fila['img1'], $fila['img2'], $fila['img3'], $fila['year_publicacion'], $fila['isbn'], $fila['issn'], $fila['fecha_subida'], $fila['precio'], $fila['calidad'], $fila['activo']);
                    }
                } else {
                    echo "<p>No hay resultados</p>";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libros;
    }

    public static function obtener_libro_por_id($conexion, $id)
    {
        $libro = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM libros WHERE id LIKE :id AND activo = 1";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetch();

                if (!empty($resultado)) {
                    $libro = new Libro($resultado['id'], $resultado['id_vendedor'], $resultado['titulo'], $resultado['autor'], $resultado['editorial'], $resultado['edicion'], $resultado['img1'], $resultado['img2'], $resultado['img3'], $resultado['year_publicacion'], $resultado['isbn'], $resultado['issn'], $resultado['fecha_subida'], $resultado['precio'], $resultado['calidad'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libro;
    }

    public static function obtener_libro_compras_por_id($conexion, $id)
    {
        $libro = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM libros WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetch();

                if (!empty($resultado)) {
                    $libro = new Libro($resultado['id'], $resultado['id_vendedor'], $resultado['titulo'], $resultado['autor'], $resultado['editorial'], $resultado['edicion'], $resultado['img1'], $resultado['img2'], $resultado['img3'], $resultado['year_publicacion'], $resultado['isbn'], $resultado['issn'], $resultado['fecha_subida'], $resultado['precio'], $resultado['calidad'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libro;
    }

    public static function obtener_libro_titulo_autor($conexion, $busqueda)
    {
        $libros = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM libros WHERE titulo LIKE :busqueda OR autor LIKE :busqueda AND activo = 1 ORDER BY fecha_subida DESC";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
                $setencia->execute();
                $resultado = $setencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $libros[] = new Libro($fila['id'], $fila['id_vendedor'], $fila['titulo'], $fila['autor'], $fila['editorial'], $fila['edicion'], $fila['img1'], $fila['img2'], $fila['img3'], $fila['year_publicacion'], $fila['isbn'], $fila['issn'], $fila['fecha_subida'], $fila['precio'], $fila['calidad'], $fila['activo']);
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $libros;
    }

    public static function eliminar_libro($conexion, $id)
    {
        if (isset($conexion)) {
            try {
                $sql = "DELETE FROM libros WHERE id = :id";
                $setencia = $conexion->prepare($sql);
                $setencia->bindParam(':id', $id, PDO::PARAM_STR);
                $setencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
    }
}