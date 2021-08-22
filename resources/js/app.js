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
import Header from '@editorjs/header';
import List from '@editorjs/nested-list';
import ImageTool from '@editorjs/image';
import Underline from '@editorjs/underline';
import Marker from '@editorjs/marker';
import Hyperlink from 'editorjs-hyperlink';
const Table = require('editorjs-table');
import Undo from 'editorjs-undo';
import DragDrop from 'editorjs-drag-drop';
import Embed from '@editorjs/embed';

// https://github.com/codex-team/editor.js/issues/836 - multi col

window.EditorJS = EditorJS;
document
    .querySelectorAll('.editorjs')
    .forEach(element => {
        let data = JSON.parse(element.previousElementSibling.value || '{}');
        const editor = new EditorJS({
            holder: element,
            data: data,
            placeholder: "Let's get writing...",
            onReady: () => {
                const undo = new Undo({ editor });
                undo.initialize(data);
                new DragDrop(editor);
            },
            /**
             * @param {api}.saver
             */
            onChange({saver}) {
                saver
                    .save()
                    .then(output => this.holder.previousElementSibling.value = JSON.stringify(output))
                    .catch((error) => {
                        console.log('Saving failed: ', error)
                    });
            },
            tools: {
                embed: {
                    class: Embed,
                    inlineToolbar: true,
                    config: {
                        services: {
                            youtube: true,
                        }
                    }
                },
                header: Header,
                list: {
                    class: List,
                    inlineToolbar: true,
                },
                underline: Underline,
                Marker: {
                    class: Marker,
                    shortcut: 'CMD+SHIFT+M'
                },
                table: {
                    class: Table,
                    inlineToolbar: true,
                    config: {
                        rows: 2,
                        cols: 3,
                    },
                },
                hyperlink: {
                    class: Hyperlink,
                    config: {
                        shortcut: 'CMD+L',
                        target: '_blank',
                        rel: 'nofollow',
                        availableTargets: ['_blank', '_self'],
                        availableRels: ['author', 'noreferrer'],
                        validate: false,
                    }
                },
                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: element.previousElementSibling.dataset.imageupload,
                            byUrl: element.previousElementSibling.dataset.imageupload,
                        },
                        additionalRequestHeaders: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }
                }
            },

        });
    })
