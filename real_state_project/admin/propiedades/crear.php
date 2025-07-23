<?php

//Conexion to database

require '../../includes/config/database.php';
$db = conectarDB();

// arreglo de errores
$errores = [];

// Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo"<pre>";
    // var_dump($_POST['propiedad']);
    // echo "</pre>";

    $titulo = $_POST["propiedad"]["titulo"];
    $precio = $_POST["propiedad"]["precio"];
    $descripcion = $_POST["propiedad"]["descripcion"];
    $habitaciones = $_POST["propiedad"]["habitaciones"];
    $wc = $_POST["propiedad"]["wc"];
    $estacionamiento = $_POST["propiedad"]["estacionamiento"];
    $vendedor_id = $_POST["propiedad"]["vendedor"];


    if (!$titulo) {
        $errores[] = "El título es obligatorio";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es obligatoria";
    }

    if (!$habitaciones) {
        $errores[] = 'El número de habitaciones es obligatorio';
    }

    if (!$wc) {
        $errores[] = 'El número de baños es obligatorio';
        
    }

    if (!$estacionamiento) {
        $errores[] = 'El número de estacionamientos es obligatorio';   
    }

    if (!$vendedor_id) {
        $errores[] = 'Elige un vendedor';
    }

    // echo'<pre>';
    // var_dump($errores);
    // echo '</pre>';

    // revisar que el array de errores este vacio
    if (empty($errores)) {

        //insert into database
        $query = "INSERT INTO propiedades (
            titulo, 
            precio, 
            descripcion, 
            habitaciones, 
            wc, 
            estacionamiento, 
            vendedores_id
        ) VALUES (
            '$titulo', 
            '$precio', 
            '$descripcion', 
            '$habitaciones', 
            '$wc', 
            '$estacionamiento', 
            '$vendedor_id'
        )";

        // echo $query;
        $resultado = mysqli_query($db, $query);
        if ($resultado){
            echo "Insertado Correctamente";
        }

    }


}



require '../../includes/funciones.php';
incluir_template('header'); 
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

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

                <select name="propiedad[vendedor]" >
                    <option value="1">Stifh</option>
                    <option value="2">Pedro</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">



        </form>
    </main>

<?php
    incluir_template('footer'); 
?>

