document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    function aplicarDarkMode(activar) {
        if (activar) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    }
    
    // Inicializar dark mode con preferencias guardadas
    function inicializarDarkMode() {
        const darkModeGuardado = localStorage.getItem('darkMode');
        
        if (darkModeGuardado === 'enabled') {
            aplicarDarkMode(true);
        } else if (darkModeGuardado === 'disabled') {
            aplicarDarkMode(false);
        } else {
            // Sin preferencia manual, usar sistema
            aplicarDarkMode(prefiereDarkMode.matches);
        }
    }
    
    inicializarDarkMode();
    
    // Solo seguir sistema si no hay preferencia manual
    prefiereDarkMode.addEventListener('change', function() {
        const darkModeGuardado = localStorage.getItem('darkMode');
        
        if (darkModeGuardado === null) {
            aplicarDarkMode(prefiereDarkMode.matches);
        }
    });

    // Botón toggle con persistencia
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    
    if (botonDarkMode) {
        botonDarkMode.addEventListener('click', function() {
            const isDarkMode = document.body.classList.contains('dark-mode');
            
            if (isDarkMode) {
                aplicarDarkMode(false);
                localStorage.setItem('darkMode', 'disabled');
            } else {
                aplicarDarkMode(true);
                localStorage.setItem('darkMode', 'enabled');
            }
        });
    }
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenu) {
        mobileMenu.addEventListener('click', navegacionResponsive);
    }
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    
    if (navegacion) {
        navegacion.classList.toggle('mostrar');
    }
}
