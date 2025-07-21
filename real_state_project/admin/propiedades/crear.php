<?php


require '../../includes/funciones.php';
incluir_template('header'); 
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="propiedad[descripcion]"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedor">Vendedor</label>
                <input type="text" id="vendedor" name="propiedad[vendedor]" placeholder="Nombre Vendedor">
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">



        </form>
    </main>

<?php
    incluir_template('footer'); 
?>

