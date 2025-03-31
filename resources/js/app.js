import './bootstrap';
import './controllers/storeController';
import './controllers/checkoutController';
import Alpine from 'alpinejs';
import * as Turbo from "@hotwired/turbo";

window.Alpine = Alpine;

Alpine.start();

Turbo.start();

document.addEventListener("turbo:load", () => {
    // Iconos de lucide
    const lucide = window.lucide
    lucide.createIcons()
  
    // Sidebar en mobil
    const sidebarToggle = document.getElementById("sidebar-toggle")
    const sidebarClose = document.getElementById("sidebar-close")
    const mobileSidebar = document.getElementById("mobile-sidebar")
  
    if (sidebarToggle && mobileSidebar) {
      sidebarToggle.addEventListener("click", () => {
        mobileSidebar.classList.remove("-translate-x-full")
      })
    }
  
    if (sidebarClose && mobileSidebar) {
      sidebarClose.addEventListener("click", () => {
        mobileSidebar.classList.add("-translate-x-full")
      })
    }
  
    // Close sidebar when clicking outside
    document.addEventListener("click", (e) => {
      if (mobileSidebar && !mobileSidebar.contains(e.target) && sidebarToggle && !sidebarToggle.contains(e.target)) {
        mobileSidebar.classList.add("-translate-x-full")
      }
    })
  })