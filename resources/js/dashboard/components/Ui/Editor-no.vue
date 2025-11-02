<template>
    <ckeditor
        v-model="data"
        :editor="ClassicEditor"
        :config="config"
    />
</template>

<script setup>
import { ref, computed } from 'vue';
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
import { Ckeditor } from '@ckeditor/ckeditor5-vue';

import 'ckeditor5/ckeditor5.css';

const data = ref( '<p>Hello world!</p>' );
 
const config = computed( () => {
    return {
        licenseKey: 'GPL', // Or 'GPL'.
        plugins: [Essentials, Bold, Italic, Font, Paragraph, BlockQuote, Heading, List, Link, MediaEmbed, Underline,  SimpleUploadAdapter, HorizontalLine, AutoImage, ImageInsert, CodeBlock, Autoformat, Alignment],
        language: {
            // The UI will be English.
            ui: 'ar',

            // But the content will be edited in Arabic.
            content: 'ar'
        },
        toolbar: [
                    'bold', 'italic',   '|',
                    'fontBackgroundColor',  
                    'link',
                    '|',
                    'bulletedList',
                    'numberedList',
                    // 'insertImage',
                    // 'imageTextAlternative',
                    // 'toggleImageCaption',
                    // '|',
                    // 'imageStyle:inline',
                    // 'imageStyle:wrapText',
                    // 'imageStyle:breakText',
                    // '|',
                    // 'resizeImage',
    
                ],
     
    };
} );
</script>
