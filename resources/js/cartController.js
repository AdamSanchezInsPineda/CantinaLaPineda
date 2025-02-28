import Cart from './Cart';

let cart = new Cart();

cart.getProducts().then(data => {
    data.forEach(product => {
        let button = document.getElementById(`product-${product.id}`);

        if (button) {
            button.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                cart.addToCart(product.id);
                return false;
            });
        }
    });
})

