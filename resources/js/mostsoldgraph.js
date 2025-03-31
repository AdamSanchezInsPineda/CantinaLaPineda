
fetch('/admin/data/most-sold')
.then(response => response.json())
.then(data => {
    const salesData = data.sales;
    const canvas2 = document.getElementById('mostSoldChart');
    const ctx2 = canvas2.getContext('2d');

    // extrae datos dej JSON
    const products = salesData.map(item => item.name);
    const sales = salesData.map(item => item.total_sold);

    // propiedades
    const barWidth = 45;
    const gap = 20;
    const canvasHeight = canvas2.height;
    const canvasWidth = canvas2.width;
    const maxSales = 600;

    // dibujar el grafico
    for (let i = 0; i < sales.length; i++) {
        const barHeight = (sales[i] / maxSales) * (canvasHeight - 40); // tamaño de las barras
        const xPosition = i * (barWidth + gap) + 50; // colocar las barras
        const yPosition = canvasHeight - barHeight - 30;

        // dibujar la barra
        ctx2.fillStyle = 'rgba(139, 75, 192, 0.6)';
        ctx2.fillRect(xPosition, yPosition, barWidth, barHeight);

        // añadir textos
        ctx2.fillStyle = '#000';
        ctx2.textAlign = 'center';
        ctx2.fillText(products[i], xPosition + barWidth / 2, canvasHeight - 10);
        ctx2.fillText(sales[i], xPosition + barWidth / 2, yPosition - 5);
    }
})
.catch(error => {
    console.error('Pues resulta que', error);
});

