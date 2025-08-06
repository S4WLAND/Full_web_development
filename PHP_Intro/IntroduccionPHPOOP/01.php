<?php 

declare(strict_types = 1);

include 'includes/header.php';

// definir una clase

class Producto {

    // propiedades o atributos
    public $nombre;
    public $precio;
    public $disponible;

    // constructores
    public function __construct(string $nombre, float $precio, bool $disponible) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->disponible = $disponible;

    }


}

$producto = new Producto('Tablet', 200, true);

echo '<pre>';
var_dump($producto);
echo '</pre>';

$producto2 = new Producto('Television', 300, false);

echo '<pre>';
var_dump($producto2);
echo '</pre>';

include 'includes/footer.php';