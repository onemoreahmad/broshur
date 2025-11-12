<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.3357 5.47875L7.36344 9.00968C5.79482 10.404 5.0105 11.1012 5.0105 11.9993C5.0105 12.8975 5.79481 13.5946 7.36344 14.989L11.3357 18.5199C12.0517 19.1563 12.4098 19.4746 12.7049 19.342C13.0001 19.2095 13.0001 18.7305 13.0001 17.7725V15.4279C16.6001 15.4279 20.5001 17.1422 22.0001 19.9993C22.0001 10.8565 16.6668 8.57075 13.0001 8.57075V6.22616C13.0001 5.26817 13.0001 4.78917 12.7049 4.65662C12.4098 4.52407 12.0517 4.8423 11.3357 5.47875Z" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.5" d="M8.46129 4.5L3.24509 9.34362C2.45098 10.081 1.99976 11.1158 1.99976 12.1994C1.99976 13.3418 2.50097 14.4266 3.37087 15.1671L8.46129 19.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        الروابط الاجتماعية
                    </h2>
                     
                </div>

                <UiAlert>
                    روابط حساباتك الإجتماعية، 
                    كما يمكنك إضافة روابط مخصصة أخرى.
                </UiAlert>
                <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

                <section v-if="form.active" class="flex flex-col gap-1">

                <div class="divider text-xs">قائمة الروابط</div>

                <div v-if="form.links.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <p>لا توجد روابط مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة رابط" لبدء إضافة الروابط</p>
                </div>

                <div v-else class="space-y-3 mt-5">
                    <div 
                        v-for="(link, index) in form.links" 
                        :key="`link-${link.id || index}`"
                        :draggable="true"
                        @dragstart="handleDragStart($event, index)"
                        @dragover.prevent="handleDragOver($event, index)"
                        @dragenter.prevent="handleDragEnter($event, index)"
                        @dragleave="handleDragLeave($event, index)"
                        @drop="handleDrop($event, index)"
                        @dragend="handleDragEnd($event)"
                        :class="[
                            'bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-colors transition-all',
                            dragOverIndex === index ? 'border-blue-500 bg-blue-50' : '',
                            draggedIndex === index ? 'opacity-50' : ''
                        ]"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div hidden class="flex flex-col items-center gap-1">
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
                                <button 
                                    hidden
                                    class="btn btn-xs btn-ghost"
                                    @click="toggleCollapse(index)"
                                    :aria-expanded="!collapsed[index]"
                                    :aria-controls="`link-panel-${index}`"
                                >
                                    <svg v-if="collapsed[index]" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                                    <svg v-else class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832l-3.71 3.938a.75.75 0 11-1.08-1.04l4.24-4.5a.75.75 0 011.08 0l4.24 4.5c.28.297.27.765-.02 1.06z" clip-rule="evenodd" /></svg>
                                </button>
                                <span class="text-sm font-medium text-gray-600"> {{ link.network || 'رابط جديد' }}</span>
                                <div class="flex items-center gap-2">
 
                                </div>
 
                            </div>
 
                            <div class="flex items-center gap-2">
                                <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                <button @click="removeLink(index)" class="btn btn-xs btn-soft btn-error">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <UiToggle :name="`links.${index}.active`" label="تفعيل الرابط" v-model="link.active" />
 
                        <div v-if="link.active" :id="`link-panel-${index}`" XXv-show="!collapsed[index]" class="mt-1 flex flex-col gap-1">
                            <UiField label="المنصة" :name="`links.${index}.network`">
                                <select 
                                    v-model="link.network" 
                                    class="select w-full"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`links.${index}.network`] }"
                                >
                                    <option value="">اختر المنصة</option>
                                    <option value="facebook">فيسبوك</option>
                                    <option value="x">X (تويتر)</option>
                                    <option value="instagram">إنستغرام</option>
                                    <option value="linkedin">لينكد إن</option>
                                    <option value="youtube">يوتيوب</option>
                                    <option value="tiktok">تيك توك</option>
                                    <option value="snapchat">سناب شات</option>
                                    <option value="whatsapp">واتساب</option>
                                    <option value="telegram">تيليجرام</option>
                                    <option value="discord">ديسكورد</option>
                                    <option value="github">جيت هاب</option>
                                    <option value="website">موقع إلكتروني</option>
                                    <option value="other">أخرى</option>
                                </select>
                                <span v-if="errorsStore.errors && errorsStore.errors[`links.${index}.network`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`links.${index}.network`][0] }}
                                </span>
                            </UiField>
                            <UiInput :name="`links.${index}.url`" label="الرابط" v-model="link.url" placeholder="https://example.com"  />
                            <UiInput :name="`links.${index}.label`" label="مسمى الرابط" v-model="link.label" placeholder="مسمى الرابط (اختياري)"  />
 
                        </div>
 
 
                    </div>
                </div>
                
                <button 
                        @click="addLink"
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
                        <span v-if="!formLoading">حفظ الروابط</span>
                        <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted, watch, useId } from 'vue'
