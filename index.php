<?php

require 'PaypalPayment.php';
$payment = new PaypalPayment();
$clienteIDSandbox = $payment->getClienteIDSandbox();
$clienteIDLive = $payment->getClienteIDLive();
$mode = $payment->mode;
$currency = $payment->currency;
/** A continuación los datos del pago a realizar  */
$orderNumber = time();
$amount = 250.00;
$description = 'Nombre de la Empresa - Pedido Nro. ' . $orderNumber . ', monto ' . $currency . ' ' . $amount;
/** Un valor encriptado que pueda servir como guía de la orden, ejemplo el ID de la orden */
$custom = '485172759390023945615';

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagando con Paypal</title>
</head>

<body>

  <div id="paypal-button"></div>
  <?php if (!empty($clienteIDLive) || !(empty($clienteIDSandbox))) : ?>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
      paypal.Button.render({
        // Configure environment
        env: '<?= $mode ?>', // or production
        client: {
          sandbox: '<?= $clienteIDSandbox ?>',
          production: '<?= $clienteIDLive ?>'
        },
        // Customize button (optional)
        locale: 'es_US',
        style: {
          label: 'checkout',
          size: 'small',
          color: 'gold',
          shape: 'pill',
        },
        // Enable Pay Now checkout flow (optional)
        commit: true,
        // Set up a payment
        payment: function(data, actions) {
          return actions.payment.create({
            transactions: [{
              amount: {
                total: '<?= $amount ?>',
                currency: '<?= $currency ?>'
              },
              description: '<?= $description ?>',
              custom: '<?= $custom ?>'
            }]
          });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
          return actions.payment.execute().then(function() {
            window.location = 'verificar.php?paymentId=' + data.paymentID;
          });
        }
      }, '#paypal-button');
    </script>
  <?php endif ?>
</body>

</html>