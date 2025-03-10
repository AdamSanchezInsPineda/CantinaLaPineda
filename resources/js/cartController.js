import Cart from './Cart';

const cartContainer = document.getElementById("cart");

const cartContent = document.getElementById("cart-content");

let cart = new Cart();

const appendCart = () => {
    if (cartContent){
        cartContent.innerHTML = "";
        let cartItems = cart.getCart();

        cart.getProducts().then(data => {
            data.forEach(product => {
                console.log(product)
                let foundItem = cartItems.find(item => item.productId === product.id);
                if (foundItem) {
                    cartContent.innerHTML += `<div class="flex justify-between items-center">
                                                    <img class="w-20" src="${product.images ? "/storage/" + product.images[0] : ""}">
                                                    <div class="flex flex-col justify-between gap-5">
                                                        <p>${product.name}</p>
                                                        <p>Precio: ${product.price}€</p>
                                                    </div>
                                                    <p>Cantidad: ${foundItem.quantity}</p>
                                                </div>`;
                }
            });
        });
    }
}

cart.getProducts().then(data => {
    data.forEach(product => {
        let button = document.getElementById(`product-${product.id}`);

        if (button) {
            button.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                cart.addToCart(product.id);
                appendCart();
                return false;
            });
        }
    });
})

if (cartContainer){
    
}