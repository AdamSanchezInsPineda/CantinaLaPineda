export default class Cart {
    constructor() {
        this.storage = sessionStorage;
        this.cartKey = "cart";
        this.productsKey = "products_cache";
        this.cacheTimeKey = "products_cache_time";
        this.cacheTTL = 5 * 60 * 1000;
    }

    async fetchProducts() {
        try {
            const response = await fetch("/products/all");
            if (!response.ok) throw new Error("Error al obtener productos");
            const products = await response.json();

            this.storage.setItem(this.productsKey, JSON.stringify(products));
            this.storage.setItem(this.cacheTimeKey, Date.now().toString());
            console.log("⚡ Productos actualizados desde el servidor.");
            return products;
        } catch (error) {
            console.error("Error al obtener productos:", error);
            return [];
        }
    }

    async checkForUpdates() {
        try {
            const response = await fetch("/products/version");
            if (!response.ok) throw new Error("Error obteniendo versión");

            const { last_updated_at } = await response.json();
            const cachedVersion = this.storage.getItem("products_version");

            if (cachedVersion !== last_updated_at) {
                console.log("⚡ Productos han cambiado, actualizando...");
                this.storage.setItem("products_version", last_updated_at);
                return await this.fetchProducts();
            }
65
            console.log("✅ Caché aún válida.");
            this.storage.setItem(this.cacheTimeKey, Date.now().toString());
            return JSON.parse(this.storage.getItem(this.productsKey)) || [];
        } catch (error) {
            console.error("Error al verificar actualizaciones:", error);
            return JSON.parse(this.storage.getItem(this.productsKey)) || [];
        }
    }

    async getProducts() {
        const cacheTime = parseInt(this.storage.getItem(this.cacheTimeKey)) || 0;
        const now = Date.now();

        if (now - cacheTime > this.cacheTTL) {
            console.log("⚡ Caché expirada, verificando con el servidor...");
            return await this.checkForUpdates();
        }

        return JSON.parse(this.storage.getItem(this.productsKey)) || [];
    }

    getCart() {
        return JSON.parse(this.storage.getItem(this.cartKey)) || [];
    }

    addToCart(productId, quantity = 1) {
        let cart = this.getCart();

        let existingItem = cart.find(item => item.productId === productId);

        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({ productId, quantity });
        }

        this.storage.setItem(this.cartKey, JSON.stringify(cart));
        console.log("Carrito actualizado:", cart);
    }

    removeFromCart(productId) {
        let cart = this.getCart();
        cart = cart.filter(item => item.productId !== productId);
        this.storage.setItem(this.cartKey, JSON.stringify(cart));
        console.log("Producto eliminado. Carrito actualizado:", cart);
    }

    async checkout(token) {
        let cart = this.getCart();

        if (cart.length === 0) {
            console.log("El carrito está vacío");
            return;
        }

        try {
            const response = await fetch("/checkout", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify({ cart })
            });

            if (!response.ok) {
                throw new Error("Error en el checkout");
            }

            const data = await response.json();
            console.log("Compra realizada:", data);

            this.storage.removeItem(this.cartKey);
        } catch (error) {
            console.error("Error al hacer checkout:", error);
        }
    }
}
