<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">المعرض</h2>
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

                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">أضف أعمالك مع صورة ووصف اختياري لكل عنصر</p>
                    <button 
                        @click="addItem"
                        class="btn btn-primary btn-outline"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة عنصر
                    </button>
                </div>

                <div v-if="form.items.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                    </svg>
                    <p>لا توجد عناصر مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة عنصر" لبدء إضافة أعمالك</p>
                </div>

                <div v-else class="space-y-3">
                    <div 
                        v-for="(item, index) in form.items" 
                        :key="item.id || index"
                        :draggable="true"
                        @dragstart="dragStart(index, $event)"
                        @dragover.prevent
                        @dragenter.prevent
                        @drop="drop(index, $event)"
                        class="bg-gray-50 rounded-lg p-4 border border-gray-200 cursor-move hover:bg-gray-100 transition-colors"
                        :class="{ 'opacity-50': draggedIndex === index }"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <!-- Drag Handle -->
                                <div class="cursor-move text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                    </svg>
                                </div>

                                <span class="text-sm font-medium text-gray-600">عنصر {{ index + 1 }}</span>
                                <div class="flex items-center gap-2">
                                    <label class="toggle toggle-lg" :class="{ 'toggle-primary': item.active, 'toggle-secondary': !item.active }">
                                        <input type="checkbox" v-model="item.active" />
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
                            </div>
                            <button 
                                @click="removeItem(index)"
                                class="btn btn-sm btn-outline text-red-600 hover:bg-red-50"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <UiUploadImage 
                                    v-model="item.image"
                                    :name="`items.${index}.image`"
                                    :modelId="form.id"
                                    mediaCollection="portfolio"
                                    :preview="item.image_url || ''"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الوصف (اختياري)</label>
                                <input 
                                    v-model="item.caption"
                                    type="text"
                                    class="input w-full"
                                    placeholder="وصف قصير للعنصر"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`items.${index}.caption`] }"
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors[`items.${index}.caption`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`items.${index}.caption`][0] }}
                                </span>
                            </div>
                        </div>

                        <!-- Preview
                        <div v-if="item.image" class="mt-3 p-3 bg-white rounded border">
                            <div class="flex items-start gap-3">
                                <img :src="item.image" alt="portfolio item" class="w-24 h-24 object-cover rounded border" />
                                <div class="flex-1">
                                    <div class="font-medium text-gray-800 mb-1">{{ item.caption || 'صورة بدون وصف' }}</div>
                                    <a :href="item.image" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">فتح الصورة</a>
                                </div>
                            </div>
                        </div>
                         -->
                    </div>
                </div>

                <div class="flex justify-end w-full pt-4">
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ المعرض</span>
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
import UiUploadImage from '../Ui/UploadImage.vue'

const errorsStore = useErrorsStore()

const form = ref({
    id: null,
    active: true,
    items: []
})

const loading = ref(false)
const formLoading = ref(false)
const draggedIndex = ref(null)

onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/portfolio').then(response => {
        form.value = response.data.data
        // Items already have proper structure from API
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addItem = () => {
    form.value.items.push({
        id: null, // Will be set by server when created
        image: '',
        image_url: '',
        caption: '',
        active: true,
        sort: form.value.items.length
    })
}

const removeItem = (index) => {
    form.value.items.splice(index, 1)
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
    
    // Reorder items
    const draggedItem = form.value.items[draggedIndex.value]
    
    // Remove from original position
    form.value.items.splice(draggedIndex.value, 1)
    
    // Insert at new position
    form.value.items.splice(dropIndex, 0, draggedItem)
    
    // Update sort for all items
    form.value.items.forEach((item, index) => {
        item.sort = index
    })
    
    // Reset drag state
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/portfolio', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Update form with response data to get proper IDs
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


