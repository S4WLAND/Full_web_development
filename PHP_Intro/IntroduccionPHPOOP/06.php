<?php 

/**
 * Sistema de Procesamiento de Pagos usando Interfaces
 * 
 * Este ejemplo demuestra el uso de interfaces en PHP para crear
 * un sistema polimórfico de procesamiento de pagos.
 * 
 * @author Stifh BL
 * @version 1.0
 */

// ===== 1. DEFINIR CONTRATOS =====

/**
 * Interfaz que define el contrato para procesadores de pago
 * 
 * Define QUÉ métodos debe implementar cualquier procesador de pago,
 * sin especificar CÓMO deben implementarse.
 * 
 * @package PaymentSystem
 */
interface PaymentProcessorInterface 
{
    /**
     * Procesa un pago por el monto especificado
     * 
     * @param float $amount Monto a procesar
     * @return bool True si el pago fue exitoso, false en caso contrario
     */
    public function processPayment(float $amount): bool;
    
    /**
     * Procesa un reembolso para una transacción específica
     * 
     * @param string $transactionId ID de la transacción a reembolsar
     * @return bool True si el reembolso fue exitoso, false en caso contrario
     */
    public function refund(string $transactionId): bool;
    
    /**
     * Obtiene el estado de una transacción
     * 
     * @param string $transactionId ID de la transacción
     * @return string Estado de la transacción
     */
    public function getTransactionStatus(string $transactionId): string;
}

/**
 * Implementación del procesador de pagos PayPal
 * 
 * Implementa la interfaz PaymentProcessorInterface con
 * la lógica específica para PayPal.
 * 
 * @package PaymentSystem
 */
class PayPalProcessor implements PaymentProcessorInterface 
{
    /**
     * Procesa un pago usando PayPal
     * 
     * @param float $amount Monto a procesar
     * @return bool Siempre retorna true para este ejemplo
     */
    public function processPayment(float $amount): bool 
    {
        echo "<div class='payment-info'>";
        echo "<strong>💳 Procesando $" . number_format($amount, 2) . " via PayPal</strong><br>";
        echo "🔄 Conectando con servidores de PayPal...<br>";
        echo "✅ Pago autorizado exitosamente<br>";
        echo "</div><br>";
        
        // Aquí iría la lógica específica de PayPal
        return true;
    }
    
    /**
     * Procesa un reembolso en PayPal
     * 
     * @param string $transactionId ID de la transacción
     * @return bool Siempre retorna true para este ejemplo
     */
    public function refund(string $transactionId): bool 
    {
        echo "<div class='refund-info'>";
        echo "<strong>💰 Reembolso PayPal:</strong> " . $transactionId . "<br>";
        echo "✅ Reembolso procesado exitosamente<br>";
        echo "</div><br>";
        return true;
    }
    
    /**
     * Obtiene el estado de transacción de PayPal
     * 
     * @param string $transactionId ID de la transacción
     * @return string Estado de la transacción
     */
    public function getTransactionStatus(string $transactionId): string 
    {
        return "<span class='status-completed'>PayPal Status: Completed</span>";
    }
}

/**
 * Implementación del procesador de pagos Stripe
 * 
 * Implementa la interfaz PaymentProcessorInterface con
 * la lógica específica para Stripe.
 * 
 * @package PaymentSystem
 */
class StripeProcessor implements PaymentProcessorInterface 
{
    /**
     * Procesa un pago usando Stripe
     * 
     * @param float $amount Monto a procesar
     * @return bool Siempre retorna true para este ejemplo
     */
    public function processPayment(float $amount): bool 
    {
        echo "<div class='payment-info'>";
        echo "<strong>💳 Procesando $" . number_format($amount, 2) . " via Stripe</strong><br>";
        echo "🔄 Validando tarjeta de crédito...<br>";
        echo "✅ Transacción completada<br>";
        echo "</div><br>";
        
        // Aquí iría la lógica específica de Stripe
        return true;
    }
    
    /**
     * Procesa un reembolso en Stripe
     * 
     * @param string $transactionId ID de la transacción
     * @return bool Siempre retorna true para este ejemplo
     */
    public function refund(string $transactionId): bool 
    {
        echo "<div class='refund-info'>";
        echo "<strong>💰 Reembolso Stripe:</strong> " . $transactionId . "<br>";
        echo "✅ Reembolso aplicado a la tarjeta<br>";
        echo "</div><br>";
        return true;
    }
    
    /**
     * Obtiene el estado de transacción de Stripe
     * 
     * @param string $transactionId ID de la transacción
     * @return string Estado de la transacción
     */
    public function getTransactionStatus(string $transactionId): string 
    {
        return "<span class='status-processed'>Stripe Status: Processed</span>";
    }
}

