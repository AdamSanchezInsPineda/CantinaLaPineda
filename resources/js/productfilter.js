// FILTRA LOS PRODUCTOS EN LA TIENDA SEGUN LO INTRODUCIDO EN LA BARRA DE BUSQUEDA

document.getElementById('search-input').addEventListener('input', function () {
    const query = this.value.toLowerCase(); // texto del buscador
    const products = document.querySelectorAll('#products-container a'); // listado de productos

    products.forEach(function (product) { // para cada producto
        const productName = product.dataset.productName.toLowerCase(); // recoje el dataset con su nombre
        
        if (productName.includes(query)) { // si el nombre incluye el texto del buscador
            product.style.display = ''; // mostrar
        } else {
            product.style.display = 'none'; // esconder
        }
    });
});