import { useErrorsStore } from '@/stores/errors'
import { useNotification } from '@kyvg/vue3-notification'

const errorsStore = useErrorsStore()
const { notify } = useNotification()

const form = ref({
    id: null,
    active: true,
    links: []
})

const loading = ref(false)
const formLoading = ref(false)
const collapsed = ref([])
const COLLAPSE_STORAGE_KEY = 'dashboard.links_block.collapsed'

// Drag and drop state
const draggedIndex = ref(null)
const dragOverIndex = ref(null)
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/links').then(response => {
        form.value = response.data.data
        // load collapsed state from localStorage and align lengths
        try {
            const saved = JSON.parse(localStorage.getItem(COLLAPSE_STORAGE_KEY) || '[]')
            const len = response.data.data.links.length
            collapsed.value = Array.from({ length: len }, (_, i) => Boolean(saved[i] ?? false))
        } catch (e) {
            collapsed.value = response.data.data.links.map(() => false)
        }
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addLink = () => {
    form.value.links.push({
        id: null, // Will be set by server when created
        url: '',
        network: '',
        label: '',
        active: true,
        sort: form.value.links.length
    })
    collapsed.value.push(false)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const removeLink = (index) => {
    form.value.links.splice(index, 1)
    collapsed.value.splice(index, 1)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const getNetworkLabel = (network) => {
    const labels = {
        'facebook': 'فيسبوك',
        'x': 'X (تويتر)',
        'instagram': 'إنستغرام',
        'linkedin': 'لينكد إن',
        'youtube': 'يوتيوب',
        'tiktok': 'تيك توك',
        'snapchat': 'سناب شات',
        'whatsapp': 'واتساب',
        'telegram': 'تيليجرام',
        'discord': 'ديسكورد',
        'github': 'جيت هاب',
        'website': 'موقع إلكتروني',
        'other': 'أخرى'
    }
    return labels[network] || network
}

const save = () => {
    formLoading.value = true;
    
    // Debug: Log the form data being sent
    console.log('Saving links with data:', form.value);
 
    axios.post('/api/blocks/links', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Debug: Log the response
        console.log('Links saved successfully:', response.data);
        
        // Update form with response data to get proper IDs
        form.value = response.data.data
        
        notify({ type: "success", text: "تم حفظ الروابط الاجتماعية بنجاح" })
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error('Error saving links:', error.response?.data?.errors || error.message)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
            notify({ type: "error", text: "فشل حفظ الروابط الاجتماعية" })
        } else {
            notify({ type: "error", text: "حدث خطأ ما، الرجاء المحاولة مرة أخرى" })
        }
    })
}

const toggleCollapse = (index) => {
    collapsed.value[index] = !collapsed.value[index]
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

// Drag and drop handlers
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
    const linkToMove = form.value.links[dragIndex]
    const collapsedStateToMove = collapsed.value[dragIndex]
    
    // Remove from old position
    form.value.links.splice(dragIndex, 1)
    collapsed.value.splice(dragIndex, 1)
    
    // Insert at new position
    form.value.links.splice(dropIndex, 0, linkToMove)
    collapsed.value.splice(dropIndex, 0, collapsedStateToMove)
    
    // Update sort values
    form.value.links.forEach((link, index) => {
        link.sort = index
    })
    
    dragOverIndex.value = null
    draggedIndex.value = null
    
    // Update collapsed state in localStorage
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const handleDragEnd = (event) => {
    draggedIndex.value = null
    dragOverIndex.value = null
}

// persist whenever collapsed changes in length/content
watch(collapsed, (val) => {
    try { localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(val)) } catch (e) {}
}, { deep: true })
</script>
 