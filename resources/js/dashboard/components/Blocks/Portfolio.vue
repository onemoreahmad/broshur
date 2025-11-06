<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2.38351 13.793C1.93748 10.6294 1.71447 9.04765 2.66232 8.02383C3.61017 7 5.29758 7 8.67239 7H15.3276C18.7024 7 20.3898 7 21.3377 8.02383C22.2855 9.04765 22.0625 10.6294 21.6165 13.793L21.1935 16.793C20.8437 19.2739 20.6689 20.5143 19.7717 21.2572C18.8745 22 17.5512 22 14.9046 22H9.09536C6.44881 22 5.12553 22 4.22834 21.2572C3.33115 20.5143 3.15626 19.2739 2.80648 16.793L2.38351 13.793Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M19.5617 7C19.7904 5.69523 18.7863 4.5 17.4617 4.5H6.53788C5.21323 4.5 4.20922 5.69523 4.43784 7M17.4999 4.5C17.5283 4.24092 17.5425 4.11135 17.5427 4.00435C17.545 2.98072 16.7739 2.12064 15.7561 2.01142C15.6497 2 15.5194 2 15.2588 2H8.74099C8.48035 2 8.35002 2 8.24362 2.01142C7.22584 2.12064 6.45481 2.98072 6.45704 4.00434C6.45727 4.11135 6.47146 4.2409 6.49983 4.5" stroke="#1C274C" stroke-width="1.5"></path> <circle opacity="0.5" cx="16.5" cy="11.5" r="1.5" stroke="#1C274C" stroke-width="1.5"></circle> <path opacity="0.5" d="M19.9999 20L17.1157 17.8514C16.1856 17.1586 14.8004 17.0896 13.7766 17.6851L13.5098 17.8403C12.7984 18.2542 11.8304 18.1848 11.2156 17.6758L7.37738 14.4989C6.6113 13.8648 5.38245 13.8309 4.5671 14.4214L3.24316 15.3803" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        المعرض
                    </h2>
                    
                </div>

                <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

                <section v-if="form.active" class="flex flex-col gap-1">
                     
                <div class="grid grid-cols-1 gap-1 ">
                    <UiInput name="title" label="عنوان القسم" v-model="form.title" placeholder="مثال: معرض أعمالنا" />  
                    <UiInput name="subtitle" label="العنوان الفرعي" v-model="form.subtitle" placeholder="مثال: اكتشف مجموعة من أعمالنا المميزة" />
                </div>

                <div class="divider text-xs">قائمة  المشاريع والأعمال</div>
 
                <div v-if="form.items.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                    </svg>
                    <p>لا توجد عناصر مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة عنصر" لبدء إضافة أعمالك</p>
                </div>

                <div v-else class="space-y-3 mt-5">
                    <div 
                        v-for="(item, index) in form.items" 
                        :key="item.id || index"
                        :draggable="true"
                        @dragstart="dragStart(index, $event)"
                        @dragover.prevent
                        @dragenter.prevent
                        @drop="drop(index, $event)"
                        class="bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-all"
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

                                <span class="text-sm font-medium text-gray-600">عنصر #{{ index + 1 }}</span>
                                <div hidden class="flex items-center gap-2">
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

                        <div class="grid grid-cols-1  gap-1">
                            <UiInput :name="`items.${index}.name`" label="الاسم" v-model="item.name" placeholder="اسم المشروع أو العمل" />
                            <UiInput :name="`items.${index}.caption`" label="الوصف (اختياري)" v-model="item.caption" placeholder="وصف قصير للعمل (اختياري)" />
  
                            <UiUploadImage 
                                v-model="item.image"
                                :name="`items.${index}.image`"
                                :modelId="form.id"
                                mediaCollection="portfolio"
                                :preview="item.image_url || ''"
                                @upload-start="imageUploadingCount++"
                                @upload-end="imageUploadingCount--"
                            />

                        </div>  
                          

 
                    </div>
                </div>

                <button 
                        @click="addItem"
                        class="btn btn-primary btn-outline w-full mt-2"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة عنصر
                    </button>


                </section>

                <div class="flex items-center justify-end w-full pt-2">
                
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading || imageUploadingCount > 0"
                    > 
                        <span v-if="!formLoading && imageUploadingCount === 0">حفظ</span>
                        <span v-else class="loading loading-spinner loading-xs"></span>
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
    title: '',
    subtitle: '',
    items: []
})

const loading = ref(false)
const formLoading = ref(false)
const draggedIndex = ref(null)
const imageUploadingCount = ref(0)

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
        name: '',
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


