// JSON falso
const salesData = [
    { product: "Bocadillo 1", sales: 558 },
    { product: "Bocadillo 2", sales: 547 },
    { product: "Bocadillo 3", sales: 521 },
    { product: "Bocadillo 4", sales: 508 },
    { product: "Bocadillo 5", sales: 437 },
    { product: "Bocadillo 6", sales: 381 },
    { product: "Bocadillo 7", sales: 325 },
    { product: "Bocadillo 8", sales: 297 },
    { product: "Bocadillo 9", sales: 265 },
    { product: "Bocadillo 10", sales: 251 }
];

const canvas2 = document.getElementById('mostSoldChart');
const ctx2 = canvas2.getContext('2d');

// extrae datos dej JSON
const products = salesData.map(item => item.product);
const sales = salesData.map(item => item.sales);

// propiedades
const barWidth = 45;
const gap = 20;
const canvasHeight = canvas.height;
const canvasWidth = canvas.width;
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

