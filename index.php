<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/RepositorioUsuario.inc.php';

$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url['path'];
$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = "vistas/404.php";

if ($partes_ruta[0] == 'flybook') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = "vistas/home.php";
    } elseif (count($partes_ruta) == 2) {
        switch ($partes_ruta[1]) {
            case 'login';
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'logout';
                $ruta_elegida = 'vistas/logout.php';
                break;
            case 'registro';
                $ruta_elegida = 'vistas/registro.php';
                break;
            case 'publicar';
                $ruta_elegida = 'vistas/publicar.php';
                break;
            case 'publicaciones';
                $ruta_elegida = 'vistas/publicaciones.php';
                break;
            case 'buscar';
                $ruta_elegida = 'vistas/buscar.php';
                break;
            case 'compras';
                $ruta_elegida = 'vistas/compras.php';
                break;
            case 'editar';
                $ruta_elegida = 'vistas/editar.php';
                break;
            case 'carrito';
                $ruta_elegida = 'vistas/carrito.php';
                break;
        }
    } elseif (count($partes_ruta) == 3) {
        if ($partes_ruta[1] == 'registro-correcto') {
            $nombre = $partes_ruta[2];
            $ruta_elegida = 'vistas/registro-correcto.php';
        }
        if ($partes_ruta[1] == 'libro') {
            $url = $partes_ruta[2];
            Conexion::abrir_conexion();
            $libro = RepositorioLibro::obtener_libro_por_id(Conexion::getConexion(), $url);
            if ($libro != null) {
                $vendedor = RepositorioUsuario::getUsuarioId(Conexion::getConexion(), $libro->getIdVendedor());
                $ruta_elegida = 'vistas/libro.php';
            }
        }
    }
}


include_once $ruta_elegida;