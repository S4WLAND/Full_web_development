async function obtenerEmpleados() {

    const archivo = 'empleados.json';

    fetch(archivo)
        .then( resultado => resultado.json())
        .then( datos => {
            // console.log(datos.empleados);

            const {empleados} = datos;
           console.log(empleados);

            empleados.forEach(empleado => {
                const {id, nombre, puesto} = empleado;
                console.log(id, nombre, puesto);
            });
        });

    const resultado = await fetch(archivo);
    const datos = await resultado.json();
    console.log(datos);
}
obtenerEmpleados();