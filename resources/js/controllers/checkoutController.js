import Cart from '../Cart';

const checkoutContainer = document.getElementById("checkout-container");
const checkoutContent = document.getElementById("checkout-content");
const checkoutTotal = document.getElementById("checkout-total");

let cart = new Cart();

function getCartProducts(){
    if (checkoutContent){
        checkoutContent.innerHTML = "";
        let cartItems = cart.getCart();

        cart.getProducts().then(data => {
            let total = 0;
            data.forEach(product => {
                console.log(product)
                let foundItem = cartItems.find(item => item.productId === product.id);
                if (foundItem) {
                    total += Number(product.price * foundItem.quantity);
                    checkoutContent.innerHTML +=    `<li class="flex flex-wrap gap-4 text-sm">${product.name}<span class="ml-auto font-bold">${(product.price * foundItem.quantity).toFixed(2)}€</span></li>`;
                }
            });
            checkoutContent.innerHTML +=    `<li class="flex flex-wrap gap-4 text-sm font-bold border-t-2 pt-4">Total <span class="ml-auto">${total.toFixed(2)}€</span></li>`;
            checkoutTotal.innerText = `${total.toFixed(2)}€`;
        });
    }
}

function fetchOrder(){
    cart.checkout();
}

if (checkoutContainer){
    getCartProducts();
}

document.getElementById("checkout-button").addEventListener("click", fetchOrder);