/**
 * Implementación del procesador de pagos con Criptomonedas
 * 
 * Implementa la interfaz PaymentProcessorInterface con
 * la lógica específica para Bitcoin y otras criptomonedas.
 * 
 * @package PaymentSystem
 */
class CryptoProcessor implements PaymentProcessorInterface 
{
    /**
     * Procesa un pago usando criptomonedas
     * 
     * @param float $amount Monto a procesar
     * @return bool Siempre retorna true para este ejemplo
     */
    public function processPayment(float $amount): bool 
    {
        echo "<div class='payment-info'>";
        echo "<strong>₿ Procesando $" . number_format($amount, 2) . " via Bitcoin</strong><br>";
        echo "🔄 Esperando confirmación en blockchain...<br>";
        echo "✅ Transacción confirmada (3/6 confirmaciones)<br>";
        echo "</div><br>";
        
        return true;
    }
    
    /**
     * Intenta procesar un reembolso en criptomonedas
     * 
     * @param string $transactionId ID de la transacción
     * @return bool Siempre retorna false (los reembolsos crypto no están disponibles)
     */
    public function refund(string $transactionId): bool 
    {
        echo "<div class='refund-error'>";
        echo "<strong>❌ Reembolsos crypto no disponibles:</strong> " . $transactionId . "<br>";
        echo "⚠️ Las transacciones de criptomonedas son irreversibles<br>";
        echo "</div><br>";
        return false;
    }
    
    /**
     * Obtiene el estado de transacción de criptomonedas
     * 
     * @param string $transactionId ID de la transacción
     * @return string Estado de la transacción
     */
    public function getTransactionStatus(string $transactionId): string 
    {
        return "<span class='status-blockchain'>Crypto Status: Confirmed on blockchain</span>";
    }
}

// ===== 2. POLIMORFISMO CON INTERFACES =====

/**
 * Carrito de compras con procesamiento polimórfico de pagos
 * 
 * Esta clase demuestra cómo usar interfaces para lograr polimorfismo,
 * permitiendo trabajar con diferentes procesadores de pago de manera uniforme.
 * 
 * @package PaymentSystem
 */
class ShoppingCart 
{
    /** @var array Array de items en el carrito */
    private array $items = [];
    
    /** @var PaymentProcessorInterface Procesador de pagos actual */
    private PaymentProcessorInterface $paymentProcessor;
    
    /**
     * Constructor del carrito de compras
     * 
     * Acepta CUALQUIER implementación de PaymentProcessorInterface
     * gracias al polimorfismo que proporcionan las interfaces.
     * 
     * @param PaymentProcessorInterface $processor Procesador de pagos a usar
     */
    public function __construct(PaymentProcessorInterface $processor) 
    {
        $this->paymentProcessor = $processor;
        echo "<div class='cart-init'>";
        echo "🛒 <strong>Carrito inicializado</strong> con " . get_class($processor) . "<br>";
        echo "</div><br>";
    }
    
    /**
     * Agrega un item al carrito
     * 
     * @param string $product Nombre del producto
     * @param float $price Precio del producto
     * @return void
     */
    public function addItem(string $product, float $price): void 
    {
        $this->items[] = ['product' => $product, 'price' => $price];
        echo "<div class='item-added'>";
        echo "➕ <strong>Producto agregado:</strong> " . $product . " - $" . number_format($price, 2) . "<br>";
        echo "</div>";
    }
    
    /**
     * Procesa el checkout del carrito
     * 
     * Calcula el total y procesa el pago usando el procesador actual.
     * Funciona con CUALQUIER implementación de PaymentProcessorInterface.
     * 
     * @return bool True si el pago fue exitoso, false en caso contrario
     */
    public function checkout(): bool 
    {
        $total = array_sum(array_column($this->items, 'price'));
        
        echo "<div class='checkout-summary'>";
        echo "<h3>📋 Resumen del Pedido:</h3>";
        
        foreach ($this->items as $item) {
            echo "• " . $item['product'] . " - $" . number_format($item['price'], 2) . "<br>";
        }
        
        echo "<hr>";
        echo "<strong>💰 Total a pagar: $" . number_format($total, 2) . "</strong><br>";
        echo "</div><br>";
        
        // ✅ Polimorfismo en acción: funciona con CUALQUIER processor
        $success = $this->paymentProcessor->processPayment($total);
        
        if ($success) {
            echo "<div class='checkout-success'>";
            echo "<h3>🎉 ¡Pago completado exitosamente!</h3>";
            echo "📧 Se ha enviado un email de confirmación<br>";
            echo "📦 Tu pedido será procesado en 24-48 horas<br>";
            echo "</div><br>";
            
            $this->items = []; // Limpiar carrito
        } else {
            echo "<div class='checkout-error'>";
            echo "<h3>❌ Error en el pago</h3>";
            echo "⚠️ Por favor, intenta con otro método de pago<br>";
            echo "</div><br>";
        }
        
        return $success;
    }
    
