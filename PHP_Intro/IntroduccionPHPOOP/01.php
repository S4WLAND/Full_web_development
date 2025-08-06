<?php 

declare(strict_types = 1);

include 'includes/header.php';

// definir una clase

class Producto {

    // propiedades o atributos
    // constructores
    public function __construct(public string $nombre, public float $precio, public bool $disponible) {
    }

    // metodos
    public function mostrarProducto(): void {
        echo "Nombre: {$this->nombre}, Precio: {$this->precio}, Disponible: " . ($this->disponible ? 'Sí' : 'No') . PHP_EOL;
    }

}

$producto = new Producto('Tablet', 200, true);

$producto->mostrarProducto();

echo '<pre>';
var_dump($producto);
echo '</pre>';

$producto2 = new Producto('Television', 300, false);

echo '<pre>';
var_dump($producto2);
echo '</pre>';

include 'includes/footer.php';