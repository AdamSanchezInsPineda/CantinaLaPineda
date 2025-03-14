import './bootstrap';
import './cartController';
import './controllers/checkoutController';
import Alpine from 'alpinejs';
import * as Turbo from "@hotwired/turbo";

window.Alpine = Alpine;

Alpine.start();

Turbo.start();
