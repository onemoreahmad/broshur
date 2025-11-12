<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2"> 
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.70399 3.5H17.5C18.9045 3.5 19.6067 3.5 20.1111 3.83706C20.3295 3.98298 20.517 4.17048 20.6629 4.38886C21 4.89331 21 5.59554 21 7C21 8.40446 21 9.10669 20.6629 9.61114C20.517 9.82952 20.3295 10.017 20.1111 10.1629C19.6067 10.5 18.9045 10.5 17.5 10.5H6.70399C6.04642 10.5 5.71764 10.5 5.41593 10.4018C5.28282 10.3585 5.15463 10.3013 5.03346 10.2312C4.75882 10.0723 4.53915 9.8277 4.09981 9.33844C3.24911 8.39107 2.82376 7.91738 2.72136 7.36381C2.67687 7.12331 2.67687 6.87669 2.72136 6.63619C2.82376 6.08262 3.24911 5.60894 4.09981 4.66156C4.53915 4.1723 4.75882 3.92767 5.03346 3.76879C5.15463 3.6987 5.28282 3.64152 5.41593 3.5982C5.71764 3.5 6.04642 3.5 6.70399 3.5Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M17.296 12.5H6.5C5.09554 12.5 4.39331 12.5 3.88886 12.8371C3.67048 12.983 3.48298 13.1705 3.33706 13.3889C3 13.8933 3 14.5955 3 16C3 17.4045 3 18.1067 3.33706 18.6111C3.48298 18.8295 3.67048 19.017 3.88886 19.1629C4.39331 19.5 5.09554 19.5 6.5 19.5H17.296C17.9536 19.5 18.2824 19.5 18.5841 19.4018C18.7172 19.3585 18.8454 19.3013 18.9665 19.2312C19.2412 19.0723 19.4608 18.8277 19.9002 18.3384C20.7509 17.3911 21.1762 16.9174 21.2786 16.3638C21.3231 16.1233 21.3231 15.8767 21.2786 15.6362C21.1762 15.0826 20.7509 14.6089 19.9002 13.6616C19.4608 13.1723 19.2412 12.9277 18.9665 12.7688C18.8454 12.6987 18.7172 12.6415 18.5841 12.5982C18.2824 12.5 17.9536 12.5 17.296 12.5Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M12.75 2C12.75 1.58579 12.4142 1.25 12 1.25C11.5858 1.25 11.25 1.58579 11.25 2H12.75ZM12.75 11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11H12.75ZM12.75 20C12.75 19.5858 12.4142 19.25 12 19.25C11.5858 19.25 11.25 19.5858 11.25 20H12.75ZM14 22.75C14.4142 22.75 14.75 22.4142 14.75 22C14.75 21.5858 14.4142 21.25 14 21.25V22.75ZM10 21.25C9.58579 21.25 9.25 21.5858 9.25 22C9.25 22.4142 9.58579 22.75 10 22.75V21.25ZM11.25 2V3H12.75V2H11.25ZM11.25 11V12H12.75V11H11.25ZM11.25 20V22H12.75V20H11.25ZM14 21.25H10V22.75H14V21.25Z" fill="#1C274C"></path> </g></svg>
                        أزرار الإجراءات
                    </h2>
                    
                </div>

                <UiAlert>
                    أزرار الإجراءات 
                    هي الطريقة التي يتفاعل بها عميلك مع صفحتك،
                    يمكنك تفعيل زر التواصل على الواتس اب أو  اتصل بنا، 
                    أو زر الاشتراك في قائمتنا البريدية أو حجز وشراء خدمة.
                </UiAlert>

                <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

                <section v-if="form.active" class="flex flex-col gap-1">
                        
                    
                    
                    
                <div class="divider text-xs">قائمة أزرار الإجراءات</div>
                <!-- CTA Buttons List -->
                <div class="space-y-3 mt-5">
                    <div 
                        v-for="(button, index) in sortedButtons" 
                        :key="button.type"
                        :draggable="true"
                        @dragstart="dragStart(index, $event)"
                        @dragover.prevent
                        @dragenter.prevent
                        @drop="drop(index, $event)"
                        class=" bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-colors"
                        :class="{ 'opacity-50': draggedIndex === index }"
                    >
                        <div hidden class="flex items-center justify-between mb-4">
                      
                                <div class="flex items-center gap-1">
                                    <svg 
                                        class="w-5 h-5 text-gray-400 cursor-grab active:cursor-grabbing" 
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                    </svg>
                                    <span class="text-xs text-gray-400">#{{ index + 1 }}</span>
                                </div>
   
                        </div>
                        <UiToggle name="enabled" :label="button.label" v-model="button.enabled" @change="updateButtonEnabled(button.type, button.enabled)"  />

                        <!-- WhatsApp Fields -->
                        <div v-if="button.type === 'whatsapp' && form.whatsapp_enabled" class="space-y-1 mt-1">
                            <UiInput name="whatsapp_number" label="رقم الهاتف" v-model="form.whatsapp_number" placeholder="+966501234567"  />
                            <!-- <UiTextarea name="whatsapp_message" label="الرسالة الافتراضية" v-model="form.whatsapp_message" placeholder="مرحباً، أريد الاستفسار عن..." /> -->
                        </div>

                        <!-- Subscription Fields -->
                        <div v-if="button.type === 'subscription' && form.subscription_enabled" class="space-y-1 mt-1">
                            <UiTextarea name="subscription_message" label="رسالة الاشتراك" v-model="form.subscription_message" placeholder="مرحباً، اشترك ليصلك كل جديد"  />
                        </div>

                        <!-- Contact Fields 
                        <div v-if="button.type === 'contact' && form.contact_enabled" class="space-y-1 mt-1">
                            <UiInput name="contact_email" label="البريد الإلكتروني" v-model="form.contact_email" placeholder="contact@example.com"  />
                            <UiTextarea name="contact_subject" label="موضوع الرسالة الافتراضية" v-model="form.contact_subject" placeholder="استفسار من الموقع"  />
                        </div>
                        -->
                    </div>
                </div>

                <div class="divider text-xs">الروابط المخصصة</div>
                <!-- Custom Links List -->
                <div v-if="form.custom_links.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <p>لا توجد روابط مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة رابط" لبدء إضافة الروابط</p>
                </div>

                <div v-else class="space-y-3 mt-5">
                    <div 
                        v-for="(link, index) in form.custom_links" 
                        :key="`link-${link.id || index}`"
                        :draggable="true"
                        @dragstart="handleDragStart($event, index)"
                        @dragover.prevent="handleDragOver($event, index)"
                        @dragenter.prevent="handleDragEnter($event, index)"
                        @dragleave="handleDragLeave($event, index)"
                        @drop="handleDrop($event, index)"
                        @dragend="handleDragEnd($event)"
                        :class="[
                            'bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-all',
                            dragOverIndex === index ? 'border-blue-500 bg-blue-50' : '',
                            draggedIndex === index ? 'opacity-50' : ''
                        ]"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-medium text-gray-600">{{ link.label || 'رابط جديد' }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                <button @click="removeCustomLink(index)" class="btn btn-xs btn-soft btn-error">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <UiToggle :name="`custom_links.${index}.active`" label="تفعيل الرابط" v-model="link.active" />
 
                        <div v-if="link.active" class="mt-1 flex flex-col gap-1">
                            <UiInput :name="`custom_links.${index}.url`" label="الرابط" v-model="link.url" placeholder="https://example.com"  />
                            <UiInput :name="`custom_links.${index}.label`" label="مسمى الرابط" v-model="link.label" placeholder="مسمى الرابط (اختياري)"  />
                        </div>
                    </div>
                </div>
                
                <button 
                        @click="addCustomLink"
                        class="btn btn-primary btn-outline w-full mt-2"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة رابط
                    </button>
                </section>
                
                <div class="flex justify-end w-full pt-6">
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ </span>
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
import { useNotification } from '@kyvg/vue3-notification'

const errorsStore = useErrorsStore()
const { notify } = useNotification()

const form = ref({
    active: true,
    whatsapp_enabled: false,
    whatsapp_number: '',
    // whatsapp_message: '',
    whatsapp_sort: 1,
    contact_enabled: false,
    // contact_email: '',
    // contact_subject: '',
    contact_sort: 2,
    subscription_enabled: false,
    subscription_message: '',
    subscription_sort: 3,
    custom_links: []
})

const loading = ref(false)
const formLoading = ref(false)
const draggedIndex = ref(null)
const dragOverIndex = ref(null)

// Computed to get buttons as array sorted by sort value
const sortedButtons = computed(() => {
    const buttons = [
        {
            type: 'whatsapp',
            label: 'زر محادثة واتساب',
            enabled: form.value.whatsapp_enabled,
            number: form.value.whatsapp_number,
            // message: form.value.whatsapp_message,
            sort: form.value.whatsapp_sort || 1
        },
        {
            type: 'contact',
            label: 'زر التواصل',
            enabled: form.value.contact_enabled,
            // email: form.value.contact_email,
            // subject: form.value.contact_subject,
            sort: form.value.contact_sort || 2
        },
        {
            type: 'subscription',
            label: 'زر الاشتراك',
            enabled: form.value.subscription_enabled,
            message: form.value.subscription_message,
            sort: form.value.subscription_sort || 3
        }
    ]
    return buttons.sort((a, b) => a.sort - b.sort)
})
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/cta').then(response => {
        form.value = response.data.data
        // Ensure custom_links is always an array
        if (!form.value.custom_links || !Array.isArray(form.value.custom_links)) {
            form.value.custom_links = []
        }
        if (typeof form.value.subscription_message !== 'string') {
            form.value.subscription_message = ''
        }
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
    } else if (buttonType === 'subscription') {
        form.value.subscription_enabled = enabled
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
    } else if (draggedButton.type === 'contact') {
        form.value.contact_sort = newDraggedSort
    } else if (draggedButton.type === 'subscription') {
        form.value.subscription_sort = newDraggedSort
    }
    
    if (dropButton.type === 'whatsapp') {
        form.value.whatsapp_sort = newDropSort
    } else if (dropButton.type === 'contact') {
        form.value.contact_sort = newDropSort
    } else if (dropButton.type === 'subscription') {
        form.value.subscription_sort = newDropSort
    }
    
    // Reset drag state
    draggedIndex.value = null
}

