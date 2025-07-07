<?php

function obtener_servicios() {
    try {
        // importar credenciales
        require 'database.php';


        // consulta sql
        $sql = "SELECT * FROM servicios;";

        //realizar la consulta
        $consulta = mysqli_query($db, $sql);

        return $consulta;

        // acceder a los resultados

        //cerrar la conexion



    } catch (\Throwable $th) {
        //throw $th;
    }
}

obtener_servicios();