<?php include 'includes/header.php';


// El flujo interno es:
/*
1. $car->getInfo() 
   ↓
2. Se ejecuta Transport::getInfo() porque Car no lo sobrescribe
   ↓
3. Dentro de Transport::getInfo():
   - $info = $this->getTransportInfo()  // "The transport has 4 wheels..."
   - $additional = $this->getAdditionalInfo()  // ← AQUÍ es donde busca en Car
   ↓
4. PHP encuentra Car::getAdditionalInfo() y la ejecuta
   - return "It has a manual transmission."
   ↓
5. Vuelve a Transport::getInfo() con $additional = "It has a manual transmission."
   ↓
6. Resultado final: "The transport has 4 wheels and 5 capacity. It has a manual transmission.<br>"
*/

class Transport {
    public function __construct(protected int $wheels, protected int $capacity) {
    }

    protected function getTransportInfo(): string {
        return "The transport has {$this->wheels} wheels and {$this->capacity} capacity.";
    }
    
    protected function getAdditionalInfo(): string {
        return ""; // Por defecto vacío
    }

    public function getInfo(): string {
        $info = $this->getTransportInfo();
        $additional = $this->getAdditionalInfo();
        
        if ($additional) {
            $info .= " " . $additional;
        }
        
        return $info . "<br>";
    }
}

class Bicycle extends Transport {
    public function __construct() {
        parent::__construct(2, 1);
    }
}

class Car extends Transport {
    private string $transmission;
    
    public function __construct(string $transmission) {
        $this->transmission = $transmission;
        parent::__construct(4, 5);
    }

    protected function getAdditionalInfo(): string {
        return "It has a {$this->transmission} transmission.";
    }
}

$bicycle = new Bicycle();
echo $bicycle->getInfo();

$car = new Car('automatic');
echo $car->getInfo();

include 'includes/footer.php';