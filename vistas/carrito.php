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

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}

if (isset($_POST['pagar'])) {
    if ($_POST['libropago'] == 0){
        ?>
        <script type="text/javascript">
            alert("Fallo en la compra.");
        </script>
        <?php
    } else {
        Conexion:: abrir_conexion();
        $pagado = RepositorioCompraVenta::actualizar_estado_pago(Conexion::getConexion(), $_POST['libropago']);
        if ($pagado) {
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
    <form role="form" method="post" action="">
        <div class="panel">
            <p class="panel-heading">Información de pago</p>
            <div class="panel-block">
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="libropago">
                            <option value="0">Selecciona el libro a pagar...</option>
                            <?php echo EscritorLibros::libros_por_comprar() ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-block">
                <input class="input" type="text" name="nombre" placeholder="Nombre completo" required>
            </div>
            <div class="panel-block">
                <input type="tel" class="input" data-format="**** **** **** ****" data-mask="#### #### #### ####" placeholder="####-####-#### ####" required>
            </div>
            <div class="panel-block">
                <input type="tel" class="input" data-format="**-****" data-mask="MM-YYYY" required>
            </div>
            <div class="panel-block">
                <input type="tel" class="input" data-format="***" data-mask="CVC" required>
            </div>
            <div class="panel-block">
                <button type="submit" class="button is-light is-fullwidth" name="pagar">Pagar</button>
            </div>
    </form>
</div>
<script type="text/javascript">
    function doFormat(x, pattern, mask) {
        var strippedValue = x.replace(/[^0-9]/g, "");
        var chars = strippedValue.split('');
        var count = 0;

        var formatted = '';
        for (var i = 0; i < pattern.length; i++) {
            const c = pattern[i];
            if (chars[count]) {
                if (/\*/.test(c)) {
                    formatted += chars[count];
                    count++;
                } else {
                    formatted += c;
                }
            } else if (mask) {
                if (mask.split('')[i])
                    formatted += mask.split('')[i];
            }
        }
        return formatted;
    }

    document.querySelectorAll('[data-mask]').forEach(function (e) {
        function format(elem) {
            const val = doFormat(elem.value, elem.getAttribute('data-format'));
            elem.value = doFormat(elem.value, elem.getAttribute('data-format'), elem.getAttribute('data-mask'));

            if (elem.createTextRange) {
                var range = elem.createTextRange();
                range.move('character', val.length);
                range.select();
            } else if (elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(val.length, val.length);
            }
        }

        e.addEventListener('keyup', function () {
            format(e);
        });
        format(e)
    });
</script>