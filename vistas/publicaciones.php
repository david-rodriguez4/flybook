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
    if ($_POST['libroenvio'] == 0) {
        ?>
        <script type="text/javascript">
            alert("Selecciona un libro.");
        </script>
        <?php
    } else {
        Conexion:: abrir_conexion();
        $img_envio = $_FILES['comprobante']['name'];
        $ruta = $_FILES['comprobante']['tmp_name'];
        $imgExt = strtolower(pathinfo($img_envio, PATHINFO_EXTENSION));
        if (isset($img_envio) && !empty($img_envio)) {
            $pic = $_SESSION['id'] . "+" . "envio" . rand(1, 1000000) . "." . $imgExt;
            $target_file = "uploads/" . $pic;
        } else {
            $pic = null;
            $target_file = "";
        }
        $enviado = RepositorioCompraVenta::insertar_actualizar_envio(Conexion::getConexion(), $_POST['libroenvio'], $pic, 2);

        if ($enviado) {
            move_uploaded_file($ruta, $target_file);
            $envio = RepositorioCompraVenta::obtener_compra_id(Conexion::getConexion(), $_POST['libroenvio']);
            $comprador = RepositorioUsuario::getUsuarioId(Conexion::getConexion(), $envio->getIdComprador());
            $vendedor = RepositorioUsuario::getUsuarioId(Conexion::getConexion(), $envio->getIdVendedor());
            $libro = RepositorioLibro::obtener_libro_por_id(Conexion::getConexion(), $envio->getIdLibro());
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->isHTML(true);
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = 'true';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->Username = 'davaymeme@gmail.com';
            $mail->Password = 'MIllonarios123';
            $mail->Subject = 'Envío de libro - Flybook - ' . $libro->getTitulo();
            $mail->setFrom('davaymeme@gmail.com');
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
                                    <p style='font-size:20px;'>Hola " . $comprador->getNombre() . "</p>
                                    <hr />
                                    <p style='font-size:25px;'>El libro " . $libro->getTitulo() . " - " . $libro->getAutor() . " ya está en camino</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>Te recomendamos ponerte en contacto con el vendedor si surge algún imprevisto en el envío del libro.</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Nombre: </b>" . $vendedor->getNombre() ."</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Documento de identidad: </b>" . $vendedor->getDocumento() ."</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Correo electrónico: </b>" . $vendedor->getEmail() ."</p>
                                    <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'><b>Teléfono: </b>" . $vendedor->getTelefono() ."</p>
                                </td>
                            </tr>
                         </tbody>";
            $message .= "</table>";
            $message .= "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";
            $mail->Body = $message;
            $mail->addAddress($comprador->getEmail());
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
            $mail2->Subject = 'Envío de libro - Flybook - ' . $envio->getId();
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
                alert("Se realizó el envío.");
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
<br>
<div class="container is-max-desktop">
    <div class="notification is-warning is-light">
        <p>Recuerda que a los libros que tienen el estado de "pagado" debes realizar el envío.</p>
        <p>Para esto debes dar click en "Ver" para visualizar los datos de contacto del comprador para conocer la dirección a la cual se debe realizar el envío.</p>
        <p>En el lapzo de un día después de realizar el envío podrás retirar el dinero en Baloto con tu documento de identidad, número de teléfono y un PIN de 6 dígitos que te enviaremos por correo electrónico.</p>
    </div>
    <h1 class="title">Mis publicaciones</h1>
    <table class="table is-narrow is-bordered">
        <thead>
        <tr class="trhead">
            <th>Título</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Gestionar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        EscritorLibros::escribir_mis_publicaciones();
        ?>
        </tbody>
    </table>
    <br>
    <h1 class="title">Pendientes</h1>
    <form role="form" method="post" action="<?php echo RUTA_PUBLICACIONES ?>" enctype="multipart/form-data">
        <div class="panel">
            <p class="panel-heading">Comprobante de envío</p>
            <div class="panel-block">
                <div class="control">
                    <div class="select is-fullwidth">
                        <select id="libroenvio" name="libroenvio">
                            <option value="0">Selecciona el libro enviado...</option>
                            <?php EscritorLibros::libros_por_enviar() ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-block">
                <div id="file" class="file has-name">
                    <label class="file-label">
                        <input class="file-input" type="file" name="comprobante" id="comprobante" accept="image/*" required>
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
    <script>
        const fileInput = document.querySelector('#file input[type=file]');
        fileInput.onchange = () => {
            if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file .file-name');
                fileName.textContent = fileInput.files[0].name;
            }
        }
    </script>
</div>
<br>
