import './bootstrap';

import Alpine from 'alpinejs';

// import 'tom-select/dist/css/tom-select.min.css';

import TomSelect from 'tom-select';
document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('tom-select');

    if (selectElement) {
        new TomSelect(selectElement, {
            plugins: ['remove_button']
        });
    }
});

window.Alpine = Alpine;

Alpine.start();
