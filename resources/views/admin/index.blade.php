<x-admin-layout>
    <div class="flex items-center pt-20 justify-center gap-20 flex-col md:flex-row">
        <a href="{{ route("admin.product.index") }}" class="flex flex-col justify-center text-center">
            <x-icons.product class="size-20"/>
            <p>Productos</p>
        </a>

        <a href="{{ route("admin.order.index") }}" class="flex flex-col justify-center text-center">
            <x-icons.order class="size-20"/>
            <p>Pedidos</p>
        </a>

        <a href="{{ route("admin.category.index") }}" class="flex flex-col justify-center text-center">
            <x-icons.category class="size-20"/>
            <p>Categorias</p>
        </a>

        <a href="{{ route("admin.dashboard") }}" class="flex flex-col justify-center text-center">
            <x-icons.user class="size-20"/>
            <p>Usuarios</p>
        </a>
    </div>

    <div class="mt-10 flex flex-col items-center justify-center">
        <p class="text-3xl">Grafico temporal</p>
        <canvas id="salesChart" width="800" height="600"></canvas>

        <script>
        fetch('/admin/api/monthly-sales')
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Pues resulta que', error);
        });

        // JSON falso
        const salesJson = {
            "sales": [
                {"month": 1, "sales": 300},
                {"month": 2, "sales": 400},
                {"month": 3, "sales": 200},
                {"month": 4, "sales": 100},
                {"month": 5, "sales": 300},
                {"month": 6, "sales": 200},
                {"month": 7, "sales": 100},
                {"month": 8, "sales": 400},
                {"month": 9, "sales": 500},
                {"month": 10, "sales": 100},
                {"month": 11, "sales": 400},
                {"month": 12, "sales": 200}
            ]
        };

        // los meses sin datos se rellenan con 0
        let monthlySales = new Array(12).fill(0);

        // rellenar el array con los datos del JSON
        salesJson.sales.forEach(sale => {
            monthlySales[sale.month - 1] = sale.sales; // guarda los datos
        });

        const canvas = document.getElementById('salesChart');
        const ctx = canvas.getContext('2d');

        // configuraciones
        const width = 45;
        const extraSpacing = 20;
        const maxBarHeight = 500;
        const monthLabel = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"];

        // colocar y dibujar los datos
        for (let i = 0; i < monthlySales.length; i++) {
            const x = i * (width + extraSpacing); // posicion x, es igual al mes (i) mas el ancho de la barra (width) y el espacio (extraSpacing)
            const y = (canvas.height - monthlySales[i]) - 25; // posicion y, es igual a la altura del canvas, menos las ventas, menos 25

            ctx.fillStyle = '#4e73df';
            ctx.fillRect(x, y, width, monthlySales[i]); // rellenar de azul la barra

            ctx.fillStyle = '#000';
            ctx.fillText(monthLabel[i], x + width / 2 - 10, canvas.height - 10); // nombre del mes, no tengo ni idea de como va esto, alabado sea chatgpt
            ctx.fillText(monthlySales[i], x + width / 2 - 10, canvas.height); // cantidad de ventas, lo mismo
        }
        </script>
    </div>
</x-admin-layout>