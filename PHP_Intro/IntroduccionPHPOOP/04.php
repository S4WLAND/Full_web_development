<?php include 'includes/header.php';

// abstract class 
abstract class Transport {
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

include 'includes/footer.php';