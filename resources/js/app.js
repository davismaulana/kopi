import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

window.Swal = Swal; // Make it globally available

window.Alpine = Alpine;

Alpine.start();
