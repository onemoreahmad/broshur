<template>
    <div class="">

        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>

            <!-- Header with Active Toggle -->
            <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                        <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                            <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C22 8.34315 22 10.2288 22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M12 17.3333C13.1046 17.3333 14 16.5871 14 15.6667C14 14.7462 13.1046 14 12 14C10.8954 14 10 13.2538 10 12.3333C10 11.4129 10.8954 10.6667 12 10.6667M12 17.3333C10.8954 17.3333 10 16.5871 10 15.6667M12 17.3333V18M12 10V10.6667M12 10.6667C13.1046 10.6667 14 11.4129 14 12.3333" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                            الخدمات
                        </h2>
                </div>
            

            <UiAlert>
                قائمة الخدمات الرئيسية، يمكنك إضافة أكثر من خدمة لعرضها لعملائك المحتملين.
            </UiAlert>

            <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

            <section v-if="form.active" class="flex flex-col gap-1">
                
                <div class="grid grid-cols-1 gap-1">
                    <UiInput name="title" label="عنوان القسم" v-model="form.title" placeholder="مثال: خدماتنا" />  
                    <UiInput name="subtitle" label="العنوان الفرعي" v-model="form.subtitle" placeholder="مثال: تعرف على خدماتنا المميزة" />
                </div>

                <div class="divider text-xs">قائمة الخدمات</div>

            <!-- Empty State -->
            <div v-if="form.services.length === 0" class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <p class="text-lg font-medium mb-2">لا توجد خدمات بعد</p>
                <p class="text-sm text-gray-400">أضف الخدمات لإظهارها في موقعك</p>
            </div>

            <!-- Services List -->
            <div v-else class="space-y-4 mt-5">
                <div 
                    v-for="(service, index) in form.services" 
                    :key="service.id || index"
                    class="bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-all"
                    draggable="true"
                    @dragstart="dragStart(index, $event)"
                    @dragover.prevent
                    @drop="drop(index, $event)"
                >
                    <!-- Service Header -->
                    <div class="flex items-center justify-between mb-3">
                             <span class="text-sm font-medium text-gray-600">خدمة #{{ index + 1 }}</span>

                            <div class="flex items-center gap-2">
                                <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                <button @click="removeService(index)" class="btn btn-xs btn-soft btn-error">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                       
                    </div>

                    <UiToggle :name="`services.${index}.active`" label="تفعيل الخدمة" v-model="service.active" />

                    <!-- Service Form -->
                    <div v-if="service.active" :id="`service-panel-${index}`" class="mt-1 grid grid-cols-1 gap-1">
                        <UiInput :name="`services.${index}.name`" label="اسم الخدمة" v-model="service.name" placeholder="اسم الخدمة" />
                        <UiInput :name="`services.${index}.subtitle`" label="العنوان الفرعي" v-model="service.subtitle" placeholder="العنوان الفرعي للخدمة" />
                        <UiIcon :name="`services.${index}.icon`" label="الأيقونة" v-model="service.icon"  />
                        <UiUploadImage 
                            v-model="service.image"
                            :name="`services.${index}.image`"
                            :modelId="form.id"
                            mediaCollection="services"
                            :preview="service.image_url || ''"
                            @upload-start="imageUploadingCount++"
                            @upload-end="imageUploadingCount--"
                        />

                        <!--
                        <UiTextarea :name="`services.${index}.detail`" label="تفاصيل الخدمة" v-model="service.detail" placeholder="تفاصيل الخدمة" />
                        <UiInput :name="`services.${index}.price`" label="السعر" v-model="service.price" type="number" step="0.01" min="0" placeholder="0.00" />
                        -->
                        <!-- Addons Section -->
                        <!--
                        <div class="mt-3 border-t pt-3">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-sm font-medium text-gray-700">الإضافات</label>
                                <button 
                                    @click="addAddon(index)"
                                    type="button"
                                    class="btn btn-xs btn-primary btn-outline"
                                >
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    إضافة
                                </button>
                            </div>
                            -->
                            <!-- Addons List -->
                            <!--
                            <div v-if="service.addons && service.addons.length > 0" class="space-y-2 mt-2">
                                <div 
                                    v-for="(addon, addonIndex) in service.addons" 
                                    :key="addon.id || addonIndex"
                                    class="bg-base-100 rounded p-2 border border-base-200 flex items-center gap-2"
                                >
                                    <div class="flex-1 grid grid-cols-2 gap-2">
                                        <UiInput 
                                            :name="`services.${index}.addons.${addonIndex}.name`" 
                                            label="الإضافة" 
                                            v-model="addon.name" 
                                            placeholder="اسم الإضافة"
                                            class="text-sm"
                                        />
                                        <UiInput 
                                            :name="`services.${index}.addons.${addonIndex}.price`" 
                                            label="السعر" 
                                            v-model="addon.price" 
                                            type="number" 
                                            step="0.01"
                                            min="0" 
                                            placeholder="0.00"
                                            class="text-sm"
                                        />
                                    </div>
                                    <button 
                                        @click="removeAddon(index, addonIndex)"
                                        type="button"
                                        class="btn btn-xs btn-soft btn-error"
                                    >
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div v-else class="text-sm text-gray-400 text-center py-2">
                                لا توجد إضافات
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>

            <!-- Add Service Button -->
        
                <button 
                    @click="addService"
                    class="btn btn-primary btn-outline w-full mt-2"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة خدمة
                </button>
            

            </section>
            <div class="flex justify-end w-full pt-6">
                <button 
                    @click="save" 
                    class="btn btn-primary" 
                    :disabled="formLoading || imageUploadingCount > 0"
                > 
                    <span v-if="!formLoading && imageUploadingCount === 0">حفظ الخدمات</span>
                    <span v-else class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useErrorsStore } from '@/stores/errors'
