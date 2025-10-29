<?php
require_once 'funciones/funciones.php';
$valor = 20000; // Valor en COP

$nombres  = $_POST["nombres"];
$correo  = $_POST["correo"];
$cantidad_num  = $_POST["cantidad"];
$telefono  = $_POST["telefono"];

$valor_pagar = $valor * $cantidad_num;

$idCompra = guardarDatoscompra($valor_pagar, $cantidad_num, $nombres, $correo, $telefono);

?>
<script src="https://checkout.bold.co/library/boldPaymentButton.js"></script>
<?php
$referencia = "Ebooks_".$idCompra;// Referencia de la compra

$ApiKey = "oemo61j7cNE0NgdXZWO-PvIg2OsP9BTaI5wvXFNSQpY";
$screctKey = "A0xdksnW-r0Ld680LnASOA";


$integritySignature = hash("sha256", $referencia . $valor_pagar . "COP" . $screctKey);
?>
<script>
    const initBoldCheckout = () => {
        if (document.querySelector('script[src="https://checkout.bold.co/library/boldPaymentButton.js"]')) {
            console.warn('Bold Checkout script is already loaded.');
            return;
        }


        var js;
        js = document.createElement('script');
        js.onload = () => {
            window.dispatchEvent(new Event('boldCheckoutLoaded'));
        };
        js.onerror = () => {
            window.dispatchEvent(new Event('boldCheckoutLoadFailed'));
        };
        js.src = 'https://checkout.bold.co/library/boldPaymentButton.js';
        document.head.appendChild(js);
    };

    const checkout = new BoldCheckout({

        orderId: "<?php echo $referencia; ?>",
        currency: "COP",
        amount: <?php echo $valor_pagar ?>,
        apiKey: "<?php echo $ApiKey; ?>",
        redirectionUrl: "https://appinversiones.com.co/public/finaliza_proceso.php",
        integritySignature: "<?php echo $integritySignature; ?>",
        description: "Venta de Ebooks",  
        customerData: JSON.stringify({
            email: '<?php echo $correo; ?>',
            fullName: '<?php echo $nombres; ?>',
            phone: '<?php echo $telefono;?>'
        }),    
    });

    checkout.open();
</script>