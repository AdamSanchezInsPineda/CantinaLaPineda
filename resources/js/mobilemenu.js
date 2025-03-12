document.getElementById('toggle-btn-2').addEventListener('click', function() {
    const cartContainer = document.getElementById("cart");
    cartContainer.classList.add("hidden");
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileMenu.classList.toggle('hidden');
});