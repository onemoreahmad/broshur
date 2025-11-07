<template>
    <UiField :name="name" :label="label">
        <textarea ref="ckeditor" dir="auto" placeholder="اكتب شيئاً .. " class="w-fullx !whitespace-pre-wrap" v-model="model"></textarea>

    </UiField>
</template>

<script setup>
import { computed, useTemplateRef, onMounted } from 'vue'

// ckeditor5

import {
    ClassicEditor,
    Essentials,
    Bold,
    Italic,
    Font,
    Paragraph,
    BlockQuote,
    Heading,
    List,
    Link,
    Image,
    ImageCaption,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    ImageInsert,
    MediaEmbed,
    SimpleUploadAdapter,
    Underline,
    SourceEditing,
    Markdown,
    Autoformat,
    PasteFromMarkdownExperimental,
    HorizontalLine,
    AutoImage,
    CodeBlock,
    Alignment,
} from "ckeditor5";

import "ckeditor5/ckeditor5.css";

import coreTranslations from "ckeditor5/translations/ar.js";



const ckeditor = useTemplateRef('ckeditor')

const editorConfig = computed(() => ({
    placeholder: props.placeholder ?? '',
    plugins: [Essentials, Bold, Italic, Font, Paragraph, BlockQuote, Heading, List, Link, MediaEmbed, Underline, Image, ImageUpload, ImageResize, ImageStyle, ImageToolbar, ImageCaption, SimpleUploadAdapter, HorizontalLine, AutoImage, ImageInsert, CodeBlock, Autoformat, Alignment],
                language: {
                    // The UI will be English.
                    ui: 'ar',

                    // But the content will be edited in Arabic.
                    content: 'ar'
                },
                translations: [
                    coreTranslations,
                ],
                toolbar: {
                    items: props.toolbar,
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: '' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'h1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'h2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'h3' },
                    ]
                },
                image: {
                    resizeOptions: [{
                            name: 'resizeImage:original',
                            label: 'Default image width',
                            value: null,
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50% page width',
                            value: '50',
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75% page width',
                            value: '75',
                        },
                    ],
                    toolbar: [

                        'imageTextAlternative',
                        'toggleImageCaption',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                        '|',
                        'resizeImage',
                    ],
                },
                mediaEmbed: {
                    previewsInData: true,
                },
                simpleUpload: {
                    // The URL that the images are uploaded to.
                    uploadUrl: '/admin/upload-media',

                    // Enable the XMLHttpRequest.withCredentials property.
                    withCredentials: true,

                    // Headers sent along with the XMLHttpRequest to the upload server.
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,

                        modelType: props.modelType,
                        modelId: props.modelId,
                        mediaCollection: props.mediaCollection,
                    },
                },
            })) 

onMounted(() => {
    ClassicEditor.create(ckeditor.value, editorConfig.value).then(editor => {
        editor.model.document.on('change:data', () => {
            model.value = editor.getData()
        })
    })
    // editor.model.document.on('change:data', () => {
    //     model.value = editor.getData()
    // })
})


const model = defineModel()

const props = defineProps({
    name: String,
    label: String,
    placeholder: String,
    toolbar: Array,
    modelType: String,
    modelId: Number,
    mediaCollection: String,
})
 

</script>


<style>
.ck-editor__main{
    white-space: pre-wrap;
}
.ck-content h1{
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    margin-top: 1rem;
}
.ck-content h2{
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    margin-top: 1rem;
}
.ck-content h3{
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    margin-top: 1rem;
}
.ck-content ul, .ck-content ol{
 
    margin-right: 2rem;
}
.ck-content ul ul, .ck-content ol ol{
    margin-right: 2rem;
}
.ck-content ul ul ul, .ck-content ol ol ol{
    margin-right: 2rem;
}

.ck.ck-reset_all,
.ck-reset_all *:not(.ck-reset_all-excluded *) {
    --tw-text-opacity: 1;
    color: #4b5563;

}

.ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
.ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
    color: #313842;
}
</style>