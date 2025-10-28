<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-6">
                <h2 class="text-lg font-semibold text-gray-800">أزرار التواصل</h2>

                <!-- WhatsApp Button Section -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800">زر واتساب</h3>
                        </div>
                        <label class="toggle toggle-lg" :class="{ 'toggle-primary': form.whatsapp_enabled, 'toggle-secondary': !form.whatsapp_enabled }">
                            <input type="checkbox" v-model="form.whatsapp_enabled" />
                            <svg aria-label="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" stroke="currentColor">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </g>
                            </svg>
                        </label>
                    </div>

                    <div v-if="form.whatsapp_enabled" class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">رقم واتساب</label>
                            <input 
                                v-model="form.whatsapp_number"
                                type="tel" 
                                class="input w-full"
                                dir="ltr"
                                placeholder="+966501234567"
                                :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['whatsapp_number'] }"
                            />
                            <span v-if="errorsStore.errors && errorsStore.errors['whatsapp_number']" class="text-red-500 text-xs">
                                {{ errorsStore.errors['whatsapp_number'][0] }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">الرسالة الافتراضية (اختيارية)</label>
                            <textarea 
                                v-model="form.whatsapp_message"
                                class="textarea w-full resize-none"
                                rows="3"
                                placeholder="مرحباً، أريد الاستفسار عن..."
                                :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['whatsapp_message'] }"
                            ></textarea>
                            <span v-if="errorsStore.errors && errorsStore.errors['whatsapp_message']" class="text-red-500 text-xs">
                                {{ errorsStore.errors['whatsapp_message'][0] }}
                            </span>
                        </div>

                        <!-- WhatsApp Preview -->
                        <div v-if="form.whatsapp_number" class="p-3 bg-white rounded border">
                            <div class="flex items-center gap-2 text-sm mb-2">
                                <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                                <span class="font-medium">زر واتساب</span>
                            </div>
                            <a 
                                :href="`https://wa.me/${form.whatsapp_number.replace(/[^0-9]/g, '')}${form.whatsapp_message ? '?text=' + encodeURIComponent(form.whatsapp_message) : ''}`" 
                                target="_blank" 
                                class="text-green-600 hover:text-green-800 text-sm"
                            >
                                {{ form.whatsapp_number }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Button Section -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800">زر التواصل</h3>
                        </div>
                        <label class="toggle toggle-lg" :class="{ 'toggle-primary': form.contact_enabled, 'toggle-secondary': !form.contact_enabled }">
                            <input type="checkbox" v-model="form.contact_enabled" />
                            <svg aria-label="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" stroke="currentColor">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </g>
                            </svg>
                        </label>
                    </div>

                    <div v-if="form.contact_enabled" class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                            <input 
                                v-model="form.contact_email"
                                type="email" 
                                class="input w-full"
                                dir="ltr"
                                placeholder="contact@example.com"
                                :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['contact_email'] }"
                            />
                            <span v-if="errorsStore.errors && errorsStore.errors['contact_email']" class="text-red-500 text-xs">
                                {{ errorsStore.errors['contact_email'][0] }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">موضوع الرسالة الافتراضي (اختياري)</label>
                            <input 
                                v-model="form.contact_subject"
                                type="text" 
                                class="input w-full"
                                placeholder="استفسار من الموقع"
                                :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['contact_subject'] }"
                            />
                            <span v-if="errorsStore.errors && errorsStore.errors['contact_subject']" class="text-red-500 text-xs">
                                {{ errorsStore.errors['contact_subject'][0] }}
                            </span>
                        </div>

                        <!-- Contact Preview -->
                        <div v-if="form.contact_email" class="p-3 bg-white rounded border">
                            <div class="flex items-center gap-2 text-sm mb-2">
                                <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                <span class="font-medium">زر التواصل</span>
                            </div>
                            <a 
                                :href="`mailto:${form.contact_email}${form.contact_subject ? '?subject=' + encodeURIComponent(form.contact_subject) : ''}`" 
                                class="text-blue-600 hover:text-blue-800 text-sm"
                            >
                                {{ form.contact_email }}
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end w-full pt-4">
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ الإعدادات</span>
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

const errorsStore = useErrorsStore()

const form = ref({
    whatsapp_enabled: false,
    whatsapp_number: '',
    whatsapp_message: '',
    contact_enabled: false,
    contact_email: '',
    contact_subject: ''
})

const loading = ref(false)
const formLoading = ref(false)
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/cta').then(response => {
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
 
    axios.post('/api/blocks/cta', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error(error.response.data.errors)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
        }
    })
}
</script>
 