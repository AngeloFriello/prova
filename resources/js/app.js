import './bootstrap';
import * as bootstrap from 'bootstrap';
import Alpine from 'alpinejs';
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue';

createApp({
}).mount('#app');