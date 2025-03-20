<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago fallido</title>
</head>
<body>
    <h1>Pago fallido</h1>
    <p>Lo sentimos, hubo un problema al procesar tu pago. Por favor, inténtalo de nuevo.</p>
    @if (isset($params))
        <h2>Detalles del error:</h2>
        <pre>{{ json_encode($params, JSON_PRETTY_PRINT) }}</pre>
    @endif
</body>
</html>