<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">المميزات</h2>
                    <button 
                        @click="addFeature"
                        class="btn btn-primary btn-outline"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة ميزة
                    </button>
                </div>

                <div v-if="form.features.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>لا توجد مميزات مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة ميزة" لبدء إضافة المميزات</p>
                </div>

                <div v-else class="space-y-3">
                    <div 
                        v-for="(feature, index) in form.features" 
                        :key="feature.id || index"
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
                                
                                <button 
                                    class="btn btn-xs btn-ghost"
                                    @click="toggleCollapse(index)"
                                    :aria-expanded="!collapsed[index]"
                                    :aria-controls="`feature-panel-${index}`"
                                >
                                    <svg v-if="collapsed[index]" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832l-3.71 3.938a.75.75 0 11-1.08-1.04l4.24-4.5a.75.75 0 011.08 0l4.24 4.5c.28.297.27.765-.02 1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <span class="text-sm font-medium text-gray-600">ميزة {{ index + 1 }}</span>
                                <div class="flex items-center gap-2">
                                    <label class="toggle toggle-lg" :class="{ 'toggle-primary': feature.active, 'toggle-secondary': !feature.active }">
                                        <input type="checkbox" v-model="feature.active" />
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
                                @click="removeFeature(index)"
                                class="btn btn-sm btn-outline text-red-600 hover:bg-red-50"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div :id="`feature-panel-${index}`" v-show="!collapsed[index]" class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الأيقونة</label>
                                <input 
                                    v-model="feature.icon" 
                                    type="text" 
                                    class="input w-full"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`features.${index}.icon`] }"
                                    placeholder="مثال: ⭐ أو 🚀 أو 📱"
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors[`features.${index}.icon`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`features.${index}.icon`][0] }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">يمكنك استخدام الرموز التعبيرية أو أي نص كأيقونة</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
                                <input 
                                    v-model="feature.title" 
                                    type="text" 
                                    class="input w-full font-medium"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`features.${index}.title`] }"
                                    placeholder="اكتب عنوان الميزة هنا..."
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors[`features.${index}.title`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`features.${index}.title`][0] }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الوصف</label>
                                <textarea 
                                    v-model="feature.description" 
                                    class="textarea w-full resize-none"
                                    rows="3"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`features.${index}.description`] }"
                                    placeholder="اكتب وصف الميزة هنا..."
                                ></textarea>
                                <span v-if="errorsStore.errors && errorsStore.errors[`features.${index}.description`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`features.${index}.description`][0] }}
                                </span>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div v-if="feature.icon && feature.title && feature.description" class="mt-3 p-3 bg-white rounded border">
                            <div class="flex items-center gap-2 text-sm mb-2">
                                <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                <span class="font-medium">معاينة الميزة</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="text-2xl">{{ feature.icon }}</div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-800 mb-1">{{ feature.title }}</div>
                                    <div class="text-sm text-gray-600">{{ feature.description }}</div>
                                </div>
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
                        <span v-if="!formLoading">حفظ المميزات</span>
                        <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted, watch } from 'vue'
import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

const form = ref({
    features: []
})

const loading = ref(false)
const formLoading = ref(false)
const collapsed = ref([])
const draggedIndex = ref(null)
const COLLAPSE_STORAGE_KEY = 'dashboard.features_block.collapsed'
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/features').then(response => {
        form.value = response.data.data
        // Add IDs to existing features if they don't have them
        form.value.features = form.value.features.map((feature, index) => ({
            ...feature,
            id: feature.id || Date.now() + index
        }))
        // load collapsed state from localStorage and align lengths
        try {
            const saved = JSON.parse(localStorage.getItem(COLLAPSE_STORAGE_KEY) || '[]')
            const len = form.value.features.length
            collapsed.value = Array.from({ length: len }, (_, i) => Boolean(saved[i] ?? false))
        } catch (e) {
            collapsed.value = form.value.features.map(() => false)
        }
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addFeature = () => {
    form.value.features.push({
        id: Date.now(), // Add unique ID for better drag and drop
        icon: '',
        title: '',
        description: '',
        active: true
    })
    collapsed.value.push(false)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const removeFeature = (index) => {
    form.value.features.splice(index, 1)
    collapsed.value.splice(index, 1)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const toggleCollapse = (index) => {
    collapsed.value[index] = !collapsed.value[index]
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
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
    
    // Reorder features
    const draggedFeature = form.value.features[draggedIndex.value]
    const draggedCollapsed = collapsed.value[draggedIndex.value]
    
    // Remove from original position
    form.value.features.splice(draggedIndex.value, 1)
    collapsed.value.splice(draggedIndex.value, 1)
    
    // Insert at new position
    form.value.features.splice(dropIndex, 0, draggedFeature)
    collapsed.value.splice(dropIndex, 0, draggedCollapsed)
    
    // Update localStorage
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
    
    // Reset drag state
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/features', form.value).then(response => {
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

// persist whenever collapsed changes in length/content
watch(collapsed, (val) => {
    try { localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(val)) } catch (e) {}
}, { deep: true })
</script>
 