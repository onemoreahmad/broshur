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
                            <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M12 12H16M12 16H16M8 12H8.01M8 16H8.01" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                            قوائم التشغيل
                        </h2>
                </div>
            

            <UiAlert>
                قائمة قوائم التشغيل، يمكنك إضافة أكثر من قائمة تشغيل لعرضها لعملائك المحتملين.
            </UiAlert>

            <UiToggle name="active" label="تفعيل القسم" v-model="form.active"   />

            <section v-if="form.active" class="flex flex-col gap-1">
                
                <div class="grid grid-cols-1 gap-1">
                    <UiInput name="title" label="عنوان القسم" v-model="form.title" placeholder="مثال: قوائم التشغيل" />  
                    <UiInput name="subtitle" label="العنوان الفرعي" v-model="form.subtitle" placeholder="مثال: استمع إلى قوائمنا المميزة" />
                </div>

                <div class="divider text-xs">قوائم التشغيل</div>

            <!-- Empty State -->
            <div v-if="form.playlists.length === 0" class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                </svg>
                <p class="text-lg font-medium mb-2">لا توجد قوائم تشغيل بعد</p>
                <p class="text-sm text-gray-400">أضف قوائم التشغيل لإظهارها في موقعك</p>
            </div>

            <!-- Playlists List -->
            <div v-else class="space-y-4 mt-5">
                <div 
                    v-for="(playlist, index) in form.playlists" 
                    :key="playlist.id || index"
                    class="bg-base-50 rounded-lg p-2 border-2 border-base-200 cursor-move hover:bg-base-100 transition-all"
                    draggable="true"
                    @dragstart="dragStartPlaylist(index, $event)"
                    @dragover.prevent
                    @drop="dropPlaylist(index, $event)"
                >
                    <!-- Playlist Header -->
                    <div class="flex items-center justify-between mb-3">
                             <span class="text-sm font-medium text-gray-600">قائمة تشغيل #{{ index + 1 }}</span>

                            <div class="flex items-center gap-2">
                                <span class="text-xs badge badge-ghost">#{{ index + 1 }}</span>
                                <button @click="removePlaylist(index)" class="btn btn-xs btn-soft btn-error">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                       
                    </div>

                    <UiToggle :name="`playlists.${index}.active`" label="تفعيل القائمة" v-model="playlist.active" />

                    <!-- Playlist Form -->
                    <div v-if="playlist.active" :id="`playlist-panel-${index}`" class="mt-1 grid grid-cols-1 gap-1">
                        <UiInput :name="`playlists.${index}.name`" label="اسم القائمة" v-model="playlist.name" placeholder="اسم القائمة" />
                        <UiInput :name="`playlists.${index}.slug`" label="الرابط" v-model="playlist.slug" placeholder="الرابط" />
                        <UiTextarea :name="`playlists.${index}.description`" label="الوصف" v-model="playlist.description" placeholder="وصف القائمة" />
                        
                        <UiUploadImage 
                            v-model="playlist.logo"
                            :name="`playlists.${index}.logo`"
                            :modelId="form.id"
                            mediaCollection="playlists"
                            :preview="playlist.logo_url || ''"
                            label="الشعار"
                            @upload-start="imageUploadingCount++"
                            @upload-end="imageUploadingCount--"
                        />
                        
                        <UiUploadImage 
                            v-model="playlist.cover"
                            :name="`playlists.${index}.cover`"
                            :modelId="form.id"
                            mediaCollection="playlists"
                            :preview="playlist.cover_url || ''"
                            label="الغلاف"
                            @upload-start="imageUploadingCount++"
                            @upload-end="imageUploadingCount--"
                        />

                        <!-- Items Section -->
                        <div class="mt-3 border-t pt-3">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-sm font-medium text-gray-700">عناصر القائمة</label>
                                <button 
                                    @click="addItem(index)"
                                    type="button"
                                    class="btn btn-xs btn-primary btn-outline"
                                >
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    إضافة عنصر
                                </button>
                            </div>
                            
                            <!-- Items List -->
                            <div v-if="playlist.items && playlist.items.length > 0" class="space-y-2 mt-2">
                                <div 
                                    v-for="(item, itemIndex) in playlist.items" 
                                    :key="item.id || itemIndex"
                                    class="bg-base-100 rounded p-2 border border-base-200"
                                    draggable="true"
                                    @dragstart="dragStartItem(index, itemIndex, $event)"
                                    @dragover.prevent
                                    @drop="dropItem(index, itemIndex, $event)"
                                >
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-500">عنصر #{{ itemIndex + 1 }}</span>
                                        <button 
                                            @click="removeItem(index, itemIndex)"
                                            type="button"
                                            class="btn btn-xs btn-soft btn-error"
                                        >
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 gap-2">
                                        <UiInput 
                                            :name="`playlists.${index}.items.${itemIndex}.name`" 
                                            label="اسم العنصر" 
                                            v-model="item.name" 
                                            placeholder="اسم العنصر"
                                            class="text-sm"
                                        />
                                        <UiInput 
                                            :name="`playlists.${index}.items.${itemIndex}.type`" 
                                            label="النوع" 
                                            v-model="item.type" 
                                            placeholder="مثال: audio, video, podcast"
                                            class="text-sm"
                                        />
                                        <UiInput 
                                            :name="`playlists.${index}.items.${itemIndex}.path`" 
                                            label="المسار" 
                                            v-model="item.path" 
                                            placeholder="المسار"
                                            class="text-sm"
                                        />
                                        <UiInput 
                                            :name="`playlists.${index}.items.${itemIndex}.file`" 
                                            label="الملف" 
                                            v-model="item.file" 
                                            placeholder="اسم الملف"
                                            class="text-sm"
                                        />
                                        <UiInput 
                                            :name="`playlists.${index}.items.${itemIndex}.link`" 
                                            label="الرابط" 
                                            v-model="item.link" 
                                            placeholder="رابط العنصر"
                                            class="text-sm"
                                        />
                                        <UiUploadImage 
                                            v-model="item.cover"
                                            :name="`playlists.${index}.items.${itemIndex}.cover`"
                                            :modelId="form.id"
                                            mediaCollection="playlist_items"
                                            :preview="item.cover_url || ''"
                                            label="الغلاف"
                                            class="text-sm"
                                            @upload-start="imageUploadingCount++"
                                            @upload-end="imageUploadingCount--"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div v-else class="text-sm text-gray-400 text-center py-2">
                                لا توجد عناصر
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Playlist Button -->
        
                <button 
                    @click="addPlaylist"
                    class="btn btn-primary btn-outline w-full mt-2"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة قائمة تشغيل
                </button>
            

            </section>
            <div class="flex justify-end w-full pt-6">
                <button 
                    @click="save" 
                    class="btn btn-primary" 
                    :disabled="formLoading || imageUploadingCount > 0"
                > 
                    <span v-if="!formLoading && imageUploadingCount === 0">حفظ قوائم التشغيل</span>
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
const draggedPlaylistIndex = ref(null)
const draggedItemIndex = ref({ playlistIndex: null, itemIndex: null })
const imageUploadingCount = ref(0)


