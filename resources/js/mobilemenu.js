document.getElementById('toggle-btn-2').addEventListener('click', function() {
    const cartContainer = document.getElementById("cart-container");
    cartContainer.classList.add("opacity-0");
    const mobileMenu = document.getElementById('mobile-menu');

    const cartDom = document.getElementById("cart");

    cartDom.classList.add("-translate-y-full", "opacity-0", "pointer-events-none");
    cartDom.classList.remove("translate-y-0", "opacity-100");
    
    mobileMenu.classList.toggle('hidden');
});