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

// Renderizar carrito
const appendCart = async () => {
    const cartContent = document.getElementById("cart-content");
    if (!cartContent) return;

    cartContent.innerHTML = "";

    const cartItems = cart.getCart();
    const products = await cart.getProducts();

    const cartHTML = products
        .map(product => {
            const foundItem = cartItems.find(item => item.productId === product.id);
            if (!foundItem) return "";
            return `
                <div class="flex justify-between items-center">
                    <img class="w-20" src="${product.images ? "/storage/" + product.images[0] : "https://via.placeholder.com/150"}">
                    <div class="flex flex-col justify-between gap-5">
                        <p>${product.name}</p>
                        <p>Precio: ${(product.price * foundItem.quantity).toFixed(2)}€</p>
                    </div>
                    <p>Cantidad: ${foundItem.quantity}</p>
                </div>
            `;
        })
        .join("");

    cartContent.innerHTML = cartHTML;

    if (cartContent.hasChildNodes()) {
        cartContent.innerHTML += `<div class="flex justify-center"><a href="/checkout">Pagar</a></div>`;
    }
};

// Añadir eventos a botones de productos
const addProductListeners = async () => {
    const products = await cart.getProducts();
    products.forEach(product => {
        const button = document.getElementById(`product-${product.id}`);
        if (button) {
            button.removeEventListener("click", productClickHandler); // Eliminar el evento anterior
            button.addEventListener("click", productClickHandler); // Añadir el nuevo
        }
    });
};

// Manejar click en producto
const productClickHandler = (e) => {
    e.preventDefault();
    const productId = e.currentTarget.id.replace("product-", "");
    cart.addToCart(Number(productId));
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