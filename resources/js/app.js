import './bootstrap';

import Alpine from 'alpinejs';

import 'font-awesome/css/font-awesome.min.css';

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
    '/resources/fonts/**',
    '/resources/image/**',
])
