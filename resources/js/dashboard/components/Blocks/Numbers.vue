<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 13H21M3 17H21M7 21H17C18.1046 21 19 20.1046 19 19V5C19 3.89543 18.1046 3 17 3H7C5.89543 3 5 3.89543 5 5V19C5 20.1046 5.89543 21 7 21Z" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M9 9H15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        الإحصائيات
                    </h2>
                </div>

                <UiAlert>
                    قائمة الإحصائيات والأرقام، يمكنك إضافة أكثر من إحصائية لعرضها لعملائك المحتملين.
                </UiAlert>
                <UiToggle name="active" label="تفعيل القسم" v-model="form.active" />

                <section v-if="form.active" class="flex flex-col gap-1">

                    <UiInput name="title" label="عنوان القسم" v-model="form.title" placeholder="مثال: إحصائياتنا" />
                    <UiInput name="subtitle" label="العنوان الفرعي" v-model="form.subtitle" placeholder="مثال: أرقام تتحدث عن نفسها" />
    
                    <div class="divider text-xs">قائمة الإحصائيات</div>

                    <div v-if="form.items.length === 0" class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p>لا توجد إحصائيات مضافة بعد</p>
                        <p class="text-sm">اضغط على "إضافة إحصائية" لبدء إضافة الإحصائيات</p>
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
                            class="bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-colors transition-all"
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
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                    <button @click="removeItem(index)" class="btn btn-xs btn-soft btn-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
 
                            <UiToggle :name="`items.${index}.active`" label="تفعيل الإحصائية" v-model="item.active" />

                            <div v-if="item.active" :id="`item-panel-${index}`" class="space-y-1 mt-1 flex flex-col gap-1">
                                <div class="grid grid-cols-1 gap-1">
                                    <UiIcon :name="`items.${index}.icon`" label="الأيقونة" v-model="item.icon" placeholder="اختر الأيقونة" />
                                    <UiInput :name="`items.${index}.title`" label="العنوان" v-model="item.title" placeholder="مثال: اكثر من ٧ مليون مشاهدة على اليوتيوب .." />
                                    <UiInput :name="`items.${index}.number`" label="الرقم" v-model="item.number" placeholder="مثال: 1000 أو 50K" type="text" />
                                </div>
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
                            إضافة إحصائية
                        </button>
                   

              
                </section>

                <div class="flex items-center justify-end w-full pt-6">
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ الإحصائيات</span>
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
import { useNotification } from '@kyvg/vue3-notification'

const errorsStore = useErrorsStore()
const { notify } = useNotification()

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
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/numbers').then(response => {
        form.value = response.data.data
        // Add IDs to existing items if they don't have them
        form.value.items = form.value.items.map((item, index) => ({
            ...item,
            id: item.id || Date.now() + index
        }))
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addItem = () => {
    form.value.items.push({
        id: Date.now(), // Add unique ID for better drag and drop
        icon: '',
        title: '',
        number: '',
        active: true
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
    
    // Reset drag state
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/numbers', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Update form with response data to get proper IDs
        form.value = response.data.data
        
        notify({ type: "success", text: "تم حفظ الإحصائيات بنجاح" })
        
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
            notify({ type: "error", text: "فشل حفظ الإحصائيات" })
        } else {
            notify({ type: "error", text: "حدث خطأ ما، الرجاء المحاولة مرة أخرى" })
        }
    })
}
</script>

