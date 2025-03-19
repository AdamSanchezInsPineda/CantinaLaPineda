<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar con Bizum</title>
</head>
<body>
    <h1>Pagar con Bizum</h1>
    <form action="{{ url('/bizum/pay') }}" method="POST">
        @csrf
        <label for="amount">Monto (€):</label>
        <input type="number" name="amount" required step="0.01"><br><br>

        <label for="order_id">ID del Pedido:</label>
        <input type="text" name="order_id" required><br><br>

        <label for="phone">Teléfono Bizum (con prefijo, ej: +34):</label>
        <input type="text" name="phone" required pattern="^\+[0-9]{5,15}$"><br><br>

        <button type="submit">Pagar</button>
    </form>
</body>
</html>
