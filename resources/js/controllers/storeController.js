import Cart from '../Cart';

let cart = new Cart();

// Alternar visibilidad del carrito
const toggleCart = () => {
    const cartContainer = document.getElementById("cart-container");
    const cartDom = document.getElementById("cart");

    if (cartContainer && cartDom) {
        cartContainer.classList.toggle("hidden");
        cartDom.classList.toggle("-translate-y-full");
        cartDom.classList.toggle("opacity-0");
        cartDom.classList.toggle("pointer-events-none");
        cartDom.classList.toggle("translate-y-0");
        cartDom.classList.toggle("opacity-100");
    }
};

// Cerrar carrito
const closeCart = () => {
    const cartContainer = document.getElementById("cart-container");
    const cartDom = document.getElementById("cart");

    if (cartContainer && cartDom) {
        cartContainer.classList.add("hidden");
        cartDom.classList.add("-translate-y-full", "opacity-0", "pointer-events-none");
        cartDom.classList.remove("translate-y-0", "opacity-100");
    }
};

// Calcular el total del carrito
const calculateCartTotal = (cartItems, products) => {
    return cartItems.reduce((total, item) => {
        const product = products.find(p => p.id === item.id);
        return total + (product ? product.price * item.quantity : 0);
    }, 0);
};

// Actualizar cantidad de un producto
const updateQuantity = async (productId, newQuantity) => {
    if (newQuantity <= 0) {
        cart.removeFromCart(productId);
    } else {
        cart.updateQuantity(productId, newQuantity);
    }
    await appendCart();
};

// Vaciar el carrito
const emptyCart = async () => {
    cart.emptyCart();
    await appendCart();
};

