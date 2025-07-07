<?php

function obtener_servicios() {
    try {
        // importar credenciales
        require 'database.php';


        // consulta sql
        $sql = "SELECT * FROM servicios;";

        //realizar la consulta
        $consulta = mysqli_query($db, $sql);

        // acceder a los resultados
        echo "<pre>";
        var_dump(mysqli_fetch_assoc($consulta));
        echo "</pre>";

        //cerrar la conexion
        $resultado = mysqli_close($db);
        echo $resultado;



    } catch (\Throwable $th) {
        //throw $th;
    }
}

obtener_servicios();