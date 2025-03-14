import Cart from './Cart';

const cartContainer = document.getElementById("cart-container");
const cartDom = document.getElementById("cart");
const cartContent = document.getElementById("cart-content");
const cartButton = document.getElementById("cart-button");
const mobileCartButton = document.getElementById("cart-button-mb");

let cart = new Cart();

const toggleCart = () => {
    cartContainer.classList.toggle("hidden");
    if (cartDom.classList.contains("-translate-y-full")) {
        cartDom.classList.remove("-translate-y-full", "opacity-0", "pointer-events-none");
        cartDom.classList.add("translate-y-0", "opacity-100");
    } else {
        cartDom.classList.add("-translate-y-full", "opacity-0", "pointer-events-none");
        cartDom.classList.remove("translate-y-0", "opacity-100");
    }
};

const closeCart = () => {
    cartContainer.classList.add("hidden");
    cartDom.classList.add("-translate-y-full", "opacity-0", "pointer-events-none");
    cartDom.classList.remove("translate-y-0", "opacity-100");
};

const appendCart = () => {
    if (cartContent){
        cartContent.innerHTML = "";
        let cartItems = cart.getCart();

        cart.getProducts().then(data => {
            data.forEach(product => {
                console.log(product)
                let foundItem = cartItems.find(item => item.productId === product.id);
                if (foundItem) {
                    cartContent.innerHTML +=    `<div class="flex justify-between items-center">
                                                    <img class="w-20" src="${product.images ? "/storage/" + product.images[0] : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s"}">
                                                    <div class="flex flex-col justify-between gap-5">
                                                        <p>${product.name}</p>
                                                        <p>Precio: ${(product.price * foundItem.quantity).toFixed(2)}€</p>
                                                    </div>
                                                    <p>Cantidad: ${foundItem.quantity}</p>
                                                </div>`;
                }
            });
            cartContent.innerHTML +=    `<div class="flex justify-center"><a href="/checkout">Pagar</a></div>`
        });
    }
}

cart.getProducts().then(data => {
    data.forEach(product => {
        let button = document.getElementById(`product-${product.id}`);

        if (button) {
            button.addEventListener("click", (e) => {
                e.preventDefault();
                cart.addToCart(product.id);
                appendCart();
                toggleCart();
                return false;
            });
        }
    });
});

if (cartButton){
    cartButton.addEventListener("click", () => {
        toggleCart();
    });
}

if (mobileCartButton){
    mobileCartButton.addEventListener("click", (e) => {
        e.preventDefault();
        const mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.add("hidden");
        toggleCart();
    });
}

/*document.addEventListener("click", (event) => {
    if (!cartDom.contains(event.target) && !cartContainer.classList.contains("opacity-0")) {
        closeCart();
    }
});*/

if (cartContainer){
    appendCart();
}

console.log(cart.getCart());