// Renderizar carrito
const appendCart = async () => {
    const cartContent = document.getElementById("cart-content");
    const cartTotal = document.getElementById("cart-total");
    const cartSummary = document.getElementById("cart-summary");
    const emptyCartMessage = document.getElementById("empty-cart-message");
    
    if (!cartContent || !cartTotal || !cartSummary || !emptyCartMessage) return;

    cartContent.innerHTML = "";

    const cartItems = cart.getCart();
    const products = await cart.getProducts();
    
    // Mostrar mensaje si el carrito está vacío
    if (cartItems.length === 0) {
        cartSummary.classList.add("hidden");
        emptyCartMessage.classList.remove("hidden");
        return;
    } else {
        cartSummary.classList.remove("hidden");
        emptyCartMessage.classList.add("hidden");
    }

    // Generar HTML para cada producto en el carrito
    cartItems.forEach(item => {
        const product = products.find(p => p.id === item.id);
        if (!product) return;

        const itemTotal = product.price * item.quantity;
        
        const itemHTML = `
            <div class="py-4" data-product-id="${product.id}">
                <div class="flex flex-col sm:flex-row gap-4">
                    <img class="w-20 h-20 object-cover rounded" src="${product.images ? "/storage/" + product.images[0] : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s"}">
                    <div class="flex-1">
                        <h3 class="font-semibold">${product.name}</h3>
                        <p class="text-gray-600 text-sm">Precio unitario: ${product.price}€</p>
                        <p class="text-blue-600 font-medium">Subtotal: ${itemTotal.toFixed(2)}€</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-2">
                        <div class="flex items-center border rounded">
                            <button class="quantity-decrease px-3 py-1 border-r hover:bg-gray-100" data-id="${product.id}">-</button>
                            <span class="px-3 py-1">${item.quantity}</span>
                            <button class="quantity-increase px-3 py-1 border-l hover:bg-gray-100" data-id="${product.id}">+</button>
                        </div>
                        <button class="delete-button text-red-500 hover:text-red-700" data-id="${product.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;

        cartContent.insertAdjacentHTML("beforeend", itemHTML);
    });

    // Actualizar el total del carrito
    const total = calculateCartTotal(cartItems, products);
    cartTotal.textContent = `${total.toFixed(2)}€`;

    // Añadir eventos a los botones después de que estén en el DOM
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", () => {
            const productId = parseInt(button.getAttribute("data-id"));
            cart.removeFromCart(productId);
            appendCart();
        });
    });

    document.querySelectorAll(".quantity-increase").forEach(button => {
        button.addEventListener("click", () => {
            const productId = parseInt(button.getAttribute("data-id"));
            const item = cartItems.find(item => item.id === productId);
            if (item) {
                updateQuantity(productId, item.quantity + 1);
            }
        });
    });

    document.querySelectorAll(".quantity-decrease").forEach(button => {
        button.addEventListener("click", () => {
            const productId = parseInt(button.getAttribute("data-id"));
            const item = cartItems.find(item => item.id === productId);
            if (item && item.quantity > 1) {
                updateQuantity(productId, item.quantity - 1);
            } else if (item) {
                cart.removeFromCart(productId);
                appendCart();
            }
        });
    });
};

// Añadir eventos a botones de productos
const addProductListeners = async () => {
    const products = await cart.getProducts();
    products.forEach(product => {
        const button = document.getElementById(`product-${product.id}`);
        if (button) {
            button.removeEventListener("click", productClickHandler);
            button.addEventListener("click", productClickHandler);
        }
    });
};

// Manejar click en producto
const productClickHandler = (e) => {
    e.preventDefault();
    const id = e.currentTarget.id.replace("product-", "");
    cart.addToCart(Number(id));
    appendCart();
    toggleCart();
};

// Función para inicializar el store
const initStore = () => {
    // Inicializar el carrito y añadir los listeners
    appendCart();
    addProductListeners();

    // Añadir los eventos de los botones
    const cartButton = document.getElementById("cart-button");
    const mobileCartButton = document.getElementById("cart-button-mb");
    const toggleBtn2 = document.getElementById("toggle-btn-2");
    const toggleBtn = document.getElementById("toggle-btn");
    const searchInput = document.getElementById("search-input");
    const closeCartBtn = document.getElementById("close-cart-button");
    const emptyCartBtn = document.getElementById("empty-cart");

    if (cartButton) {
        cartButton.removeEventListener("click", toggleCart);
        cartButton.addEventListener("click", toggleCart);
    }

    if (mobileCartButton) {
        mobileCartButton.removeEventListener("click", mobileCartHandler);
        mobileCartButton.addEventListener("click", mobileCartHandler);
    }

    if (toggleBtn2) {
        toggleBtn2.removeEventListener("click", closeCartHandler);
        toggleBtn2.addEventListener("click", closeCartHandler);
    }

    if (toggleBtn) {
        toggleBtn.removeEventListener("click", toggleCategoryBox);
        toggleBtn.addEventListener("click", toggleCategoryBox);
    }

    if (searchInput) {
        searchInput.removeEventListener("input", searchProducts);
        searchInput.addEventListener("input", searchProducts);
    }

    if (closeCartBtn) {
        closeCartBtn.removeEventListener("click", closeCart);
        closeCartBtn.addEventListener("click", closeCart);
    }

    if (emptyCartBtn) {
        emptyCartBtn.removeEventListener("click", emptyCart);
        emptyCartBtn.addEventListener("click", emptyCart);
    }
};

// Manejador para el botón de carrito en móvil
const mobileCartHandler = (e) => {
    e.preventDefault();
    document.getElementById("mobile-menu")?.classList.add("hidden");
    toggleCart();
};

// Manejador para cerrar carrito en móvil
const closeCartHandler = () => {
    const cartContainer = document.getElementById("cart-container");
    if (cartContainer) {
        cartContainer.classList.add("opacity-0");
    }
    document.getElementById("mobile-menu")?.classList.toggle("hidden");
    closeCart();
};

// Mostrar/Ocultar categorías
const toggleCategoryBox = () => {
    document.getElementById("category-box")?.classList.toggle("hidden");
};

// Filtrar productos en la tienda
const searchProducts = function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll("#products-container a").forEach(product => {
        product.style.display = product.dataset.productName.toLowerCase().includes(query) ? "" : "none";
    });
};

// Ejecutar en carga inicial y después de cada navegación Turbo Drive
document.addEventListener("turbo:load", initStore);
document.addEventListener("turbo:frame-load", initStore);

initStore();