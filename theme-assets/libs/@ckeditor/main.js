import {
    ClassicEditor,
    AutoImage,
    Autosave,
    BlockQuote,
    Bold,
    CloudServices,
    Essentials,
    Heading,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    MediaEmbed,
    Mention,
    Paragraph,
    PasteFromOffice,
    SimpleUploadAdapter,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    Undo,
    Underline
} from 'ckeditor5';

// License key (leave empty if within trial period or replace with your key)
const LICENSE_KEY = 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDc1MjYzOTksImp0aSI6ImQ5MjcyNGZmLWZmMzgtNDZkMC1hYzI5LTI5NGMzZTE0ZWU0MCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImQ2YjIwZWQyIn0.pOwtnlrAAXVK7ND2WKEW-Pa60coAQM1_Lzhr1yzaJhxr2sCZRL8mOdnYAUjlaLaah89W40L1man10zcRPOowwg';

const editorConfig = {
    toolbar: {
        items: [
            'heading', '|',
            'bold', 'italic', 'underline', '|',
            'bulletedList', 'numberedList', '|',
            'link', 'mediaEmbed', 'imageUpload', '|',
            'undo', 'redo'
        ],
        shouldNotGroupWhenFull: false
    },
    plugins: [
        AutoImage,
        Autosave,
        BlockQuote,
        Bold,
        CloudServices,
        Essentials,
        Heading,
        ImageBlock,
        ImageCaption,
        ImageInline,
        ImageInsert,
        ImageInsertViaUrl,
        ImageResize,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List, // Added for bulletedList and numberedList
        MediaEmbed,
        Mention,
        Paragraph,
        PasteFromOffice,
        SimpleUploadAdapter,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        Undo, // Added for undo and redo
        Underline
    ],
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
        ]
    },
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:alignLeft',
            'imageStyle:alignCenter',
            'imageStyle:alignRight',
            '|',
            'resizeImage'
        ],
        resizeOptions: [
            { name: 'resizeImage:original', value: null, label: 'Original' },
            { name: 'resizeImage:25', value: '25', label: '25%' },
            { name: 'resizeImage:50', value: '50', label: '50%' },
            { name: 'resizeImage:75', value: '75', label: '75%' }
        ],
        resizeUnit: '%'
    },
    initialData: '<p></p>',
    licenseKey: LICENSE_KEY,
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        decorators: {
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file'
                }
            }
        }
    },
    mediaEmbed: {
        previewsInData: true
    },
    mention: {
        feeds: [
            {
                marker: '@',
                feed: []
            }
        ]
    },
    placeholder: 'Type or paste your content here!',
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
    }
};

document.addEventListener('DOMContentLoaded', function () {
    ClassicEditor
        .create(document.querySelector('#preparationSteps'), editorConfig)
        .then(editor => {
            window.ckEditorInstance = editor;

            // Add a custom upload adapter for image uploads
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return {
                    upload: () => {
                        return new Promise((resolve, reject) => {
                            const data = new FormData();
                            loader.file.then(file => {
                                data.append('upload', file);
                                $.ajax({
                                    url: '<?= base_url("Recipe/uploadImage") ?>',
                                    type: 'POST',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function (response) {
                                        if (response.uploaded) {
                                            resolve({ default: response.url });
                                        } else {
                                            reject(response.error.message);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        reject('Image upload failed: ' + error);
                                    }
                                });
                            });
                        });
                    }
                };
            };
        })
        .catch(error => {
            console.error('Error initializing CKEditor 5:', error);
        });
});