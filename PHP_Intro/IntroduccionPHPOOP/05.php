<?php include 'includes/header.php';


interface TransportInterface {
    public function getInfo(): string;
    public function getWheels(): int;
}

abstract class Transport implements TransportInterface {
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

    public function getWheels(): int {
        return $this->wheels;
    }
}

include 'includes/footer.php';