// Custom links functions
const addCustomLink = () => {
    form.value.custom_links.push({
        id: null,
        url: '',
        label: '',
        active: true,
        sort: form.value.custom_links.length
    })
}

const removeCustomLink = (index) => {
    form.value.custom_links.splice(index, 1)
}

// Drag and drop handlers for custom links
const handleDragStart = (event, index) => {
    draggedIndex.value = index
    event.dataTransfer.effectAllowed = 'move'
    event.dataTransfer.setData('text/html', index)
}

const handleDragOver = (event, index) => {
    if (draggedIndex.value === null) return
    if (draggedIndex.value !== index) {
        dragOverIndex.value = index
    }
}

const handleDragEnter = (event, index) => {
    if (draggedIndex.value === null) return
    if (draggedIndex.value !== index) {
        dragOverIndex.value = index
    }
}

const handleDragLeave = (event, index) => {
    // Only remove highlight if we're leaving the element (not entering a child)
    if (!event.currentTarget.contains(event.relatedTarget)) {
        if (dragOverIndex.value === index) {
            dragOverIndex.value = null
        }
    }
}

const handleDrop = (event, dropIndex) => {
    event.preventDefault()
    
    if (draggedIndex.value === null || draggedIndex.value === dropIndex) {
        dragOverIndex.value = null
        return
    }

    const dragIndex = draggedIndex.value
    
    // Move the link in the array
    const linkToMove = form.value.custom_links[dragIndex]
    
    // Remove from old position
    form.value.custom_links.splice(dragIndex, 1)
    
    // Insert at new position
    form.value.custom_links.splice(dropIndex, 0, linkToMove)
    
    // Update sort values
    form.value.custom_links.forEach((link, index) => {
        link.sort = index
    })
    
    dragOverIndex.value = null
    draggedIndex.value = null
}

