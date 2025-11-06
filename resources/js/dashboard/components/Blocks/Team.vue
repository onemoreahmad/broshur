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
                            <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 21.5L19.3505 15.9795C19.1506 14.2804 17.7107 13 16 13H8C6.28928 13 4.84936 14.2804 4.64948 15.9795L4 21.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M8 13V18C8 19.8856 8 20.8284 8.58579 21.4142C9.17157 22 10.1144 22 12 22C13.8856 22 14.8284 22 15.4142 21.4142C16 20.8284 16 19.8856 16 18V13" stroke="#1C274C" stroke-width="1.5"></path> <circle cx="12" cy="6" r="4" stroke="#1C274C" stroke-width="1.5"></circle> </g></svg>
                            الفريق
                        </h2>
                </div>
            

            <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

            <section v-if="form.active" class="flex flex-col gap-1">
                
                <div class="grid grid-cols-1 gap-1">
                    <UiInput name="title" label="عنوان القسم" v-model="form.title" placeholder="مثال: فريقنا" />  
                    <UiInput name="subtitle" label="العنوان الفرعي" v-model="form.subtitle" placeholder="مثال: تعرف على أعضاء فريقنا المميز" />
                </div>

                <div class="divider text-xs">قائمة أعضاء الفريق</div>

            <!-- Empty State -->
            <div v-if="form.members.length === 0" class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-lg font-medium mb-2">لا يوجد أعضاء فريق بعد</p>
                <p class="text-sm text-gray-400">أضف أعضاء الفريق لإظهارهم في موقعك</p>
            </div>

            <!-- Members List -->
            <div v-else class="space-y-4 mt-5">
                <div 
                    v-for="(member, index) in form.members" 
                    :key="member.id || index"
                    class="bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-all"
                    draggable="true"
                    @dragstart="dragStart(index, $event)"
                    @dragover.prevent
                    @drop="drop(index, $event)"
                >
                    <!-- Member Header -->
                    <div class="flex items-center justify-between mb-3">
                             <span class="text-sm font-medium text-gray-600">عضو #{{ index + 1 }}</span>

                            <div class="flex items-center gap-2">
                                <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                <button @click="removeMember(index)" class="btn btn-xs btn-soft btn-error">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                       
                    </div>

                    <UiToggle :name="`members.${index}.active`" label="تفعيل العضو" v-model="member.active" />

                    <!-- Member Form -->
                    <div v-if="member.active" :id="`member-panel-${index}`" class="mt-1 grid grid-cols-1 gap-1">
                        <UiInput :name="`members.${index}.name`" label="الاسم" v-model="member.name" placeholder="اسم العضو" />
                        <UiInput :name="`members.${index}.job_title`" label="المسمى الوظيفي" v-model="member.job_title" placeholder="المسمى الوظيفي" />
                        <UiTextarea :name="`members.${index}.bio`" label="السيرة الذاتية" v-model="member.bio" placeholder="سيرة ذاتية مختصرة للعضو" />
                    
                        <UiUploadImage 
                            v-model="member.image"
                            :name="`members.${index}.image`"
                            :modelId="form.id"
                            mediaCollection="team"
                            :preview="member.image_url || ''"
                            @upload-start="imageUploadingCount++"
                            @upload-end="imageUploadingCount--"
                        />

                    </div>
                </div>
            </div>

            <!-- Add Member Button -->
        
                <button 
                    @click="addMember"
                    class="btn btn-primary btn-outline w-full mt-2"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة عضو
                </button>
            

            </section>
            <div class="flex justify-end w-full pt-6">
                <button 
                    @click="save" 
                    class="btn btn-primary" 
                    :disabled="formLoading || imageUploadingCount > 0"
                > 
                    <span v-if="!formLoading && imageUploadingCount === 0">حفظ الفريق</span>
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
    members: []
})

onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/team').then(response => {
        form.value = response.data.data
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addMember = () => {
    form.value.members.push({
        id: null, // Will be set by server when created
        name: '',
        job_title: '',
        bio: '',
        image: '',
        image_url: '',
        active: true,
        sort: form.value.members.length
    })
}

const removeMember = (index) => {
    form.value.members.splice(index, 1)
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
    
    const draggedItem = form.value.members[draggedIndex.value]
    form.value.members.splice(draggedIndex.value, 1)
    form.value.members.splice(dropIndex, 0, draggedItem)
    
    // Update sort order
    form.value.members.forEach((member, index) => {
        member.sort = index
    })
    
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
    
    axios.post('/api/blocks/team', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        notify({
            title: 'تم حفظ الفريق بنجاح',
            type: 'success'
        })
        // Update form with response data to get proper IDs
        form.value = response.data.data
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error('Error saving team:', error.response?.data?.errors || error.message)
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

