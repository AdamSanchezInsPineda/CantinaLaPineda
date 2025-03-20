<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago exitoso</title>
</head>
<body>
    <h1>¡Pago exitoso!</h1>
    <p>Gracias por tu compra. Tu transacción se ha completado correctamente.</p>
    @if (isset($params))
        <h2>Detalles de la transacción:</h2>
        <pre>{{ json_encode($params, JSON_PRETTY_PRINT) }}</pre>
    @endif
</body>
</html>