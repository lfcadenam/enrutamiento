<?php
include_once "funciones/funciones.php";

$idPublicacion = $_REQUEST['bold-order-id'];
$estadoTransaccion = strtoupper($_REQUEST['bold-tx-status']);

$ch = curl_init();
$url = "https://payments.api.bold.co/v2/payment-voucher/" . $idPublicacion;
//$dataComprador = [];
$headers    = [];
$headers[]  = 'Authorization: x-api-key oemo61j7cNE0NgdXZWO-PvIg2OsP9BTaI5wvXFNSQpY';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    $errorMsg = curl_error($ch);
    echo "Error al conectarce a la API";
} else {
    curl_close($ch);
    $dataTransac = json_decode($response, true);

    $estadoTransaccion = $dataTransac['payment_status'];
    $transactionId = $dataTransac['transaction_id'];
    $fecha_transaccion = $dataTransac['transaction_date'];
    $reference_pol = $dataTransac['reference_id'];
    $metodoPago = $dataTransac['payment_method'];
    $correo_transac = $dataTransac['payer_email'];
    $ValorTransac = $dataTransac['total'];
    $concepto = $dataTransac['description'];
}

$estadoTx  = "";
if ($estadoTransaccion == "APPROVED") {
    $estadoTx = 'Transaación Aprobada';
} elseif ($estadoTransaccion == "REJECTED") {
    $estadoTx = 'Transaación Rechazada';
} elseif ($estadoTransaccion == "FAILED") {
    $estadoTx = 'Transaación Fallida';
}

$currency = "COP";

$idPublica = substr($idPublicacion, strpos($idPublicacion, "_") + 1, strlen($idPublicacion));
actualizardatosCompra($idPublica, $estadoTransaccion, $transactionId, $fecha_transaccion,  $metodoPago, $idPublicacion);
$numerosG = numGenerados($idPublica);
$infoCompra = infoVenta($idPublica);
$nombres = $infoCompra->nombre_comprador;
$correo = $infoCompra->correo_comprador;
$cantidad = $infoCompra->cantidad;
//$cantidad = 5;
$cantidad_t = 10000;

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Formulario Compra Ebooks</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbars/">
    <!-- Bootstrap core CSS -->
    <link href="css/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_tickets.css">
    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Eleventh navbar example">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarsExample09">
                    </div>
                </div>
            </nav>
            <div>
                <div class="bg-light p-5 rounded">
                    <div class="col-sm-8 mx-auto">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <?php
                                if ($estadoTransaccion == "APPROVED") {
                                ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#198754" class="bi bi-check-circle mb-3" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z" />
                                    </svg>
                                    <h1 class="card-title mb-3">¡Pago Exitoso!</h1>
                                    <h5 class="card-subtitle mb-4 text-muted">
                                        Gracias por tu pago.<br>
                                    </h5>
                                    <?php

                                    $numeros = "";
                                    $cantNumFor = 0;
                                    if ($numerosG->numeros == "") {
                                        $i = 0;
                                        $nInicial = 0000;
                                        if (strlen($cantidad_t) > 5) {
                                            $nInicial = 00000;
                                        }
                                        //do {
                                        for ($f = 0; $f < $cantidad; $f++) {
                                            $numero =  mt_rand($nInicial, $cantidad_t);
                                            if (strlen($cantidad_t) == 5 && strlen($numero) == 4) {
                                                $existe = obtenerNumExists($numero);
                                                $cantidadN = 0;
                                                foreach ($existe as $exist) {
                                                    $cantidadN = $exist->cantidad;
                                                }
                                                if ($cantidadN <= 0) {
                                                    $numeros .= $numero . ",";
                                                    //$i++;
                                                }
                                            } elseif (strlen($cantidad_t) == 5 && strlen($numero) < 4) {
                                                $numero = (str_pad($numero, 4, '0', STR_PAD_LEFT));
                                                $existe = obtenerNumExists($numero);
                                                $cantidadN = 0;
                                                foreach ($existe as $exist) {
                                                    $cantidadN = $exist->cantidad;
                                                }
                                                if ($cantidadN <= 0) {
                                                    $numeros .= $numero . ",";
                                                    //$i++;
                                                }
                                            }
                                            //} while ($i <= $cantidad);
                                        }

                                        guardaNumerosVenta($idPublica, substr($numeros, 0, -1));
                                        $cantNumFor = count(explode(",", $numeros)) - 1;
                                    } else {
                                        $numeros = $numerosG->numeros;
                                        $cantNumFor = count(explode(",", $numeros));
                                    }
                                    $listNumeros = explode(",", $numeros);
                                    echo "<p>Sus numeros de Ebooks son los siguientes: </p>";
                                    $concepto = "Ebooks AppInversiones";

                                    ?>
                                    <div class="tixGrid">
                                        <?php
                                        for ($j = 0; $j < $cantNumFor; $j++) {
                                        ?>
                                            <div class="tixContainer">
                                                <a class="tix" href="#">
                                                    <div class="tixInner">
                                                        <span><?= $listNumeros[$j] ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php }
                                        enviarCorreoHtml($correo, $listNumeros, $concepto);
                                        ?>
                                    </div>
                                <?php
                                } else { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#dc3545" class="mb-3" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                    <h1 class="card-title mb-3 text-danger">¡Pago Rechazado!</h1>
                                    <p class="card-text mb-4">
                                        Lo sentimos, tu pago no pudo ser procesado.<br>
                                        Por favor verifica los datos de tu tarjeta o intenta con otro método de pago.<br>
                                        Si el problema persiste, contacta a soporte.
                                    </p>
                                <?php } ?>
                                <a href="https://racsoluciones.com/marketing-360" class="btn btn-success">Volver al inicio</a>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <small class="text-muted">&copy; <?php echo date('Y'); ?> LuisferDeveloper. Todos los derechos reservados.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>