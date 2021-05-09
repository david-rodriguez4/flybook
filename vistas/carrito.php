<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/CompraVenta.inc.php';
include_once 'app/Libro.inc.php';
include_once 'app/RepositorioLibro.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioCompraVenta.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/EscritorLibros.inc.php';

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}

if (isset($_POST['subir'])) {
    if ($_POST['libropago'] == 0) {
        ?>
        <script type="text/javascript">
            alert("Selecciona un libro.");
        </script>
        <?php
    } else {
        Conexion:: abrir_conexion();
        $img_pago = $_FILES['comprobante']['name'];
        $ruta = $_FILES['comprobante']['tmp_name'];
        $imgExt = strtolower(pathinfo($img_pago, PATHINFO_EXTENSION));
        if (isset($img_pago) && !empty($img_pago)) {
            $pic = $_SESSION['id'] . "+" . "pago" . rand(1, 1000000) . "." . $imgExt;
            $target_file = "uploads/" . $pic;
        } else {
            $pic = null;
            $target_file = "";
        }
        $pagado = RepositorioCompraVenta::insertar_actualizar_pago(Conexion::getConexion(), $_POST['libropago'], $_POST['id_comprobante'], $pic, 1);
        if ($pagado) {

            move_uploaded_file($ruta, $target_file);
            $pago = RepositorioCompraVenta::obtener_compra_id(Conexion::getConexion(), $_POST['libropago']);
            $vendedor = RepositorioUsuario::getUsuarioId(Conexion::getConexion(), $pago->getIdVendedor());
            $comprador = RepositorioUsuario::getUsuarioId(Conexion::getConexion(), $pago->getIdComprador());
            $libro = RepositorioLibro::obtener_libro_por_id(Conexion::getConexion(), $pago->getIdLibro());
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->isHTML(true);
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = 'true';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->Username = 'no.reply.flybook@gmail.com';
            $mail->Password = 'MIllonarios1269';
            $mail->Subject = 'Compra de libro - Flybook - ' . $libro->getTitulo();
            $mail->setFrom('no.reply.flybook@gmail.com');
            $mail->CharSet = 'UTF-8';
            $message = "<html lang='es'><body>";
            $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
            $message .= "<tr><td>";
            $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
            $message .= "<thead>
                            <tr height='80'>
                                <td colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Flybook</td>
                            </tr>
                         </thead>";
            $message .= "<tbody>
                            <tr>
                                <td colspan='4' style='padding:15px;'>
                                    <p style='font-size:20px;'>Hola " . $vendedor->getNombre() . "</p>
                                    <hr />
                                    <p style='font-size:25px;'>Se ha registrado el pago del libro " . $libro->getTitulo() . " - " . $libro->getAutor() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>Te recordamos que realices el envío del pedido al cliente, los datos de la persona los encontrarás en la sección:</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>Mis publicaciones > Libro > Ver</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Nombre: </b>" . $comprador->getNombre() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Documento de identidad: </b>" . $comprador->getDocumento() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Correo electrónico: </b>" . $comprador->getEmail() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Teléfono: </b>" . $comprador->getTelefono() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Dirección: </b>" . $comprador->getDireccion() . "</p>
                                </td>
                            </tr>
                         </tbody>";
            $message .= "</table>";
            $message .= "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
            $mail->Body = $message;
            $mail->addAddress($vendedor->getEmail());
            $mail->send();
            $mail->smtpClose();

            $mail2 = new PHPMailer();
            $mail2->isSMTP();
            $mail2->isHTML(true);
            $mail2->Host = 'smtp.gmail.com';
            $mail2->SMTPAuth = 'true';
            $mail2->SMTPSecure = 'tls';
            $mail2->Port = '587';
            $mail2->Username = 'no.reply.flybook@gmail.com';
            $mail2->Password = 'MIllonarios1269';
            $mail2->Subject = 'Compra de libro - Flybook - ' . $pago->getId();
            $mail2->setFrom('no.reply.flybook@gmail.com');
            $mail2->CharSet = 'UTF-8';
            $message2 = "<html lang='es'><body>";
            $message2 .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
            $message2 .= "<tr><td>";
            $message2 .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
            $message2 .= "<thead>
                            <tr height='80'>
                                <td colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Flybook</td>
                            </tr>
                         </thead>";
            $message2 .= "<tbody>
                            <tr>
                                <td colspan='4' style='padding:15px;'>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Libro: </b>" . $libro->getId() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Comprador: </b>" . $_SESSION['id'] . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Vendedor: </b>" . $vendedor->getId() . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>ID Baloto: </b>" . $_POST['id_comprobante'] . "</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Comprobante: </b>" . RUTA_UPLOADS . $pic . "</p>
                                </td>
                            </tr>
                         </tbody>";
            $message2 .= "</table>";
            $message2 .= "</td></tr>";
            $message2 .= "</table>";
            $message2 .= "</body></html>";
            $mail2->Body = $message2;
            $mail2->addAddress('no.reply.flybook@gmail.com');
            $mail2->send();
            $mail2->smtpClose();
            ?>
            <script type="text/javascript">
                alert("Se realizó el pago.");
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Fallo en la compra.");
            </script>
            <?php
        }
    }

}