import axios from 'axios'
import { useNotification } from "@kyvg/vue3-notification";
import UiUploadImage from '../Ui/UploadImage.vue'

const { notify }  = useNotification()

const errorsStore = useErrorsStore()
const formLoading = ref(false)
const loading = ref(false)
const draggedIndex = ref(null)
const imageUploadingCount = ref(0)


const form = ref({
    id: null,
    active: false,
    title: '',
    subtitle: '',
    services: []
})

onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/services').then(response => {
        form.value = response.data.data
        // Ensure addons is always an array and icon is properly initialized
        if (form.value.services) {
            form.value.services.forEach(service => {
                if (!service.addons || !Array.isArray(service.addons)) {
                    service.addons = []
                }
                // Ensure icon field exists
                if (service.icon === undefined) {
                    service.icon = null
                }
            })
        }
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addService = () => {
    form.value.services.push({
        id: null, // Will be set by server when created
        name: '',
        subtitle: '',
        detail: '',
        price: null,
        icon: 'Versions',
        image: null,
        image_url: '',
        active: true,
        sort: form.value.services.length,
        addons: []
    })
}

const removeService = (index) => {
    form.value.services.splice(index, 1)
}

const addAddon = (serviceIndex) => {
    if (!form.value.services[serviceIndex].addons) {
        form.value.services[serviceIndex].addons = []
    }
    form.value.services[serviceIndex].addons.push({
        id: null,
        name: '',
        price: 0,
        active: true,
        sort: form.value.services[serviceIndex].addons.length
    })
}

const removeAddon = (serviceIndex, addonIndex) => {
    form.value.services[serviceIndex].addons.splice(addonIndex, 1)
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
    
    const draggedItem = form.value.services[draggedIndex.value]
    form.value.services.splice(draggedIndex.value, 1)
    form.value.services.splice(dropIndex, 0, draggedItem)
    
    // Update sort order
    form.value.services.forEach((service, index) => {
        service.sort = index
    })
    
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
    
    axios.post('/api/blocks/services', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        notify({
            title: 'تم حفظ الخدمات بنجاح',
            type: 'success'
        })
        // Update form with response data to get proper IDs
        form.value = response.data.data
        // Ensure addons is always an array and icon is properly initialized
        if (form.value.services) {
            form.value.services.forEach(service => {
                if (!service.addons || !Array.isArray(service.addons)) {
                    service.addons = []
                }
                // Ensure icon field exists
                if (service.icon === undefined) {
                    service.icon = null
                }
            })
        }
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error('Error saving services:', error.response?.data?.errors || error.message)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
        }
        notify({
            title: 'حدث خطأ ما',
            type: 'error'
        })
    })
}
</script>

