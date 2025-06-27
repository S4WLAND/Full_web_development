const heading = document.querySelector('.header__texto h2'); 
console.log(heading);

// querySelectorAll
const enlaces = document.querySelectorAll('.navegacion a'); // .navegacion a es un selector de CSS
console.log(enlaces);

// acceder a cada uno de ellos por su index
console.log(enlaces[0]);
console.log(enlaces[1]);
console.log(enlaces[2]);
console.log(enlaces[3]);

// Cambiar el texto de cada enlace
enlaces[0].textContent = 'Nuevo Texto enlace';
enlaces[1].textContent = 'Nuevo Texto enlace';
enlaces[2].textContent = 'Nuevo Texto enlace';
enlaces[3].textContent = 'Nuevo Texto enlace';

// Cambiar el enlace del primer enlace
enlaces[0].href = 'google.com';

// Agregar una clase...
enlaces[0].classList.add('nueva-clase');

// Eliminar una clase...
enlaces[0].classList.remove('navegacion__enlace');

// getElementById
const heading2 = document.getElementById('heading');
console.log(heading2);

// getElementByClassName
const enlaces2 = document.getElementsByClassName('navegacion__enlace');
console.log(enlaces2);

// algunas operaciones extras ...

// Generar HTML desde Javascript create element operaciones

const nuevoEnlace = document.createElement('A');
console.log(nuevoEnlace);

// Agregar el href
nuevoEnlace.href = 'nuevo-enlace.html';

// Agregar el texto
nuevoEnlace.textContent = 'Nuevo Enlace';

// Agregar la clase
nuevoEnlace.classList.add('navegacion__enlace');

// Agregarlo al DOM
const navegacion = document.querySelector('.navegacion');
navegacion.appendChild(nuevoEnlace);

// Clones
const nuevoEnlace2 = nuevoEnlace.cloneNode(true);
console.log(nuevoEnlace2);

// Reemplazar el enlace
navegacion.replaceChild(nuevoEnlace2, nuevoEnlace); // Reemplazamos el nuevoEnlace por el nuevoEnlace2

// Eliminar el enlace
navegacion.removeChild(nuevoEnlace2);

// Eventos
const btnEnviar = document.querySelector('.formulario input[type="submit"]');
console.log(btnEnviar);

btnEnviar.addEventListener('click', function() { // callback o closure 
    console.log(e); // Evento
    e.preventDefault(); // Prevenir el comportamiento por defecto del evento

});

// DomContentLoaded
document.addEventListener('DOMContentLoaded', function() { // Este se ejecuta cuando el HTML ha sido descargado pero no espera por CSS o imagenes...
    console.log('4');
});

// 

const datos = {
    nombre: '',
    email: '',
    mensaje: ''
};

const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const mensaje = document.querySelector('#mensaje');


nombre.addEventListener('input', leerTexto);
email.addEventListener('input', leerTexto);
mensaje.addEventListener('input', leerTexto);

function leerTexto(e) {

    // console.log(e);
    // console.log(e.target.value);


    datos[e.target.id] = e.target.value;
    /*
    .id -> id de la etiqueta - <input id="nombre">
    .value -> valor de la etiqueta - <textarea>
    Notación de punto - objeto.propiedad = valor;
    Notación de corchetes - objeto[clave] = valor;
    */
    console.log(datos);

}

