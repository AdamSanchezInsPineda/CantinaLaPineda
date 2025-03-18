import Cart from '../Cart';

let cart = new Cart();

function initCheckout(){
    const checkoutButton = document.getElementById("checkout-button");

    getCartProducts();

    if (checkoutButton){
        checkoutButton.removeEventListener("click", fetchOrder);
        checkoutButton.addEventListener("click", fetchOrder);
    }
}

async function getCartProducts(){
    const checkoutContainer = document.getElementById("checkout-container");
    const checkoutContent = document.getElementById("checkout-content");
    const checkoutTotal = document.getElementById("checkout-total");

    if (checkoutContainer){
        checkoutContent.innerHTML = "";

        let cartItems = cart.getCart();
        if (!cartItems || cartItems.length === 0) {
            Turbo.visit("/");
        }
        let products = await cart.getProducts();
        let total = 0;

        products.forEach(product => {
            let foundItem = cartItems.find(item => item.id === product.id);
            if (foundItem) {
                total += Number(product.price * foundItem.quantity);
                checkoutContent.innerHTML +=    `<li class="flex flex-wrap gap-4 text-sm">${product.name}<span class="ml-auto font-bold">${(product.price * foundItem.quantity).toFixed(2)}€</span></li>`;
            }
        });
        checkoutContent.innerHTML +=    `<li class="flex flex-wrap gap-4 text-sm font-bold border-t-2 pt-4">Total <span class="ml-auto">${total.toFixed(2)}€</span></li>`;
        checkoutTotal.innerText = `${total.toFixed(2)}€`;

    }
}

function fetchOrder(){
    cart.checkout();
}

document.addEventListener("turbo:load", initCheckout);
document.addEventListener("turbo:frame-load", initCheckout);

initCheckout();