<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M10.125 8.875C10.125 7.83947 10.9645 7 12 7C13.0355 7 13.875 7.83947 13.875 8.875C13.875 9.56245 13.505 10.1635 12.9534 10.4899C12.478 10.7711 12 11.1977 12 11.75V13" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="12" cy="16" r="1" fill="#1C274C"></circle> </g></svg>
                        الأسئلة الشائعة
                    </h2>
                     
                </div>

                <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

                <section v-if="form.active" class="flex flex-col gap-1"> 

                    <div class="divider text-xs">قائمة الأسئلة الشائعة</div>

                    <div v-if="form.faqs.length === 0" class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>لا توجد أسئلة مضافة بعد</p>
                        <p class="text-sm">اضغط على "إضافة سؤال" لبدء إضافة الأسئلة الشائعة</p>
                    </div>

                    <div v-else class="space-y-3 mt-5">
                        <div 
                            v-for="(faq, index) in form.faqs" 
                            :key="faq.id || index"
                            :draggable="true"
                            @dragstart="dragStart(index, $event)"
                            @dragover.prevent
                            @dragenter.prevent
                            @drop="drop(index, $event)"
                            class="bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-colors transition-all"
                            :class="{ 'opacity-50': draggedIndex === index }"
                        >
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <!-- Drag Handle -->
                                    <div hidden class="cursor-move text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                        </svg>
                                    </div>
                                    
                                    <button 
                                        hidden
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
                                </div>
 
                                <div class="flex items-center gap-2 justify-between w-full">
                                    <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                    <button @click="removeFaq(index)" class="btn btn-xs btn-soft btn-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            
                                
                            </div>

                            <UiToggle :name="`faqs.${index}.active`" label="تفعيل السؤال" v-model="faq.active" />

                            <div v-if="faq.active" :id="`faq-panel-${index}`" XXv-show="!collapsed[index]" class=" mt-1 flex flex-col gap-1">
                                <UiInput :name="`faqs.${index}.question`"  v-model="faq.question" placeholder="اكتب السؤال هنا.." />
                                <UiTextarea :name="`faqs.${index}.answer`"  v-model="faq.answer" placeholder="اكتب الإجابة هنا.." />
                                 
                            </div>

                        </div>
                    </div>
                 
                    <button 
                            @click="addFaq"
                            class="btn btn-primary btn-outline w-full mt-2"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            إضافة سؤال
                    </button>
   
                </section>


                <div class="flex justify-end w-full pt-6">
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
import { useNotification } from '@kyvg/vue3-notification'

const errorsStore = useErrorsStore()
const { notify } = useNotification()

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
        
        notify({ type: "success", text: "تم حفظ الأسئلة الشائعة بنجاح" })
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error(error.response?.data?.errors || error.message)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
            notify({ type: "error", text: "فشل حفظ الأسئلة الشائعة" })
        } else {
            notify({ type: "error", text: "حدث خطأ ما، الرجاء المحاولة مرة أخرى" })
        }
    })
}

// persist whenever collapsed changes in length/content
watch(collapsed, (val) => {
    try { localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(val)) } catch (e) {}
}, { deep: true })
</script>
 