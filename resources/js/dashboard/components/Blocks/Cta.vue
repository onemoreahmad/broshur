<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-6">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2"> 
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.70399 3.5H17.5C18.9045 3.5 19.6067 3.5 20.1111 3.83706C20.3295 3.98298 20.517 4.17048 20.6629 4.38886C21 4.89331 21 5.59554 21 7C21 8.40446 21 9.10669 20.6629 9.61114C20.517 9.82952 20.3295 10.017 20.1111 10.1629C19.6067 10.5 18.9045 10.5 17.5 10.5H6.70399C6.04642 10.5 5.71764 10.5 5.41593 10.4018C5.28282 10.3585 5.15463 10.3013 5.03346 10.2312C4.75882 10.0723 4.53915 9.8277 4.09981 9.33844C3.24911 8.39107 2.82376 7.91738 2.72136 7.36381C2.67687 7.12331 2.67687 6.87669 2.72136 6.63619C2.82376 6.08262 3.24911 5.60894 4.09981 4.66156C4.53915 4.1723 4.75882 3.92767 5.03346 3.76879C5.15463 3.6987 5.28282 3.64152 5.41593 3.5982C5.71764 3.5 6.04642 3.5 6.70399 3.5Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M17.296 12.5H6.5C5.09554 12.5 4.39331 12.5 3.88886 12.8371C3.67048 12.983 3.48298 13.1705 3.33706 13.3889C3 13.8933 3 14.5955 3 16C3 17.4045 3 18.1067 3.33706 18.6111C3.48298 18.8295 3.67048 19.017 3.88886 19.1629C4.39331 19.5 5.09554 19.5 6.5 19.5H17.296C17.9536 19.5 18.2824 19.5 18.5841 19.4018C18.7172 19.3585 18.8454 19.3013 18.9665 19.2312C19.2412 19.0723 19.4608 18.8277 19.9002 18.3384C20.7509 17.3911 21.1762 16.9174 21.2786 16.3638C21.3231 16.1233 21.3231 15.8767 21.2786 15.6362C21.1762 15.0826 20.7509 14.6089 19.9002 13.6616C19.4608 13.1723 19.2412 12.9277 18.9665 12.7688C18.8454 12.6987 18.7172 12.6415 18.5841 12.5982C18.2824 12.5 17.9536 12.5 17.296 12.5Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M12.75 2C12.75 1.58579 12.4142 1.25 12 1.25C11.5858 1.25 11.25 1.58579 11.25 2H12.75ZM12.75 11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11H12.75ZM12.75 20C12.75 19.5858 12.4142 19.25 12 19.25C11.5858 19.25 11.25 19.5858 11.25 20H12.75ZM14 22.75C14.4142 22.75 14.75 22.4142 14.75 22C14.75 21.5858 14.4142 21.25 14 21.25V22.75ZM10 21.25C9.58579 21.25 9.25 21.5858 9.25 22C9.25 22.4142 9.58579 22.75 10 22.75V21.25ZM11.25 2V3H12.75V2H11.25ZM11.25 11V12H12.75V11H11.25ZM11.25 20V22H12.75V20H11.25ZM14 21.25H10V22.75H14V21.25Z" fill="#1C274C"></path> </g></svg>
                        أزرار التواصل
                    </h2>
                    <label class="toggle toggle-lg" :class="{ 'toggle-primary': form.active, 'toggle-secondary': !form.active }">
                        <input type="checkbox" v-model="form.active" />
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

                <!-- CTA Buttons List -->
                <div class="space-y-3">
                    <div 
                        v-for="(button, index) in sortedButtons" 
                        :key="button.type"
                        :draggable="true"
                        @dragstart="dragStart(index, $event)"
                        @dragover.prevent
                        @dragenter.prevent
                        @drop="drop(index, $event)"
                        class="bg-gray-50 rounded-lg p-4 border border-gray-200 cursor-move hover:bg-gray-100 transition-colors"
                        :class="{ 'opacity-50': draggedIndex === index }"
                    >
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <!-- Drag Handle -->
                                <div class="flex flex-col items-center gap-1">
                                    <svg 
                                        class="w-5 h-5 text-gray-400 cursor-grab active:cursor-grabbing" 
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                    </svg>
                                    <span class="text-xs text-gray-400 hidden">{{ index + 1 }}</span>
                                </div>

                                <!-- WhatsApp Button -->
                                <div v-if="button.type === 'whatsapp'" class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-800">زر واتساب</h3>
                                </div>

                                <!-- Contact Button -->
                                <div v-if="button.type === 'contact'" class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-800">زر التواصل</h3>
                                </div>
                            </div>

                            <label class="toggle toggle-lg" :class="{ 
                                'toggle-primary': button.enabled, 
                                'toggle-secondary': !button.enabled 
                            }">
                                <input 
                                    type="checkbox" 
                                    v-model="button.enabled" 
                                    @change="updateButtonEnabled(button.type, button.enabled)"
                                />
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

                        <!-- WhatsApp Fields -->
                        <div v-if="button.type === 'whatsapp' && form.whatsapp_enabled" class="space-y-3">
                            <label class="input w-full focus-within:ring-offset-0">
                                <span class="label">رقم الهاتف</span>
                                <input 
                                    v-model="form.whatsapp_number"
                                    type="tel" 
                                    class="w-full"
                                    dir="ltr"
                                    placeholder="+966501234567"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['whatsapp_number'] }"
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors['whatsapp_number']" class="text-red-500 text-xs">
                                    {{ errorsStore.errors['whatsapp_number'][0] }}
                                </span>
                            </label>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الرسالة الافتراضية (اختيارية)</label>
                                <textarea 
                                    v-model="form.whatsapp_message"
                                    class="textarea w-full"
                                    rows="3"
                                    placeholder="مرحباً، أريد الاستفسار عن..."
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['whatsapp_message'] }"
                                ></textarea>
                                <span v-if="errorsStore.errors && errorsStore.errors['whatsapp_message']" class="text-red-500 text-xs">
                                    {{ errorsStore.errors['whatsapp_message'][0] }}
                                </span>
                            </div>
                        </div>

                        <!-- Contact Fields -->
                        <div v-if="button.type === 'contact' && form.contact_enabled" class="space-y-3">
                            <label class="input w-full focus-within:ring-offset-0">
                                <span class="label">البريد الإلكتروني</span>
                                <input 
                                    v-model="form.contact_email"
                                    type="email" 
                                    class="w-full"
                                    dir="ltr"
                                    placeholder="contact@example.com"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors['contact_email'] }"
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors['contact_email']" class="text-red-500 text-xs">
                                    {{ errorsStore.errors['contact_email'][0] }}
                                </span>
                            </label>

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
import { ref, onMounted, computed } from 'vue'
import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

