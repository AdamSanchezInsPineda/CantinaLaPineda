fetch('/admin/data/monthly-sales')
.then(response => response.json())
.then(data => {
    const salesJson = data;
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

        ctx.fillStyle = 'rgba(17, 83, 224, 0.6)';
        ctx.fillRect(x, y, width, monthlySales[i]); // rellenar de azul la barra

        ctx.fillStyle = '#000';
        ctx.fillText(monthLabel[i], x + width / 2 - 10, canvas.height - 10); // nombre del mes, no tengo ni idea de como va esto, alabado sea chatgpt
        ctx.fillText(monthlySales[i], x + width / 2 - 10, y - 5); // cantidad de ventas, lo mismo
    }
})
.catch(error => {
    console.error('Pues resulta que', error);
});