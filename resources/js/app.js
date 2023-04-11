import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collect from 'collect.js';
import iziToast from 'izitoast';
import Swal from 'sweetalert2';

window.iziToast = iziToast;
window.Swal = Swal;
window.Alpine = Alpine;
window.collect = collect;
Alpine.plugin(focus);
Alpine.start();