const form = ref({
    active: true,
    whatsapp_enabled: false,
    whatsapp_number: '',
    whatsapp_message: '',
    whatsapp_sort: 1,
    contact_enabled: false,
    contact_email: '',
    contact_subject: '',
    contact_sort: 2
})

const loading = ref(false)
const formLoading = ref(false)
const draggedIndex = ref(null)

// Computed to get buttons as array sorted by sort value
const sortedButtons = computed(() => {
    const buttons = [
        {
            type: 'whatsapp',
            enabled: form.value.whatsapp_enabled,
            number: form.value.whatsapp_number,
            message: form.value.whatsapp_message,
            sort: form.value.whatsapp_sort || 1
        },
        {
            type: 'contact',
            enabled: form.value.contact_enabled,
            email: form.value.contact_email,
            subject: form.value.contact_subject,
            sort: form.value.contact_sort || 2
        }
    ]
    return buttons.sort((a, b) => a.sort - b.sort)
})
 
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

// Update form when toggle changes
const updateButtonEnabled = (buttonType, enabled) => {
    if (buttonType === 'whatsapp') {
        form.value.whatsapp_enabled = enabled
    } else if (buttonType === 'contact') {
        form.value.contact_enabled = enabled
    }
}

// Drag and Drop Functions
const dragStart = (index, event) => {
    draggedIndex.value = index
    event.dataTransfer.effectAllowed = 'move'
    event.dataTransfer.setData('text/html', event.target.outerHTML)
}

const drop = (dropIndex, event) => {
    event.preventDefault()
    
    if (draggedIndex.value === null || draggedIndex.value === dropIndex) {
        draggedIndex.value = null
        return
    }
    
    const buttons = [...sortedButtons.value]
    const draggedButton = buttons[draggedIndex.value]
    const dropButton = buttons[dropIndex]
    
    // Swap sort values in form directly
    const tempSort = draggedButton.sort
    const newDraggedSort = dropButton.sort
    const newDropSort = tempSort
    
    // Update form values directly
    if (draggedButton.type === 'whatsapp') {
        form.value.whatsapp_sort = newDraggedSort
    } else {
        form.value.contact_sort = newDraggedSort
    }
    
    if (dropButton.type === 'whatsapp') {
        form.value.whatsapp_sort = newDropSort
    } else {
        form.value.contact_sort = newDropSort
    }
    
    // Reset drag state
    draggedIndex.value = null
}

const save = () => {
    // Update form from buttons before saving (in case any changes were made)
    sortedButtons.value.forEach(button => {
        if (button.type === 'whatsapp') {
            form.value.whatsapp_enabled = button.enabled
            form.value.whatsapp_number = button.number
            form.value.whatsapp_message = button.message
        } else if (button.type === 'contact') {
            form.value.contact_enabled = button.enabled
            form.value.contact_email = button.email
            form.value.contact_subject = button.subject
        }
    })
    
    formLoading.value = true;
 
    axios.post('/api/blocks/cta', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Update form with response data
        form.value = response.data.data
        
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
 