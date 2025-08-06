<?php 

declare(strict_types = 1);

include 'includes/header.php';

// definir una clase
// Encapsular 
class Producto {

    // propiedades o atributos
    // constructores
    /**
     * Modificadores de acceso:
     * public: Acceso desde cualquier parte del código.
     * protected: Acceso solo desde la clase misma y sus subclases.
     * private: Acceso solo desde la clase misma.
     */
    public function __construct(protected string $nombre, public float $precio, public bool $disponible) {
    }

    // metodos
    public function mostrarProducto(): void {
        echo "Nombre: {$this->nombre}, Precio: {$this->precio}, Disponible: " . ($this->disponible ? 'Sí' : 'No') . PHP_EOL;
    }

    // Getter para el nombre
    public function getNombre(): string {
        return $this->nombre;
    }

    // Setter para el nombre
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

}

$producto = new Producto('Tablet', 200, true);

// setter para cambiar el nombre
$producto->setNombre('Tablet Samsung');
// mostrar el producto con el nuevo nombre
$producto->mostrarProducto();




echo '<pre>';
var_dump($producto);
echo '</pre>';

$producto2 = new Producto('Television', 300, false);

echo '<pre>';
var_dump($producto2);
echo '</pre>';

include 'includes/footer.php';