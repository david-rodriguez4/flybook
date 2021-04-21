<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/config.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}

include_once 'plantilla/documento-declaracion.inc.php';
include_once 'plantilla/navbar.inc.php';
?>

<figure class="zoom" style='background-image: url(//res.cloudinary.com/active-bridge/image/upload/slide1.jpg)' onmousemove='zoom(event)'>
    <img class="imgzoom" src="//res.cloudinary.com/active-bridge/image/upload/slide1.jpg">
</figure>

<script type="text/javascript">
    function zoom(e){
        var zoomer = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
        x = offsetX/zoomer.offsetWidth*100
        y = offsetY/zoomer.offsetHeight*100
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }
    document.addEventListener('dragstart', function(evt) {
        if (evt.target.tagName == 'IMG') {
            evt.preventDefault();
        }
    });
</script>
