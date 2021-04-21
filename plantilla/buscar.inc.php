<div class="panel">
    <p class="panel-heading">
        Busqueda y filtrado
    </p>
    <form role="form" method="post" action="<?php echo RUTA_BUSCAR ?>">
        <div class="panel-block">
            <p class="control has-icons-left">
                <input class="input" type="search" name="busqueda" required placeholder="¿Qué libro buscas?">
                <span class="icon is-left">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
            </p>
            <button class="button is-light" type="submit" name="buscar">Buscar</button>
        </div>
    </form>
    <div class="panel-block">
        <p>Filtrado</p>
    </div>
</div>