    /**
     * Cambia el método de pago dinámicamente
     * 
     * Demuestra la flexibilidad que proporcionan las interfaces:
     * podemos cambiar la implementación en tiempo de ejecución.
     * 
     * @param PaymentProcessorInterface $newProcessor Nuevo procesador a usar
     * @return void
     */
    public function changePaymentMethod(PaymentProcessorInterface $newProcessor): void 
    {
        $oldProcessor = get_class($this->paymentProcessor);
        $this->paymentProcessor = $newProcessor;
        
        echo "<div class='method-change'>";
        echo "🔄 <strong>Método de pago cambiado</strong><br>";
        echo "📤 Anterior: " . $oldProcessor . "<br>";
        echo "📥 Nuevo: " . get_class($newProcessor) . "<br>";
        echo "</div><br>";
    }
    
    /**
     * Muestra el estado actual del carrito
     * 
     * @return void
     */
    public function showCartStatus(): void 
    {
        $itemCount = count($this->items);
        $total = array_sum(array_column($this->items, 'price'));
        
        echo "<div class='cart-status'>";
        echo "<strong>🛒 Estado del Carrito:</strong><br>";
        echo "📦 Items: " . $itemCount . "<br>";
        echo "💰 Total: $" . number_format($total, 2) . "<br>";
        echo "💳 Procesador: " . get_class($this->paymentProcessor) . "<br>";
        echo "</div><br>";
    }
}

// ===== EJEMPLOS DE USO =====

