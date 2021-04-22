<div class="panel-block">
    <input class="input" placeholder="Título" type="text" name="titulo" id="titulo">
</div>
<div class="panel-block">
    <input class="input" type="text" name="autor" id="autor" placeholder="Autor">
</div>
<div class="panel-block">
    <input class="input" type="text" name="editorial" id="editorial" placeholder="Editorial">
</div>
<div class="panel-block">
    <input class="input" type="text" name="edicion" id="edicion" placeholder="Edición">
</div>
<div class="panel-block">
    <input class="input" type="number" name="fecha_publicacion" id="fecha_publicacion" placeholder="Año de publicación"">
</div>
<div class="panel-block">
    <input class="input" type="text" name="isbn" id="isbn" placeholder="Identificador ISBN">
</div>
<div class="panel-block">
    <input class="input" type="text" name="issn" id="issn" placeholder="Identificador ISSN">
</div>
<div class="panel-block">
    <input class="input" type="number" name="precio" id="precio" placeholder="Precio del libro">
</div>
<div class="panel-block">
    <input class="input" type="number" name="calidad" id="calidad" placeholder="Estado físico del libro">
</div>
<div class="panel-block">
    <div id="file1" class="file has-name">
        <label class="file-label">
            <input class="file-input" type="file" name="img1" id="img1" accept="image/*">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fa fa-upload"></i>
                </span>
                <span class="file-label">
                    Portada
                </span>
            </span>
            <span class="file-name">
                No hay archivos cargados
            </span>
        </label>
    </div>
</div>
<div class="panel-block">
    <div id="file2" class="file has-name">
        <label class="file-label">
            <input class="file-input" type="file" name="img2" id="img2" accept="image/*">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fa fa-upload"></i>
                </span>
                <span class="file-label">
                    Hojas
                </span>
            </span>
            <span class="file-name">
                No hay archivos cargados
            </span>
        </label>
    </div>
</div>
<div class="panel-block">
    <div id="file3" class="file has-name">
        <label class="file-label">
            <input class="file-input" type="file" name="img3" id="img3" accept="image/*">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fa fa-upload"></i>
                </span>
                <span class="file-label">
                    Lomo
                </span>
            </span>
            <span class="file-name">
                No hay archivos cargados
            </span>
        </label>
    </div>
</div>
<div class="panel-block">
    <button type="submit" class="button is-light is-fullwidth" name="publicar">Publicar</button>
</div>
<script>
    const fileInput1 = document.querySelector('#file1 input[type=file]');
    const fileInput2 = document.querySelector('#file2 input[type=file]');
    const fileInput3 = document.querySelector('#file3 input[type=file]');
    fileInput1.onchange = () => {
        if (fileInput1.files.length > 0) {
            const fileName = document.querySelector('#file1 .file-name');
            fileName.textContent = fileInput1.files[0].name;
        }
    }
    fileInput2.onchange = () => {
        if (fileInput2.files.length > 0) {
            const fileName = document.querySelector('#file2 .file-name');
            fileName.textContent = fileInput2.files[0].name;
        }
    }
    fileInput3.onchange = () => {
        if (fileInput3.files.length > 0) {
            const fileName = document.querySelector('#file3 .file-name');
            fileName.textContent = fileInput3.files[0].name;
        }
    }
</script>