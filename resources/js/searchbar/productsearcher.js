document.getElementById('searchInput').addEventListener('input', function() {
    let searchTerm = this.value.toLowerCase();
    let products = document.querySelectorAll('.product-item');

    products.forEach(function(product) {
        let productName = product.querySelector('b').textContent.toLowerCase();
        let productCode = product.querySelector('.product-code').textContent.toLowerCase();
        let productCategory = product.querySelector('.product-category').textContent.toLowerCase();
        
        if (productName.includes(searchTerm) || productCode.includes(searchTerm) || productCategory.includes(searchTerm)) {
            product.style.display = '';
        } else {
            product.style.display = 'none';
        }
    });
});