// Agregar estilos CSS para tema oscuro
echo "<style>
    body { background-color: #0d1117; color: #c9d1d9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .payment-info { background: #1a4d3a; padding: 15px; border-left: 4px solid #39d87a; margin: 8px 0; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .refund-info { background: #3d3017; padding: 15px; border-left: 4px solid #f9c23c; margin: 8px 0; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .refund-error { background: #4a1a1a; padding: 15px; border-left: 4px solid #f85149; margin: 8px 0; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .checkout-success { background: #1a3d2e; padding: 20px; border: 1px solid #39d87a; border-radius: 8px; margin: 15px 0; box-shadow: 0 4px 8px rgba(0,0,0,0.4); }
    .checkout-error { background: #4a1a1a; padding: 20px; border: 1px solid #f85149; border-radius: 8px; margin: 15px 0; box-shadow: 0 4px 8px rgba(0,0,0,0.4); }
    .cart-init { background: #1a2332; padding: 15px; border-left: 4px solid #58a6ff; margin: 8px 0; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .method-change { background: #2d2d2d; padding: 15px; border-left: 4px solid #8b949e; margin: 8px 0; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .item-added { background: #1a2e1a; padding: 12px; border-left: 3px solid #39d87a; margin: 5px 0; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
    .checkout-summary { background: #161b22; padding: 20px; border: 1px solid #30363d; border-radius: 8px; margin: 15px 0; box-shadow: 0 4px 8px rgba(0,0,0,0.4); }
    .cart-status { background: #1a2332; padding: 15px; border-left: 4px solid #79c0ff; margin: 8px 0; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .status-completed { color: #39d87a; font-weight: bold; text-shadow: 0 0 5px rgba(57, 216, 122, 0.3); }
    .status-processed { color: #58a6ff; font-weight: bold; text-shadow: 0 0 5px rgba(88, 166, 255, 0.3); }
    .status-blockchain { color: #f9c23c; font-weight: bold; text-shadow: 0 0 5px rgba(249, 194, 60, 0.3); }
    hr { margin: 20px 0; border: none; border-top: 2px solid #30363d; box-shadow: 0 1px 0 rgba(255,255,255,0.1); }
    h1 { color: #f0f6fc; text-shadow: 0 0 10px rgba(240, 246, 252, 0.3); margin-bottom: 10px; }
    h2 { color: #79c0ff; text-shadow: 0 0 8px rgba(121, 192, 255, 0.3); margin-top: 30px; }
    h3 { color: #ffa657; text-shadow: 0 0 6px rgba(255, 166, 87, 0.3); }
    .dark-container { background: linear-gradient(135deg, #0d1117 0%, #161b22 100%); min-height: 100vh; }
    .content-wrapper { max-width: 900px; margin: 0 auto; padding: 20px; background: rgba(22, 27, 34, 0.8); backdrop-filter: blur(10px); border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.5); }
    .advantages-section { background: linear-gradient(135deg, #1a2332 0%, #2d2d2d 100%); padding: 25px; border-radius: 12px; border: 1px solid #30363d; box-shadow: 0 4px 16px rgba(0,0,0,0.3); }
    .advantages-section ul { list-style: none; padding: 0; }
    .advantages-section li { padding: 8px 0; border-bottom: 1px solid rgba(48, 54, 61, 0.5); }
    .advantages-section li:last-child { border-bottom: none; }
    .advantages-section strong { color: #ffa657; }
    em { color: #8b949e; font-style: italic; }
    .glow-text { animation: glow 2s ease-in-out infinite alternate; }
    @keyframes glow {
        from { text-shadow: 0 0 5px currentColor, 0 0 10px currentColor, 0 0 15px currentColor; }
        to { text-shadow: 0 0 10px currentColor, 0 0 20px currentColor, 0 0 30px currentColor; }
    }
</style>";

echo "<div style='max-width: 800px; margin: 0 auto; font-family: Arial, sans-serif;'>";
echo "<h1>🏪 Sistema de Pagos con Interfaces - Demostración</h1>";
echo "<p><em>Este ejemplo muestra cómo las interfaces permiten polimorfismo y flexibilidad en el código PHP.</em></p>";
echo "<hr style='margin: 20px 0;'>";

echo "<h2>🧪 1. POLIMORFISMO EN ACCIÓN</h2>";
echo "<p>Creando un carrito con PayPal como método inicial:</p>";

// 1. Crear carrito con PayPal
$cart = new ShoppingCart(new PayPalProcessor());
$cart->addItem("💻 Laptop Gaming", 1200.00);
$cart->addItem("🖱️ Mouse Inalámbrico", 25.50);
$cart->showCartStatus();
$cart->checkout();

echo "<hr style='margin: 20px 0;'>";
echo "<h2>🔄 2. CAMBIO DINÁMICO DE PROCESADOR</h2>";
echo "<p>Cambiando a Stripe para una nueva compra:</p>";

// 2. Cambiar método de pago dinámicamente
$cart->changePaymentMethod(new StripeProcessor());
$cart->addItem("⌨️ Teclado Mecánico", 75.00);
$cart->addItem("🖥️ Monitor 4K", 350.99);
$cart->checkout();

echo "<hr style='margin: 20px 0;'>";
echo "<h2>₿ 3. USANDO CRIPTOMONEDAS</h2>";
echo "<p>Probando con el procesador de Bitcoin:</p>";

// 3. Probar con criptomonedas
$cart->changePaymentMethod(new CryptoProcessor());
$cart->addItem("🎧 Auriculares Premium", 199.99);
$cart->checkout();

echo "<hr style='margin: 20px 0;'>";
echo "<h2>🔍 4. DEMOSTRACIÓN DE ESTADOS Y REEMBOLSOS</h2>";

// 4. Demostrar diferentes comportamientos
$processors = [
    new PayPalProcessor(),
    new StripeProcessor(), 
    new CryptoProcessor()
];

foreach ($processors as $processor) {
    $processorName = get_class($processor);
    echo "<h3>📊 Testing " . $processorName . ":</h3>";
    
    // Mostrar estado de transacción
    echo "<div style='margin: 10px 0;'>";
    echo "<strong>Estado:</strong> " . $processor->getTransactionStatus("TXN123456") . "<br>";
    echo "</div>";
    
    // Probar reembolso
    $processor->refund("TXN123456");
    
    echo "<br>";
}

echo "<hr style='margin: 20px 0;'>";
echo "<h2>✨ VENTAJAS DE USAR INTERFACES</h2>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px;'>";
echo "<h3>🎯 Beneficios del Polimorfismo con Interfaces:</h3>";
echo "<ul>";
echo "<li><strong>🔄 Flexibilidad:</strong> Puedes cambiar implementaciones sin modificar el código cliente</li>";
echo "<li><strong>🧩 Extensibilidad:</strong> Agregar nuevos procesadores es muy fácil</li>";
echo "<li><strong>🧪 Testabilidad:</strong> Puedes crear mocks fácilmente para testing</li>";
echo "<li><strong>📜 Contratos claros:</strong> La interfaz define exactamente qué métodos se requieren</li>";
echo "<li><strong>🏗️ Separación de responsabilidades:</strong> El carrito no necesita saber cómo funciona cada procesador</li>";
echo "</ul>";
echo "</div>";

echo "</div>";

