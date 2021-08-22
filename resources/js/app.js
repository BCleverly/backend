require('./bootstrap');

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

import flatpickr from "flatpickr";
document
    .querySelectorAll('.datetime')
    .forEach(element => flatpickr(element, {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
            time_24hr: true
        })
    );

import EditorJS from '@editorjs/editorjs';
const editor = new EditorJS();