include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>
<div class="container is-max-desktop column is-half">
    <div class="notification is-warning is-light">
        <p>Una vez realices el pago vía Baloto al documento de identidad 1000331269 y número de teléfono 3508059644,
            deberás subir una foto del comprobante de pago. Recuerda que el precio del libro no incluye el costo de la
            transacción.</p>
        <p>Haz click <a onclick="show_table()">aquí</a> para ver los precios de transacción de Baloto.</p>
        <table id="tabla_precios" class="table is-narrow is-bordered">
            <thead>
            <tr class="trhead">
                <th>Límite</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
            <tr class="trbody">
                <td>Hasta $50.000</td>
                <td>$4.700</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $100.000</td>
                <td>$6.000</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $150.000</td>
                <td>$7.500</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $200.000</td>
                <td>$8.300</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $250.000</td>
                <td>$8.900</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $300.000</td>
                <td>$9.400</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $350.000</td>
                <td>$9.900</td>
            </tr>
            <tr class="trbody">
                <td>Hasta $400.000</td>
                <td>$10.400</td>
            </tr>
            </tbody>
        </table>
    </div>
    <form role="form" method="post" action="<?php echo RUTA_CARRITO ?>" enctype="multipart/form-data">
        <div class="panel">
            <p class="panel-heading">Información de pago</p>
            <div class="panel-block">
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="libropago">
                            <option value="0">Selecciona el libro a pagar...</option>
                            <?php EscritorLibros::libros_por_comprar() ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-block">
                <input class="input" type="tel" name="id_comprobante" id="id_comprobante"
                       placeholder="ID del recibo de pago" required>
            </div>
            <div class="panel-block">
                <div id="file" class="file has-name">
                    <label class="file-label">
                        <input class="file-input" type="file" name="comprobante" id="comprobante" accept="image/*"
                               required>
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fa fa-upload"></i>
                            </span>
                            <span class="file-label">Comprobante</span>
                        </span>
                        <span class="file-name">No hay archivos cargados</span>
                    </label>
                </div>
            </div>
            <div class="panel-block">
                <button type="submit" class="button is-light is-fullwidth" name="subir">Subir comprobante</button>
            </div>
    </form>
</div>
<script type="text/javascript">
    function show_table() {
        document.getElementById("tabla_precios").style.display = "table";
    }
</script>
<script>
    const fileInput = document.querySelector('#file input[type=file]');
    fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            const fileName = document.querySelector('#file .file-name');
            fileName.textContent = fileInput.files[0].name;
        }
    }
</script>