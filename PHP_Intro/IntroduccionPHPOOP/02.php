<?php 

declare(strict_types = 1);

include 'includes/header.php';

// definir una clase
// Encapsular 
class Producto {
    
    public string $imagen; // Inicializar como string
    public static string $imagenPlaceholder = "imagen.jpg";
    
    public function __construct(
        protected string $nombre, 
        public float $precio, 
        public bool $disponible, 
        string $imagen = ''
    ) {
        // Asignar valor a la propiedad imagen de la instancia
        $this->imagen = $imagen ?: self::$imagenPlaceholder;
        
        // Si quieres cambiar el placeholder globalmente (no recomendado)
        // if($imagen) {
        //     self::$imagenPlaceholder = $imagen;
        // }
    }

    public function mostrarProducto(): void {
        echo "Nombre: {$this->nombre}, Precio: {$this->precio}, Disponible: " . 
             ($this->disponible ? 'Sí' : 'No') . 
             ", Imagen: {$this->imagen}" . PHP_EOL;
    }

    public function obtenerImagen(): string {
        return $this->imagen; // Retornar la imagen de esta instancia
    }

    public static function obtenerImagenPlaceholder(): string {
        return self::$imagenPlaceholder;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }
}
$producto = new Producto('Tablet', 200, true);



// setter para cambiar el nombre

// mostrar el producto con el nuevo nombre
$producto->mostrarProducto();
$producto->obtenerImagen();




echo '<pre>';
var_dump($producto);
echo '</pre>';

$producto2 = new Producto('Television', 300, false, 'tv.jpg');
$producto2->obtenerImagen();
echo '<pre>';
var_dump($producto2);
echo '</pre>';

include 'includes/footer.php';