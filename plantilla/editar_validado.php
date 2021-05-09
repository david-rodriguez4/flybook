<div class="panel-block">
    <input class="input" placeholder="Título" type="text" name="titulo" id="titulo">
</div>
<?php
$validador->mostrarErrorTitulo();
?>
<div class="panel-block">
    <input class="input" type="text" name="autor" id="autor" placeholder="Autor">
</div>
<?php
$validador->mostrarErrorAutor();
?>
<div class="panel-block">
    <input class="input" type="text" name="editorial" id="editorial" placeholder="Editorial">
</div>
<div class="panel-block">
    <input class="input" type="text" name="edicion" id="edicion" placeholder="Edición">
</div>
<div class="panel-block">
    <input class="input" type="number" name="fecha_publicacion" id="fecha_publicacion" placeholder="Año de publicación">
</div>
<?php
$validador->mostrarErrorFP();
?>
<div class="panel-block">
    <input class="input" type="text" name="isbn" id="isbn" placeholder="Identificador ISBN">
</div>
<div class="panel-block">
    <input class="input" type="text" name="issn" id="issn" placeholder="Identificador ISSN">
</div>
<div class="panel-block">
    <input class="input" type="number" name="precio" id="precio" placeholder="Precio del libro">
</div>
<?php
$validador->mostrarErrorPrecio();
?>
<div class="panel-block">
    <input class="input" type="number" name="calidad" id="calidad" placeholder="Estado físico del libro (1 - 100)">
</div>
<?php
$validador->mostrarErrorCalidad();
?>
<div class="panel-block">
    <button type="submit" class="button is-light is-fullwidth" name="editar">Editar</button>
</div>