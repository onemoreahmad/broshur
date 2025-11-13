<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6"  xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M3 10.4167C3 7.21907 3 5.62028 3.37752 5.08241C3.75503 4.54454 5.25832 4.02996 8.26491 3.00079L8.83772 2.80472C10.405 2.26824 11.1886 2 12 2C12.8114 2 13.595 2.26824 15.1623 2.80472L15.7351 3.00079C18.7417 4.02996 20.245 4.54454 20.6225 5.08241C21 5.62028 21 7.21907 21 10.4167C21 10.8996 21 11.4234 21 11.9914C21 17.6294 16.761 20.3655 14.1014 21.5273C13.38 21.8424 13.0193 22 12 22C10.9807 22 10.62 21.8424 9.89856 21.5273C7.23896 20.3655 3 17.6294 3 11.9914C3 11.4234 3 10.8996 3 10.4167Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M11.5 16H12.5C13.0523 16 13.5 15.5523 13.5 15V13.5987C14.3967 13.0799 15 12.1104 15 11C15 9.34315 13.6569 8 12 8C10.3431 8 9 9.34315 9 11C9 12.1104 9.6033 13.0799 10.5 13.5987V15C10.5 15.5523 10.9477 16 11.5 16Z" stroke="#1C274C" stroke-width="1.5" stroke-linejoin="round"></path> </g></svg>

                        الاتفاقية وسياسة الخصوصية
                    </h2>
                    
                </div> 
                
                <UiAlert>
                    الاتفاقية وسياسة الخصوصية، يمكنك تحرير البنود لتوضيح آليات العمل وسياسة الخدمة والإستبدال لعملائك.
                </UiAlert>

                <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

                <section v-if="form.active" class="flex flex-col gap-1"> 
                    <UiInput name="agreement_title" label="عنوان الاتفاقية" v-model="form.agreement_title" placeholder="مثال: اتفاقية الاستخدام" />
                    
                    <UiEditor name="text" 
                       
                        v-model="form.agreement_content" 
                        placeholder="اكتب محتوى اتفاقية الاستخدام هنا..." 
                        media-collection="block-editor-images" 
                        model-type="block" 
                        :model-id="form.id" 
                        :toolbar="
                        [
                            'heading', '|', 'bold', 'italic', 'underline', '|',
                            'fontColor', 'fontBackgroundColor', 'alignment',
                            'link',
                            '|',
                            'mediaEmbed',
                            'insertImage',
                            '|',
                           
                            'bulletedList',
                            'numberedList',

                            'blockQuote',
                          
                            '|',
                            'codeBlock',
                            '|',
                            'horizontalLine',
                        ]"
                    />
                
                </section>
          
                
                <div class="flex justify-end w-full">
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ</span>
                        <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                    </button>
                </div>
               
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useErrorsStore } from '@/stores/errors'
import { useNotification } from "@kyvg/vue3-notification";

const { notify }  = useNotification()
const errorsStore = useErrorsStore()

const form = ref({
    agreement_title: '',
    agreement_content: '',  
    active: true,
})

const loading = ref(false)
const formLoading = ref(false)
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/agreement').then(response => {
        form.value = response.data.data
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/agreement', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }

        notify({ type: "success", text: "تم حفظ التعديلات بنجاح" });
        
    }) 
    .catch(error => {
        console.error(error.response.data.errors)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
            notify({ type: "error", text: "حدث خطأ ما، الرجاء تصحيح المعلومات و حاول مرة أخرى" });
        }
    })
}
</script>

