document.getElementById('searchInput').addEventListener('input', function() {
    let searchTerm = this.value.toLowerCase();
    let categories = document.querySelectorAll('.category-item');

    categories.forEach(function(category) {
        let categoryName = category.querySelector('b').textContent.toLowerCase();
        
        if (categoryName.includes(searchTerm)) {
            category.style.display = '';
        } else {
            category.style.display = 'none';
        }
    });
});