const handleDragEnd = (event) => {
    draggedIndex.value = null
    dragOverIndex.value = null
}

const save = () => {
    // Update form from buttons before saving (in case any changes were made)
    sortedButtons.value.forEach(button => {
        if (button.type === 'whatsapp') {
            form.value.whatsapp_enabled = button.enabled
            form.value.whatsapp_number = button.number
            // form.value.whatsapp_message = button.message
        } else if (button.type === 'contact') {
            form.value.contact_enabled = button.enabled
            // form.value.contact_email = button.email
            // form.value.contact_subject = button.subject
        } else if (button.type === 'subscription') {
            form.value.subscription_enabled = button.enabled
            form.value.subscription_message = button.message
        }
    })
    
    // Ensure custom_links is always sent (even if empty array)
    if (!form.value.custom_links) {
        form.value.custom_links = []
    }
    
    formLoading.value = true;
 
    axios.post('/api/blocks/cta', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Update form with response data
        form.value = response.data.data
        // Ensure custom_links is always an array
        if (!form.value.custom_links || !Array.isArray(form.value.custom_links)) {
            form.value.custom_links = []
        }
        
        notify({ type: "success", text: "تم حفظ أزرار الإجراءات بنجاح" })
        
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
            notify({ type: "error", text: "فشل حفظ أزرار الإجراءات" })
        } else {
            notify({ type: "error", text: "حدث خطأ ما، الرجاء المحاولة مرة أخرى" })
        }
    })
}
</script>
 