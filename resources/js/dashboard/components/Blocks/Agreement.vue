<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        الاتفاقية وسياسة الخصوصية
                    </h2>
                    
                </div> 
                
                <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

                <section v-if="form.active" class="flex flex-col gap-4"> 
                    <!-- Agreement Section -->
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-x-2">
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 22L2 22" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M21 22V6C21 4.11438 21 3.17157 20.4143 2.58579C19.8285 2 18.8857 2 17 2H15C13.1144 2 12.1716 2 11.5858 2.58579C11.1143 3.05733 11.0223 3.76022 11.0044 5" stroke="#1C274C" stroke-width="1.5"></path> <path d="M15 22V9C15 7.11438 15 6.17157 14.4142 5.58579C13.8284 5 12.8856 5 11 5H7C5.11438 5 4.17157 5 3.58579 5.58579C3 6.17157 3 7.11438 3 9V22" stroke="#1C274C" stroke-width="1.5"></path> <path d="M9 22V19" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 8H12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 11H12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 14H12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                            اتفاقية الاستخدام
                        </h3>
                        <UiInput name="agreement_title" label="عنوان الاتفاقية" v-model="form.agreement_title" placeholder="مثال: اتفاقية الاستخدام" />
                        <UiTextarea name="agreement_content" label="محتوى الاتفاقية" v-model="form.agreement_content" placeholder="اكتب محتوى اتفاقية الاستخدام هنا..." />
                    </div>

                    <!-- Privacy Section -->
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-x-2">
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M2 12H4M20 12H22M12 2V4M12 20V22" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                            سياسة الخصوصية
                        </h3>
                        <UiInput name="privacy_title" label="عنوان سياسة الخصوصية" v-model="form.privacy_title" placeholder="مثال: سياسة الخصوصية" />
                        <UiTextarea name="privacy_content" label="محتوى سياسة الخصوصية" v-model="form.privacy_content" placeholder="اكتب محتوى سياسة الخصوصية هنا..." />
                    </div>
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
    privacy_title: '',
    privacy_content: '',
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

