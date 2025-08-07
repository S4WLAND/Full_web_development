<?php include 'includes/header.php';

interface TransportInterface {
    public function getInfo(): string;
    public function getWheels(): int;
}

class Transport implements TransportInterface {
    public function __construct(protected int $wheels, protected int $capacity) {
    }

    protected function getTransportInfo(): string {
        return "The transport has {$this->wheels} wheels and {$this->capacity} capacity.";
    }

    public function getWheels(): int {
        return $this->wheels;
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

class Car  extends Transport implements TransportInterface {

    public string $transmission;

    public function __construct(int $wheels, int $capacity, string $transmission) {
        parent::__construct($wheels, $capacity);
        $this->transmission = $transmission;
    }

    protected function getAdditionalInfo(): string {
        return "It is a car with {$this->transmission} transmission.";
    }

    public function getWheels(): int {
        return parent::getWheels();
    }
}

$car = new Car(4, 5, "automatic");
echo $car->getInfo();

include 'includes/footer.php';