<?php
include_once 'abrir.php';

/**
 * Guarda los datos de la compra en la base de datos.
 * 
 * @return void
 */
function guardarDatoscompra($valor_cancela, $cantidad, $nombres, $correo, $telefono)
{
    $bd = obtenerConexion();
    $sql = "insert into ventas (estado_venta, valor_cancela, cantidad, nombre_comprador, correo_comprador,telefono_celular) values (?,?,?,?,?,?)";
    $stmt = $bd->prepare($sql);
    $stmt->execute(['P', $valor_cancela, $cantidad, $nombres, $correo, $telefono]);
    return $bd->lastInsertId();
}
function actualizardatosCompra($idCompra, $estado, $transactionId, $fecha_venta,  $metodoPago,  $referencia_pago)
{
    $bd = obtenerConexion();
    $sql = "update ventas set estado_venta=?, transaction_id=?, fecha_venta=?, metodo_pago=?, referencia_pago=? where id_venta=?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$estado, $transactionId, $fecha_venta, $metodoPago, $referencia_pago, $idCompra]);
}
function obtenerNumExists($numero)
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT count(1) cantidad FROM ventas where numeros like '%$numero%';");
    return $sentencia->fetchAll();
}
function guardaNumerosVenta($idVenta, $numeros)
{
    $bd = obtenerConexion();
    $sql = "update ventas set numeros=? where id_venta=?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$numeros, $idVenta]);
}

function numGenerados($idVenta)
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT numeros FROM ventas where id_venta = $idVenta;");
    return $sentencia->fetch();
}

function enviarCorreoHtml($para, $numeros, $producto)
{    
    require_once('./mail/class.smtp.php');
    require_once('./mail/class.phpmailer.php');

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $mail->Port       = 587;
    $mail->Username = "luisferdeveloper@gmail.com";
    $mail->Password = "mcoz llex etyw cmec";
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('Stickers@gmail.com', 'Stickers');
    // $to = "wallpapersss@gmail.com";
    $mail->addAddress($para);

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = "Tus Stickers";
    $mail->Body    .= "<td class='esd-stripe' align='center' esd-custom-block-id='1057446'>
            <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' align='center'>
                <tbody>
                    <tr>
                        <td class='esd-structure es-p30t es-p40b es-p40r es-p40l es-m-p20r es-m-p20l' align='left'>
                            <table width='100%' cellspacing='0' cellpadding='0'>
                                <tbody>
                                    <tr>
                                        <td class='es-m-p0r es-m-p20b esd-container-frame' width='520' valign='top' align='center'>
                                            <table width='100%' cellspacing='0' cellpadding='0' style='border-radius: 30px; border-collapse: separate;'>
                                                <tbody>
                                                    <tr>
                                                        <td align='left' class='esd-block-text es-p40t es-p20b es-p30r es-p30l'>
                                                            <img src='https://assets.zyrosite.com/cdn-cgi/image/format=auto,w=456,fit=crop,q=95/m5KwaODD03cW8bJq/disea--o-sin-tatulo-11-YKb3ok383ltQjDxg.png' width='500px'>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' class='esd-block-text es-p30r es-p30l'>
                                                            <p><strong>Gracias por su compra</strong></p>
                                                            <p><br></p>
                                                            <p>Hemos terminado de procesar su pedido.</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class='esd-block-menu' esd-tmp-menu-size='width|30' esd-tmp-menu-font-size='12px'>
                                                            <table cellpadding='0' cellspacing='0' width='100%' class='es-menu'>
                                                                <tbody>
                                                                    <tr class='links-images-top'>
                                                                        <td align='center' valign='top' width='50%' class='es-p10t es-p10b es-p5r es-p30l' bgcolor='transparent'>";
                                                                        for ($j = 0; $j < count($numeros); $j++) {
                                                                            $mail->Body    .= $numeros[$j]."<br>";
                                                                        }
                                                                        $mail->Body    .= "</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' class='esd-block-text es-p15b es-p30r es-p30l'>
                                                            <p>Descargar <br></p>
                                                            <table cellspacing='0' cellpadding='6' border='1' style='color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif' width='100%'>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope='col' style='color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left' align='left'>Producto</th>
                                                                        <th scope='col' style='color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left' align='left'>Descargar</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope='col' style='color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left' align='center'>" . $producto . "</td>
                                                                        <td  scope='col' style='color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left' align='center'><a href='https://assets.zyrosite.com/cdn-cgi/image/format=auto,w=456,fit=crop,q=95/m5KwaODD03cW8bJq/disea--o-sin-tatulo-11-YKb3ok383ltQjDxg.png' download target='_blank'>Logo</a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>                                                    
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>";

    $mail->send();
}
