/*!
 * Archivo: scripts1.js
 * Descripción: Manipulación del DOM, gestión de formularios y manejo de eventos
 * Autor: Stifh Claude Assistant refactoring 
 * Fecha: 2025-06-27
 * Versión: 1.0
 */

'use strict';

// ============================================
// CONSTANTES Y CONFIGURACIÓN
// ============================================

const SELECTORS = {
    HEADER_TEXT: '.header__texto h2',
    NAV_LINKS: '.navegacion a',
    NAV_CONTAINER: '.navegacion',
    FORM_SUBMIT: '.formulario input[type="submit"]',
    INPUT_NOMBRE: '#nombre',
    INPUT_EMAIL: '#email',
    INPUT_MENSAJE: '#mensaje',
    HEADING_ID: 'heading',
    NAV_LINK_CLASS: 'navegacion__enlace'
};

const CSS_CLASSES = {
    NEW_CLASS: 'nueva-clase',
    NAV_LINK: 'navegacion__enlace'
};

const URLS = {
    GOOGLE: 'google.com',
    NEW_LINK: 'nuevo-enlace.html'
};

const TEXT_CONTENT = {
    NEW_LINK_TEXT: 'Nuevo Texto enlace',
    CREATED_LINK_TEXT: 'Nuevo Enlace'
};

// ============================================
// VARIABLES GLOBALES
// ============================================

/**
 * Objeto para almacenar los datos del formulario de contacto
 * @type {Object}
 */
const datos = {
    nombre: '',
    email: '',
    mensaje: ''
};

// ============================================
// SELECCIÓN DE ELEMENTOS DOM
// ============================================

// Selecciones con querySelector
const heading = document.querySelector(SELECTORS.HEADER_TEXT); 
const navegacion = document.querySelector(SELECTORS.NAV_CONTAINER);
const btnEnviar = document.querySelector(SELECTORS.FORM_SUBMIT);
const nombre = document.querySelector(SELECTORS.INPUT_NOMBRE);
const email = document.querySelector(SELECTORS.INPUT_EMAIL);
const mensaje = document.querySelector(SELECTORS.INPUT_MENSAJE);

// Selecciones con querySelectorAll
const enlaces = document.querySelectorAll(SELECTORS.NAV_LINKS); // .navegacion a es un selector de CSS

// Selecciones con getElementById
const heading2 = document.getElementById('heading');

// Selecciones con getElementsByClassName
const enlaces2 = document.getElementsByClassName(SELECTORS.NAV_LINK_CLASS);

// ============================================
// FUNCIONES UTILITARIAS
// ============================================

/**
 * Lee el texto ingresado en los campos del formulario y actualiza el objeto datos
 * @param {Event} e - Evento del input
 */
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

/**
 * Maneja el evento click del botón enviar
 * @param {Event} e - Evento del click
 */
function handleSubmitClick(e) {
    console.log(e); // Evento
    e.preventDefault(); // Prevenir el comportamiento por defecto del evento
}

/**
 * Función que se ejecuta cuando el DOM está completamente cargado
 */
function handleDOMContentLoaded() {
    console.log('4'); // Este se ejecuta cuando el HTML ha sido descargado pero no espera por CSS o imagenes...
}

// ============================================
// MANIPULACIÓN DEL DOM
// ============================================

/**
 * Realiza las operaciones iniciales de manipulación del DOM
 */
function performInitialDOMManipulation() {
    // Logs iniciales
    console.log(heading);
    console.log(enlaces);
    console.log(heading2);
    console.log(enlaces2);

    // Acceder a cada enlace por su index
    console.log(enlaces[0]);
    console.log(enlaces[1]);
    console.log(enlaces[2]);
    console.log(enlaces[3]);

    // Cambiar el texto de cada enlace
    enlaces[0].textContent = TEXT_CONTENT.NEW_LINK_TEXT;
    enlaces[1].textContent = TEXT_CONTENT.NEW_LINK_TEXT;
    enlaces[2].textContent = TEXT_CONTENT.NEW_LINK_TEXT;
    enlaces[3].textContent = TEXT_CONTENT.NEW_LINK_TEXT;

    // Cambiar el enlace del primer enlace
    enlaces[0].href = URLS.GOOGLE;

    // Agregar una clase...
    enlaces[0].classList.add(CSS_CLASSES.NEW_CLASS);

    // Eliminar una clase...
    enlaces[0].classList.remove(CSS_CLASSES.NAV_LINK);
}

// ============================================
// CREACIÓN Y MANIPULACIÓN DE ELEMENTOS
// ============================================

/**
 * Crea y manipula elementos dinámicos en el DOM
 */
function createAndManipulateElements() {
    // Generar HTML desde Javascript create element operaciones
    const nuevoEnlace = document.createElement('A');
    console.log(nuevoEnlace);

    // Agregar el href
    nuevoEnlace.href = URLS.NEW_LINK;

    // Agregar el texto
    nuevoEnlace.textContent = TEXT_CONTENT.CREATED_LINK_TEXT;

    // Agregar la clase
    nuevoEnlace.classList.add(CSS_CLASSES.NAV_LINK);

    // Agregarlo al DOM
    navegacion.appendChild(nuevoEnlace);

    // Clones
    const nuevoEnlace2 = nuevoEnlace.cloneNode(true);
    console.log(nuevoEnlace2);

    // Reemplazar el enlace
    navegacion.replaceChild(nuevoEnlace2, nuevoEnlace); // Reemplazamos el nuevoEnlace por el nuevoEnlace2

    // Eliminar el enlace
    navegacion.removeChild(nuevoEnlace2);
}

// ============================================
// CONFIGURACIÓN DE EVENT LISTENERS
// ============================================

/**
 * Configura todos los event listeners necesarios
 */
function setupEventListeners() {
    // Evento click en botón enviar
    btnEnviar.addEventListener('click', handleSubmitClick);

    // Eventos input en campos del formulario
    nombre.addEventListener('input', leerTexto);
    email.addEventListener('input', leerTexto);
    mensaje.addEventListener('input', leerTexto);
}

// ============================================
// INICIALIZACIÓN
// ============================================

/**
 * Función principal de inicialización
 * Ejecuta todas las operaciones necesarias al cargar la página
 */
function init() {
    performInitialDOMManipulation();
    createAndManipulateElements();
    setupEventListeners();
    handleDOMContentLoaded();
}

// Ejecutar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', init);