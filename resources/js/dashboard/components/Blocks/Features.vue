<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.8114 6.7267C12.8247 4.9089 13.3314 4 14.0889 4C14.8464 4 15.353 4.9089 16.3663 6.7267L16.6285 7.19699C16.9164 7.71355 17.0604 7.97183 17.2849 8.14225C17.5094 8.31266 17.789 8.37592 18.3482 8.50244L18.8572 8.61762C20.825 9.06284 21.8089 9.28545 22.0429 10.0382C22.277 10.7909 21.6063 11.5753 20.2648 13.1439L19.9177 13.5498C19.5365 13.9955 19.3459 14.2184 19.2602 14.4942C19.1744 14.7699 19.2032 15.0673 19.2609 15.662L19.3134 16.2035C19.5162 18.2965 19.6176 19.343 19.0047 19.8082C18.3919 20.2734 17.4707 19.8492 15.6283 19.0009L15.1517 18.7815C14.6281 18.5404 14.3664 18.4199 14.0889 18.4199C13.8114 18.4199 13.5496 18.5404 13.0261 18.7815L12.5494 19.0009C10.707 19.8492 9.78581 20.2734 9.17299 19.8082C8.56016 19.343 8.66157 18.2965 8.86438 16.2035L8.91685 15.662C8.97449 15.0673 9.0033 14.7699 8.91756 14.4942C8.83181 14.2184 8.64121 13.9955 8.26 13.5498L7.91295 13.1439C6.57147 11.5753 5.90073 10.7909 6.1348 10.0382C6.36888 9.28545 7.35275 9.06284 9.3205 8.61762L9.82958 8.50244C10.3887 8.37592 10.6683 8.31266 10.8928 8.14225C11.1173 7.97183 11.2613 7.71355 11.5492 7.19699L11.8114 6.7267Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M2.08887 16C3.20445 15.121 4.68639 14.7971 6.08887 15.1257" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M2.08887 10.5C3.08887 10 3.37862 10.0605 4.08887 10" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M2 5.60867L2.20816 5.48676C4.41383 4.19506 6.75032 3.84687 8.95304 4.48161L9.16092 4.54152" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        المميزات
                    </h2>
                </div>

                <UiToggle name="active" label="تفعيل القسم" v-model="form.active" />

                <section v-if="form.active" class="flex flex-col gap-1">

                    <UiInput name="title" label="عنوان القسم" v-model="form.title" placeholder="مثال: مميزاتنا" />
                    <UiInput name="subtitle" label="العنوان الفرعي" v-model="form.subtitle" placeholder="مثال: اكتشف ما يميزنا عن الآخرين" />
    
                    <div class="divider text-xs">قائمة المميزات</div>

                    <div v-if="form.features.length === 0" class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>لا توجد مميزات مضافة بعد</p>
                        <p class="text-sm">اضغط على "إضافة ميزة" لبدء إضافة المميزات</p>
                    </div>

                    <div v-else class="space-y-3 mt-5">
                        <div 
                            v-for="(feature, index) in form.features" 
                            :key="feature.id || index"
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
                                        :aria-controls="`feature-panel-${index}`"
                                    >
                                        <svg v-if="collapsed[index]" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                        <svg v-else class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832l-3.71 3.938a.75.75 0 11-1.08-1.04l4.24-4.5a.75.75 0 011.08 0l4.24 4.5c.28.297.27.765-.02 1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
 
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                    <button @click="removeFeature(index)" class="btn btn-xs btn-soft btn-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
 
                            <UiToggle :name="`features.${index}.active`" label="تفعيل الميزة" v-model="feature.active" />

                            <div v-if="feature.active" :id="`feature-panel-${index}`" XXv-show="!collapsed[index]" class="space-y-1 mt-1 flex flex-col gap-1">
                                <div class="grid grid-cols-1 gap-1">
                                 
                                    <UiIcon :name="`features.${index}.icon`" label="الأيقونة" v-model="feature.icon" placeholder="مثال: ⭐ أو 🚀 أو 📱" />
                                    <UiInput :name="`features.${index}.title`" label="العنوان" v-model="feature.title" placeholder="اكتب عنوان الميزة هنا..." />
                                    <UiInput :name="`features.${index}.description`" label="الوصف" v-model="feature.description" placeholder="اكتب وصف الميزة هنا..." />
    
 
                                </div>
                            </div>
                            
                        </div>
                    </div>
           
                 
                        <button 
                            @click="addFeature"
                            class="btn btn-primary btn-outline w-full mt-2"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            إضافة ميزة
                        </button>
                   

              
                </section>

                <div class="flex items-center justify-end w-full pt-6">
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
import { useNotification } from '@kyvg/vue3-notification'

const errorsStore = useErrorsStore()
const { notify } = useNotification()

const form = ref({
    id: null,
    active: true,
    title: '',
    subtitle: '',
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
        
        // Update form with response data to get proper IDs
        form.value = response.data.data
        
        notify({ type: "success", text: "تم حفظ المميزات بنجاح" })
        
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
            notify({ type: "error", text: "فشل حفظ المميزات" })
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
 