<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - {{ $order->created_at }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        header {
            background-color: #2d3e50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header p {
            margin: 5px 0;
            font-size: 16px;
        }

        main {
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        table td {
            background-color: #fafafa;
        }

        table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #2d3e50;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Tu factura:</h1>
        <p>Cliente: {{ $order->user->name }}</p>
        <p>Fecha: {{ $order->created_at->format('d-m-Y H:i') }}</p>
    </header>

    <main>
        <h2>Detalles del pedido:</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ number_format($product->price, 2) }} €</td>
                        <td>{{ number_format($product->pivot->quantity * $product->price, 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p>Total: {{ number_format($order->total_price, 2) }} €</p>
        </div>
    </main>

</body>
</html>