const form = ref({
    id: null,
    active: false,
    title: '',
    subtitle: '',
    playlists: []
})

onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/playlists').then(response => {
        form.value = response.data.data
        // Ensure items is always an array
        if (form.value.playlists) {
            form.value.playlists.forEach(playlist => {
                if (!playlist.items || !Array.isArray(playlist.items)) {
                    playlist.items = []
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

const addPlaylist = () => {
    form.value.playlists.push({
        id: null, // Will be set by server when created
        name: '',
        slug: '',
        logo: null,
        logo_url: '',
        cover: null,
        cover_url: '',
        description: '',
        active: true,
        sort: form.value.playlists.length,
        items: []
    })
}

const removePlaylist = (index) => {
    form.value.playlists.splice(index, 1)
}

const addItem = (playlistIndex) => {
    if (!form.value.playlists[playlistIndex].items) {
        form.value.playlists[playlistIndex].items = []
    }
    form.value.playlists[playlistIndex].items.push({
        id: null,
        name: '',
        cover: null,
        cover_url: '',
        path: '',
        file: '',
        link: '',
        type: '',
        meta: {},
        sort: form.value.playlists[playlistIndex].items.length
    })
}

const removeItem = (playlistIndex, itemIndex) => {
    form.value.playlists[playlistIndex].items.splice(itemIndex, 1)
}

// Drag and Drop Functions for Playlists
const dragStartPlaylist = (index, event) => {
    draggedPlaylistIndex.value = index
    event.dataTransfer.effectAllowed = 'move'
    event.dataTransfer.setData('text/html', event.target.outerHTML)
}

const dropPlaylist = (dropIndex, event) => {
    event.preventDefault()
    
    if (draggedPlaylistIndex.value === null || draggedPlaylistIndex.value === dropIndex) {
        draggedPlaylistIndex.value = null
        return
    }
    
    const draggedItem = form.value.playlists[draggedPlaylistIndex.value]
    form.value.playlists.splice(draggedPlaylistIndex.value, 1)
    form.value.playlists.splice(dropIndex, 0, draggedItem)
    
    // Update sort order
    form.value.playlists.forEach((playlist, index) => {
        playlist.sort = index
    })
    
    draggedPlaylistIndex.value = null
}

// Drag and Drop Functions for Items
const dragStartItem = (playlistIndex, itemIndex, event) => {
    draggedItemIndex.value = { playlistIndex, itemIndex }
    event.dataTransfer.effectAllowed = 'move'
    event.dataTransfer.setData('text/html', event.target.outerHTML)
}

const dropItem = (playlistIndex, dropItemIndex, event) => {
    event.preventDefault()
    
    if (draggedItemIndex.value.playlistIndex !== playlistIndex || 
        draggedItemIndex.value.itemIndex === null || 
        draggedItemIndex.value.itemIndex === dropItemIndex) {
        draggedItemIndex.value = { playlistIndex: null, itemIndex: null }
        return
    }
    
    const items = form.value.playlists[playlistIndex].items
    const draggedItem = items[draggedItemIndex.value.itemIndex]
    items.splice(draggedItemIndex.value.itemIndex, 1)
    items.splice(dropItemIndex, 0, draggedItem)
    
    // Update sort order
    items.forEach((item, index) => {
        item.sort = index
    })
    
    draggedItemIndex.value = { playlistIndex: null, itemIndex: null }
}

const save = () => {
    formLoading.value = true;
    
    axios.post('/api/blocks/playlists', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        notify({
            title: 'تم حفظ قوائم التشغيل بنجاح',
            type: 'success'
        })
        // Update form with response data to get proper IDs
        form.value = response.data.data
        // Ensure items is always an array
        if (form.value.playlists) {
            form.value.playlists.forEach(playlist => {
                if (!playlist.items || !Array.isArray(playlist.items)) {
                    playlist.items = []
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
        console.error('Error saving playlists:', error.response?.data?.errors || error.message)
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

