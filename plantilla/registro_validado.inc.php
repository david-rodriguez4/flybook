<div class="panel-block">
    <input type="text" class="input" name="nombre" placeholder="Nombres">
</div>
<?php
$validador->mostrarErrorNombre();
?>
<div class="panel-block">
    <input type="text" class="input" name="apellido" placeholder="Apellidos">
</div>
<?php
$validador->mostrarErrorApellido();
?>
<div class="panel-block">
    <input type="text" class="input" name="docid" placeholder="Documento de identidad">
</div>
<?php
$validador->mostrarErrorDocid();
?>
<div class="panel-block">
    <input type="email" class="input" name="email" placeholder="Correo electrónico">
</div>
<?php
$validador->mostrarErrorEmail();
?>
<div class="panel-block">
    <input type="password" class="input" name="clave1" id="clave1" placeholder="Contraseña">
    <button id="show_password" class="button is-light shbtn1" type="button" onclick="mostrarPassword1()">
        <i class="fa fa-eye-slash icon 1"></i>
    </button>
</div>
<?php
$validador->mostrarErrorClave1();
?>
<div class="panel-block">
    <input type="password" class="input" name="clave2" id="clave2" placeholder="Confirmar contraseña">
    <button id="show_password" class="button is-light shbtn2" type="button" onclick="mostrarPassword2()">
        <i class="fa fa-eye-slash icon 2"></i>
    </button>
</div>
<?php
$validador->mostrarErrorClave2();
?>
<div class="panel-block">
    <input type="text" class="input" name="nacimiento" value="" max="2011-01-01" min="1900-01-01"
           placeholder="Fecha de nacimiento" onfocus="(this.type='date')">
</div>
<?php
$validador->mostrarErrorFN();
?>
<div class="panel-block">
    <label>¿Cómo deseas registrarte?</label>
    <div class="panel-list">
        <div class="column">
            <label class="radio">
                <input type="radio" name="estado" value="0" checked>
                Comprador
            </label>
        </div>
        <div class="column">
            <label class="radio">
                <input type="radio" name="estado" value="1">
                Vendedor
            </label>
        </div>
    </div>
</div>
<?php
$validador->mostrarErrorEstado();
?>
<div class="panel-block">
    <button type="submit" class="button is-light is-fullwidth" name="enviar">Enviar</button>
</div>