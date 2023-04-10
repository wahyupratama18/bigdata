import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collect from 'collect.js';

window.Alpine = Alpine;
window.collect = collect;
Alpine.plugin(focus);
Alpine.start();
