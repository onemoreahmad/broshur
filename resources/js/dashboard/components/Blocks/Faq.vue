<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-lg font-semibold text-gray-800">الأسئلة الشائعة</h2>
                    <div class="flex items-center gap-3">
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
                        <button 
                            @click="addFaq"
                            class="btn btn-primary btn-outline"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            إضافة سؤال
                        </button>
                    </div>
                </div>

                <div v-if="form.faqs.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>لا توجد أسئلة مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة سؤال" لبدء إضافة الأسئلة الشائعة</p>
                </div>

                <div v-else class="space-y-3">
                    <div 
                        v-for="(faq, index) in form.faqs" 
                        :key="faq.id || index"
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
                                    :aria-controls="`faq-panel-${index}`"
                                >
                                    <svg v-if="collapsed[index]" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832l-3.71 3.938a.75.75 0 11-1.08-1.04l4.24-4.5a.75.75 0 011.08 0l4.24 4.5c.28.297.27.765-.02 1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <span class="text-sm font-medium text-gray-600">سؤال {{ index + 1 }}</span>
                                <div class="flex items-center gap-2">
                                    <label class="toggle toggle-lg" :class="{ 'toggle-primary': faq.active, 'toggle-secondary': !faq.active }">
                                        <input type="checkbox" v-model="faq.active" />
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
                                @click="removeFaq(index)"
                                class="btn btn-sm btn-outline text-red-600 hover:bg-red-50"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div :id="`faq-panel-${index}`" v-show="!collapsed[index]" class="space-y-3">
                            <div>
                                <input 
                                    v-model="faq.question" 
                                    type="text" 
                                    class="input w-full font-medium"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`faqs.${index}.question`] }"
                                    placeholder="اكتب السؤال هنا..."
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors[`faqs.${index}.question`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`faqs.${index}.question`][0] }}
                                </span>
                            </div>

                            <div>
                                <textarea 
                                    v-model="faq.answer" 
                                    class="textarea w-full resize-none"
                                    rows="4"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`faqs.${index}.answer`] }"
                                    placeholder="اكتب الإجابة هنا..."
                                ></textarea>
                                <span v-if="errorsStore.errors && errorsStore.errors[`faqs.${index}.answer`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`faqs.${index}.answer`][0] }}
                                </span>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div v-if="faq.question && faq.answer" class="mt-3 p-3 bg-white rounded border">
                            <div class="flex items-center gap-2 text-sm mb-2">
                                <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                <span class="font-medium">معاينة السؤال</span>
                            </div>
                            <div class="text-sm">
                                <div class="font-medium text-gray-800 mb-1">{{ faq.question }}</div>
                                <div class="text-gray-600">{{ faq.answer }}</div>
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
                        <span v-if="!formLoading">حفظ الأسئلة</span>
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
    id: null,
    active: true,
    faqs: []
})

const loading = ref(false)
const formLoading = ref(false)
const collapsed = ref([])
const draggedIndex = ref(null)
const COLLAPSE_STORAGE_KEY = 'dashboard.faq_block.collapsed'
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/faq').then(response => {
        form.value = response.data.data
        // Add IDs to existing FAQs if they don't have them
        form.value.faqs = form.value.faqs.map((faq, index) => ({
            ...faq,
            id: faq.id || Date.now() + index
        }))
        // load collapsed state from localStorage and align lengths
        try {
            const saved = JSON.parse(localStorage.getItem(COLLAPSE_STORAGE_KEY) || '[]')
            const len = form.value.faqs.length
            collapsed.value = Array.from({ length: len }, (_, i) => Boolean(saved[i] ?? false))
        } catch (e) {
            collapsed.value = form.value.faqs.map(() => false)
        }
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addFaq = () => {
    form.value.faqs.push({
        id: Date.now(), // Add unique ID for better drag and drop
        question: '',
        answer: '',
        active: true
    })
    collapsed.value.push(false)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const removeFaq = (index) => {
    form.value.faqs.splice(index, 1)
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
    
    // Reorder FAQs
    const draggedFaq = form.value.faqs[draggedIndex.value]
    const draggedCollapsed = collapsed.value[draggedIndex.value]
    
    // Remove from original position
    form.value.faqs.splice(draggedIndex.value, 1)
    collapsed.value.splice(draggedIndex.value, 1)
    
    // Insert at new position
    form.value.faqs.splice(dropIndex, 0, draggedFaq)
    collapsed.value.splice(dropIndex, 0, draggedCollapsed)
    
    // Update localStorage
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
    
    // Reset drag state
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/faq', form.value).then(response => {
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

// persist whenever collapsed changes in length/content
watch(collapsed, (val) => {
    try { localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(val)) } catch (e) {}
}, { deep: true })
</script>
 